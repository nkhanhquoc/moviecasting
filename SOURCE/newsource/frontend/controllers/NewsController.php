<?php

namespace frontend\controllers;

#Created by  Nguyen Quoc Khanh
#Created on Dec 30, 2017, 2:57:34 AM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.

use Yii;
use frontend\models\News;

/**
 * Description of NewsController
 *
 * @author Nguyen Quoc Khanh
 */
class NewsController extends AppController {

    //put your code here
    public function actionIndex() {
        
    }

    public function actionDetail() {
        $id = Yii::$app->getRequest()->getQueryParam('id');
        $news = News::find(['id'=>$id, 'status'=>1])->one();
        $other = News::find()
                ->where(['!=','id',$id])
                ->andWhere(['status'=>1])
                ->all();
        
        if($news){
            return $this->render('detail.twig',[
                'news' => $news,
                'others'=>$other
            ]);
        } else {
            throw \yii\web\NotFoundHttpException;
        }
    }

}
