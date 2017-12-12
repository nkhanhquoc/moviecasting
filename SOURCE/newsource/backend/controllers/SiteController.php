<?php

	namespace backend\controllers;

	use Aws\Common\Credentials\Credentials;
	use Aws\S3\S3Client;
	use backend\models\CsmAttribute;
	use backend\models\CsmCp;
	use backend\models\CsmMedia;
	use backend\models\CsmMediaAttribute;
	use backend\models\LoginForm;
	use backend\models\MAttrTmp;
	use backend\models\ResetPasswordForm;
	use backend\models\User;
	use backend\models\UserLocked;
	use backend\models\UserLoginFailed;
	use common\helpers\NetworkHelper;
	use Yii;
	use yii\helpers\ArrayHelper;
	use yii\web\Response;

	/**
	 * Site controller
	 */
	class SiteController extends AppController {

	  public $layout = 'default';

	  /**
	   * @inheritdoc
	   */
	  public function actions() {
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class' => 'common\libs\BackendCaptcha',
				'transparent' => true,
				'foreColor' => 0xffff00,
				'minLength' => 5,
				'maxLength' => 6,
				'offset' => -2,
				'chars' => 'abcdefhjkmnpqrstuxyz2345678',
				'libfont' => [
					0 => '@backend/web/css/fonts/captcha/vavobi.ttf',
					1 => '@backend/web/css/fonts/captcha/momtype.ttf',
					2 => '@backend/web/css/fonts/captcha/captcha4.ttf'
				]
			],
		];
	  }

	  public function actionIndex() {
		$this->layout = 'main';
		if (!Yii::$app->user->isGuest) {
		  return $this->render('index');
		}
		return $this->redirect('login');
	  }

	  public function actionLogin() {
		$model = new LoginForm();
		if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
		  // Check lock username
		  $username = $model->username;
		  $ip = NetworkHelper::getRemoteIp(Yii::$app->params['get-ip-method']);
		  $time = time();
		  $lockedUsernameDuration = Yii::$app->params['login-failed']['locked_username_duration'];
		  $lockedIpDuration = Yii::$app->params['login-failed']['locked_ip_duration'];
		  if (!UserLocked::isUsernameLocked($username, $time - $lockedUsernameDuration)) {
			if (!UserLocked::isIpLocked($ip, $time - $lockedIpDuration)) {
			  $limitUsername = Yii::$app->params['login-failed']['limit_username'];
			  $limitUsernameDuration = Yii::$app->params['login-failed']['limit_username_duration'];
			  $numUsernameFailed = UserLoginFailed::countByUsername($username, $time - $limitUsernameDuration);
			  if ($numUsernameFailed <= $limitUsername) {
				$limitIp = Yii::$app->params['login-failed']['limit_ip'];
				$limitIpDuration = Yii::$app->params['login-failed']['limit_ip_duration'];
				$numIpFailed = UserLoginFailed::countByIp($ip, $time - $limitIpDuration);
				if ($numIpFailed <= $limitIp) {
				  Yii::$app->session->set('rememberMe', $model->rememberMe);
				  if ($model->login()) {
//				  if (true) {
					// login success
//					$user_cp = CsmCp::getByUserName($model->username);
//					Yii::$app->session->set('user_cp', $user_cp);
//					if ($user_cp) {
//					  /* @var CsmCp $user_cp */
//					  $clients = $user_cp->getClients()->all();
//					if ($clients && count($clients)) {
//					  Yii::$app->session->set('client_list', $clients);
//					}
//					}
					UserLocked::unlockIp($ip);
					UserLocked::unlockUsername($username);
					UserLoginFailed::clearUsername($username);
					if ($model->isFirstLogin && $model->token) {
					  Yii::$app->user->logout();
					  return $this->redirect('/site/reset-password?token=' . $model->token);
					}
					return $this->goBack();
				  } else {
					if ($numIpFailed == $limitIp) {
					  UserLocked::lockIp($ip, $time);
					  Yii::$app->session->setFlash('error', Yii::t('backend', 'Your IP {ip} login failed ' .
							  'over {failed_time} times in {duration} minutes. Your IP has been locked ' .
							  'in {locked_duration} minutes', [
							  'ip' => $ip,
							  'failed_time' => $limitIp,
							  'duration' => $limitIpDuration / 60,
							  'locked_duration' => $lockedIpDuration / 60
					  ]));
					} else if ($numUsernameFailed == $limitUsername) {
					  UserLocked::lockUsername($username, $time);
					  Yii::$app->session->setFlash('error', Yii::t('backend', 'Your username {username} ' .
							  'login failed over {failed_time} times in {duration} minutes. Your username ' .
							  'has been locked in {locked_duration} minutes', [
							  'username' => $username,
							  'failed_time' => $limitUsername,
							  'duration' => $limitUsernameDuration / 60,
							  'locked_duration' => $lockedUsernameDuration / 60
					  ]));
					} else {
					  Yii::$app->session->setFlash('error', Yii::t('backend', 'Username or password is invalid'));
					  UserLoginFailed::log($username, null, $ip, $time);
					}
				  }
				} else {
				  UserLocked::lockIp($ip, $time);
				  Yii::$app->session->setFlash('error', Yii::t('backend', 'Your IP {ip} login failed over ' .
						  '{failed_time} times in {duration} minutes. Your IP has been locked in ' .
						  '{locked_duration} minutes', [
						  'ip' => $ip,
						  'failed_time' => $limitIp,
						  'duration' => $limitIpDuration / 60,
						  'locked_duration' => $lockedIpDuration / 60
				  ]));
				}
			  } else {
				UserLocked::lockUsername($username, $time);
				Yii::$app->session->setFlash('error', Yii::t('backend', 'Your username {username} login failed ' .
						'over {failed_time} times in {duration} minutes. Your username has been locked in ' .
						'{locked_duration} minutes', [
						'username' => $username,
						'failed_time' => $limitUsername,
						'duration' => $limitUsernameDuration / 60,
						'locked_duration' => $lockedUsernameDuration / 60
				]));
			  }
			} else {
			  Yii::$app->session->setFlash('error', Yii::t('backend', 'Your IP {ip} has been locked in ' .
					  '{locked_duration} minutes', [
					  'ip' => $ip,
					  'locked_duration' => $lockedIpDuration / 60
			  ]));
			}
		  } else {
			Yii::$app->session->setFlash('error', Yii::t('backend', 'Your username {username} has been locked in ' .
					'{locked_duration} minutes', [
					'username' => $username,
					'locked_duration' => $lockedUsernameDuration / 60
			]));
		  }
		}
		return $this->render('login', [
				'model' => $model,
		]);
	  }

	  public function actionGetClients() {
		$this->layout = false;
		Yii::$app->response->format = Response::FORMAT_JSON;
		if (!Yii::$app->user->isGuest) {
		  $clients = Yii::$app->session->get('client_list');
		  if ($clients && count($clients)) {
			return ArrayHelper::toArray($clients);
		  }
		}
		return [];
	  }

	  public function actionResetPassword() {
		$token = Yii::$app->request->get('token');
		if (!Yii::$app->user->isGuest || !$token) {
		  Yii::$app->session->setFlash('error', Yii::t('backend', 'You cannot access reset password page'));
		  return $this->goHome();
		}
		$user = User::findByToken($token);
		if (!$user) {
		  Yii::$app->session->setFlash('error', Yii::t('backend', 'You cannot access reset password page'));
		  return $this->goHome();
		}
		$model = new ResetPasswordForm();
		$model->username = $user->username;
		$model->setUser($user);
		if (Yii::$app->request->isPost) {
		  if ($model->load(Yii::$app->request->post()) && $model->login()) {
//			$user_cp = CsmCp::getByUserName($model->username);
//			Yii::$app->session->set('user_cp', $user_cp);
//			if ($user_cp) {
//			  /* @var CsmCp $user_cp */
//			  $clients = $user_cp->getClients()->all();
//			  if ($clients && count($clients)) {
//				Yii::$app->session->set('client_list', $clients);
//			  }
//			}

			Yii::$app->session->setFlash('error', Yii::t('backend', 'You has been charged your password successful'));
			return $this->goBack();
		  }
		}
		return $this->render('resetPassword', [
				'model' => $model,
		]);
	  }

	  public function actionLogout() {
		Yii::$app->user->logout();
		return $this->goHome();
	  }

	}
	