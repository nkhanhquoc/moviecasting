<?php
/**
 * Created by PhpStorm.
 * User: hoangl
 * Date: 9/17/2016
 * Time: 2:50 PM
 */

namespace frontend\controllers;

use Yii;
use frontend\models\Movie;

class SiteController extends AppController
{
    public function beforeAction($event)
    {
        Yii::$app->session->set('frontend', \Yii::t('frontend', ''));
        return parent::beforeAction($event);
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'captcha' => Yii::$app->params['captcha'],
        ];
    }

    public function actionIndex()
    {
        $hot = Movie::getHot();
        $arrHot = array();
        foreach($hot as $h){
            $arrHot[] = $h->id;
        }
        $normal = Movie::getNormal($arrHot);
        return $this->render('home.twig',[
            'hot'=>$hot,
            'normal' =>$normal
        ]);
    }

}
