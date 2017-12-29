<?php

namespace frontend\controllers;

#Created by  Nguyen Quoc Khanh
#Created on Dec 30, 2017, 2:42:41 AM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.

use Yii;
use frontend\models\Contact;

/**
 * Description of ContactController
 *
 * @author Nguyen Quoc Khanh
 */
class ContactController extends AppController{

   
    public function actionIndex() {
        $contact = new Contact();
        if (Yii::$app->request->isPost) {
            if ($contact->load(Yii::$app->request->post())) {
                //code here
                $contact->save(false);
                Yii::$app->session->set('contact_message', 'Thông tin liên hệ của bạn đã được gửi thành công!');
            }
        }
        return $this->render('index.twig', [
                    'contact' => $contact,
                    'csrfParam' => Yii::$app->request->csrfParam,
                    'csrfToken' => Yii::$app->request->csrfToken,
        ]);
    }

}
