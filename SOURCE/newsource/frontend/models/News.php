<?php
namespace frontend\models;
#Created by  Nguyen Quoc Khanh
#Created on Dec 30, 2017, 2:59:05 AM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.
use common\models\NewsBase;
use Yii;
/**
 * Description of News
 *
 * @author Nguyen Quoc Khanh
 */
class News extends NewsBase{
    //put your code here
    function getImagepath(){
        return Yii::$app->params['media_path'].$this->image_path;
    }
    
    public static function getMoreNews($removeid, $isHot = false) {
        $query = News::find()
                ->where(['status' => 1])
                ->andWhere(['not in', 'id', $removeid])
                ->orderBy('id desc');        
        return $query->all();
    }
}
