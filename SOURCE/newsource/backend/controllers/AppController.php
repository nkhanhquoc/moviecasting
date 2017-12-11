<?php

/**
 * Created by PhpStorm.
 * User: HoangL
 * Date: 8/10/2015
 * Time: 4:29 PM
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;

class AppController extends Controller {

    public function beforeAction($action) {
        if (Yii::$app->session->has('lang')) {
            Yii::$app->language = Yii::$app->session->get('lang');
        } else {
            Yii::$app->language = 'vi';
        }
        return parent::beforeAction($action);
    }

}
