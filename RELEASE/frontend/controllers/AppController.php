<?php
/**
 * Created by PhpStorm.
 * User: hoangl
 * Date: 9/17/2016
 * Time: 2:47 PM
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class AppController extends Controller
{
    public function behaviors() {

    }

    public function beforeAction($action) {
        if (Yii::$app->session->has('lang')) {
            Yii::$app->language = Yii::$app->session->get('lang');
        } else {
            Yii::$app->language = 'vi';
        }
        $request = Yii::$app->request;
        if ($request->isPjax || $request->getQueryParam('_pjax') || $request->isAjax) {
            $this->layout = false;
        }
        return parent::beforeAction($action);
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error.twig', ['exception' => $exception]);
        }
    }
}
