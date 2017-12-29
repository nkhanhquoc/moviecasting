<?php
namespace frontend\controllers;

#Created by  Nguyen Quoc Khanh
#Created on Dec 24, 2017, 8:07:07 AM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.
use Yii;
use frontend\models\Movie;
use frontend\models\Casting;
/**
 * Description of MovieController
 *
 * @author Nguyen Quoc Khanh
 */
class MovieController extends AppController{
    //put your code here
    public function actionIndex()
    {
        $id = Yii::$app->getRequest()->getQueryParam('id');
        $movie = Movie::findOne($id);
        $casting = Casting::find()->where(['movie_id'=>$id,'status'=>1])->all();
        $arrHot = array();
        foreach($hot as $h){
            $arrHot[] = $h->id;
        }
        $normal = Movie::getNormal($arrHot);
        return $this->render('moviedetail.twig',[
            'hot'=>$hot,
            'normal' =>$normal,
            'movie'=>$movie,
            'casting'=>$casting
        ]);
    }
}
