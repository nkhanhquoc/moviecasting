<?php
/*
@Author: Nguyen Quoc Khanh
@Date:   2016/11/11 11:51:29
@Email:  KhanhNQ16@viettel.com.vn
@Project: Imuzik Plus 1.5
@Last modified by:   Nguyen Quoc Khanh
@Last modified time: 2016/11/11 11:51:38
*/
namespace frontend\controllers;

use Yii;
use yii\base\Action;
use yii\base\Exception;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use common\helpers\Helpers;
use common\libs\Constant;
use common\libs\CrbtService;
use common\libs\RegisterVipClient;
use common\libs\RemoveSign;
use common\models\LoginFailTimesBase;
use frontend\models\LogRbtService;
use frontend\models\ProfileForm;
use frontend\models\Subscriber;
use frontend\models\SubType;
use frontend\models\VtLogAction;
use frontend\models\Member;
use frontend\models\LoginForm;

class UserController extends AppController{

  public function beforeAction($action)
  {
      if ($_SERVER['HTTP_HOST'] === Yii::$app->params['vip_domain']) {
          $user = Yii::$app->getUser()->getIdentity();
          $vip = Yii::$app->session->get('user_vip');
          if ($user && $vip) {
              VtLogAction::insertLog($vip->id, $user->phonenumber, $_SERVER['REQUEST_URI'], ACTION_USER);
          }
      }
      Yii::$app->session->set('wap_message', \Yii::t('wap', ''));
      return parent::beforeAction($action);
  }

  /**
   * KhanhNQ16
   */
  public function checkStatusCrbt()
  {
      try {
          $user = Yii::$app->getUser()->getIdentity();
          if ($user) {
              $check = CrbtService::checkStatusCRBT($user->phonenumber);

              if ($check['statusCRBT'] == 1 || $check['statusCRBT'] == 2) {
                  return $check['statusCRBT'];
              }
          }
      } catch (Exception $e) {

      }
      return false;
  }


  /**
   * Logs in a user.
   *
   * @return mixed
   */
  public function actionLogin() {

      if (!\Yii::$app->user->isGuest) {
        return $this->redirect("/");
      }
      $errorCode = "Tên hoặc mật khẩu không chính xác!";
      $form = new LoginForm();
      if (Yii::$app->request->isPost && $form->load(Yii::$app->request->post())) {
          $phonenumber = RemoveSign::convertMsisdn($form['username']);
          $checkTime = Yii::$app->params['lock_fail_check_time'];
          $countFail = LoginFailTimesBase::getFailByTime($phonenumber, time() - $checkTime * 60);
          var_dump($countFail);die;
          if ($countFail > 4) {
              $lastTime = Yii::$app->params['lock_fail_time'];
              $countLastFail = LoginFailTimesBase::getFailByTime($phonenumber, time() - $lastTime * 60);
              if ($countLastFail > 0) {
                  Yii::$app->session->set('wap_message', \Yii::t('wap', "Nhập sai thông tin quá số lần cho phép. Tài khoản của quý khách bị khóa trong " . $lastTime . " phút!"));
                  $errorCode = "Nhập sai thông tin quá số lần cho phép. Tài khoản của quý khách bị khóa trong " . $lastTime . " phút!";
              } else {
                  LoginFailTimesBase::delByPhonenumber($phonenumber);
                  if ($form->login()) {
                      try {
                          Yii::$app->session->set('user_vip', Subscriber::getSubActive());
                          $errorCode = 0;
                      } catch (Exception $e) {
                          Yii::error($e->getMessage());
                      }
                      /* @var Member $user */
                  } else {
                      if ($phonenumber) {
                          $fail = new LoginFailTimes;
                          $fail->phone_number = $phonenumber;
                          $fail->created_time = date("Y-m-d H:i:s", time());
                          try {
                              $fail->save(false);
                          } catch (Exception $e) {
                              Yii::error($e->getMessage());
                          }
                      }
                  }
              }
          } else {
              if ($form->login()) {
                  try {
                      Yii::$app->session->set('user_vip', Subscriber::getSubActive());
                      $errorCode = 0;
                      LoginFailTimesBase::delByPhonenumber($phonenumber);
                  } catch (Exception $e) {
                      Yii::error($e->getMessage());
                  }
                  /* @var Member $user */
              } else {
                  if ($phonenumber) {
                      $fail = new LoginFailTimes;
                      $fail->phone_number = $phonenumber;
                      $fail->created_time = date("Y-m-d H:i:s", time());
                      try {
                          $fail->save(false);
                          if ($countFail == 4) {
                              $lastTime = Yii::$app->params['lock_fail_time'];
                              Yii::$app->session->set('wap_message', \Yii::t('wap', "Nhập sai thông tin quá số lần cho phép. Tài khoản của quý khách bị khóa trong $lastTime phút!"));
                              $errorCode = "Nhập sai thông tin quá số lần cho phép. Tài khoản của quý khách bị khóa trong $lastTime phút!";
                          }
                      } catch (Exception $e) {
                          Yii::error($e->getMessage());
                      }
                  }
              }
          }
      }
      // return $this->render('login.twig', [
      //             'model' => $form,
      //             'loginSuccess' => $successful
      // ]);
      return $errorCode;
  }

  /**
   *
   * @return string
   */
  public function actionProfile()
  {

      $user = Yii::$app->getUser()->getIdentity();
      if (!$user){
        $member = Member::findByUsername(\common\libs\RemoveSign::convertMsisdn("988781354"));
        Yii::$app->user->login($member);
        $user = Yii::$app->getUser()->getIdentity();
      }
      var_dump($user);die;
      // return $this->redirect("login");

      if (Yii::$app->request->isPost) {
          $action = Yii::$app->request->post('action');
          if ($action != null && $action == "remove") {
              $personID = Yii::$app->request->post('personID');
              $toneCode = Yii::$app->request->post('toneCode');
              $toneName = Yii::$app->request->post('toneName');
              $result = CrbtService::delInboxTone($user->phonenumber, $personID);

              $vtlogDown = new VtLogRingBackTone();
              $vtlogDown->tone_name = $toneName;
              $vtlogDown->action = RBT_DELETE;
              $vtlogDown->member_id = $user->id;
              $vtlogDown->from_phonenumber = $user->phonenumber;
              $vtlogDown->username = $user->phonenumber;
              $vtlogDown->return_code = $result['resultCode'];
              $vtlogDown->to_phonenumber = '';
              $vtlogDown->tone_code = $toneCode;
              $vtlogDown->created_at = date('Y-m-d H:i:s', time());
              $vtlogDown->app = WAP_TYPE;
              try {
                  $vtlogDown->save(false);
              } catch (Exception $ex) {

              }
              if ($result['resultCode'] == \Yii::$app->params[CrbtService::routeService($user->phonenumber) . '_success_code']) {
                  Yii::$app->session->set('wap_message', \Yii::t('wap', 'Xóa nhạc chờ thành công!'));
              } else {
                  Yii::$app->session->set('wap_message', \Yii::t('wap', 'Xóa nhạc chờ không thành công, Xin vui lòng thử lại!'));
              }
          } else {
              $error = 0;
              $fullname = Yii::$app->request->post('fullname');
              if ($fullname) {
                  if (strlen(RemoveSign::removeSign($fullname)) > 64) {
                      Yii::$app->session->set('wap_message', \Yii::t('wap', 'Tên hiển thị tối đa 64 ký tự!'));
                      $error = 1;
                  } else
                      $user->fullname = $fullname;
              }
              if (!$error) {
                  $formAvatar = new ProfileForm();
                  $formTheme = new ProfileForm();

                  $formAvatar->imageFile = UploadedFile::getInstance($formAvatar, 'image_path');
                  $formTheme->imageFile = UploadedFile::getInstance($formTheme, 'theme_path');
                  if ($formAvatar->upload()) {
                      $user->image_path = $formAvatar->pathImage;
                  } else if ($formAvatar->imageFile != null) {
                      Yii::$app->session->set('wap_message', \Yii::t('wap', $formAvatar->errors['imageFile'][0]));
                      $error = 1;
                  }

                  if ($formTheme->upload()) {
                      $user->theme_path = $formTheme->pathImage;
                  } else if ($formTheme->imageFile != null) {
                      Yii::$app->session->set('wap_message', \Yii::t('wap', $formTheme->errors['imageFile'][0]));
                      $error = 1;
                  }
              }

              if (!$error) {
                  try {
                      $user->save();
                      Yii::$app->session->set('wap_message', \Yii::t('wap', 'Cập nhật thông tin cá nhân thành công!'));
                  } catch (Exception $e) {
                      Yii::$app->session->set('wap_message', \Yii::t('wap', 'Cập nhật thông tin cá nhân không thành công!'));
                  }
              }
          }
      }
//        $getCollect = CrbtService::getUserTones($user->phonenumber);
//
//        $listRBT = array();
//        if ($getCollect['resultCode'] == 0) {
//            $listRBT = $getCollect['queryToneInfos'];
//        }

      return $this->render('profile.twig', [
          'user' => $user,
//                    'listRbt' => $listRBT
      ]);
  }

  public function actionRegister()
  {
      $modelActive = Subscriber::getSubActive();
      if (Yii::$app->request->post()) {
          if (\Yii::$app->user->isGuest) {
              return $this->redirect('/login');
          }
          $subId = intval(Yii::$app->request->post('sub_name'));
          $ad = intval(Yii::$app->request->post('ad'));
          $client = new RegisterVipClient();
          $msisdn = RemoveSign::convertMsisdn(Yii::$app->user->identity->username);

          $isSwich = 0;
          if ($modelActive && $modelActive->sub_type_id != $subId) {
              $isSwich = 1;
          }
          $model = Subscriber::getSubByType($subId);

          if ($model) {
              if ($model->status == 1) {
                  if ($isSwich) {
                      $result = $client->registerVip($msisdn, $subId);
                  } else {
                      $result = $client->cancelVip($msisdn);
                  }
              } else if ($model->status == 2) {
                  $action = Yii::$app->request->post('action');
                  if ($action == "unregis") {
                      $result = $client->cancelVip($msisdn);
                  } else {
                      $result = $client->registerVip($msisdn, $subId);
                  }
              } else {
                  $result = $client->registerVip($msisdn, $subId);
              }
          } else {    // dang ky moi
              $result = $client->registerVip($msisdn, $subId);
          }
          Yii::$app->session->set('user_vip', Subscriber::getSubActive());
          if ($isSwich && $result) {
              Yii::$app->session->set('wap_message', "Chuyển đổi gói cước thành công!");
          } else
              Yii::$app->session->set('wap_message', $client->getErrorMessage());
      }

      if ($ad) {
          return $this->redirect("http://" . Yii::$app->params['vip_domain'] . '?isAd=1');
      }

      $model = Subscriber::getSub(); //khanhnq16: lay toan bo sub cua user de check trang thai

      $subType = SubType::findAll(['active' => IS_ACTIVE]);
      return $this->render('register.twig', [
          'user_id' => !\Yii::$app->user->isGuest ? Yii::$app->user->getId() : 0,
          'model' => $model,
          'subType' => $subType,
          'sub_daily' => Constant::SUB_DAILY,
          'sub_weekly' => Constant::SUB_WEEKLY,
          'csrfParam' => Yii::$app->request->csrfParam,
          'csrfToken' => Yii::$app->request->csrfToken,
      ]);
  }

}
