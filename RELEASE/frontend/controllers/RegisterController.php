<?php

namespace frontend\controllers;

#Created by  Nguyen Quoc Khanh
#Created on Dec 26, 2017, 3:54:26 PM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.

use Yii;
use frontend\models\RegisterForm;
use frontend\models\Casting;
use frontend\models\Register;
use yii\web\Controller;

/**
 * Description of RegisterController
 *
 * @author Nguyen Quoc Khanh
 */
class RegisterController extends AppController {


    //put your code here
    public function actionIndex() {
//        $form = new RegisterForm();
        $id = Yii::$app->getRequest()->getQueryParam('id');
        $casting = Casting::find(['status' => 1, 'id' => $id])->one();

        if ($casting) {
            if (Yii::$app->request->isPost) {
                $reg = new Register();
                if ($reg->load(Yii::$app->request->post())) {
                    //code here
                    $p1 = $reg->uploadImage('portrait');
                    $p2 = $reg->uploadImage('portrait_2');
                    $p3 = $reg->uploadImage('portrait_3');
                    if ($p1 || $p2 || $p3) {
                        $reg->star = 1;
                        $reg->save(false);
                        Yii::$app->session->set('register_message', 'Đăng ký thành công!');
                    } 
                } 
            }
        }
        return $this->render('index.twig', [
                    'casting' => $casting,
                    'csrfParam' => Yii::$app->request->csrfParam,
                    'csrfToken' => Yii::$app->request->csrfToken,
        ]);
    }

    public function actionReg() {
        $reg = new Register();

        return $this->render('index.twig', [
                    'casting' => $casting,
        ]);
    }

}
