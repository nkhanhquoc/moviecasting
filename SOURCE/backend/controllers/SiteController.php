<?php

namespace backend\controllers;

use Yii;
use common\models\LoginForm;
use common\helpers\MenuHelper;

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
                'class' => 'yii\captcha\CaptchaAction',
                'transparent' => true,
                'minLength' => 4,
                'maxLength' => 4,
            ],
        ];
    }

    public function actionIndex() {
//        $str = '0000000010000100000000000100000000000001000000000000000000000001000000010000001100000001000000000000001100000001000000000000001100000001000000000000001100000001000000000000001100000000000000110110010000000001000000000000001101010000000010100000000100000001000000000000000100000000';
//        $socket = new \common\socket\Socket($str);
//        echo 'id: ' . $socket->id;
//        echo '<br>ie: ' . $socket->ie;
//        echo '<br>data: ' . $socket->data;
//        echo '<br>moduleId: ' . $socket->moduleId;
//        die;
        $this->layout = 'main';
        if (!Yii::$app->user->isGuest) {
            return $this->render('index', [
            ]);
        }
        $this->redirect('login');
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
