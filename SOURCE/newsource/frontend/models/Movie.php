<?php

namespace frontend\models;

#Created by  Nguyen Quoc Khanh
#Created on Dec 24, 2017, 7:49:04 AM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.

use Yii;
use common\models\MovieBase;

/**
 * Description of Movie
 *
 * @author Nguyen Quoc Khanh
 */
class Movie extends MovieBase {

    //put your code here
    public static function getHot() {
        $query = Movie::find()->where(['status' => 1, 'hot' => 1]);
        return $query->all();
    }

    public static function getNormal($arrHot, $limit = 6) {
        $query = Movie::find()->where(['status' => 1, 'hot' => 0])
                        ->andWhere(['not in', 'id', $arrHot])->orderBy('id desc')->limit($limit)->all();
        return $query;
    }

    function getJoin() {
        $casting = Casting::find()->where(['movie_id' => $this->id])->asArray()->all();
        $arrCatid = array();
        foreach ($casting as $cas) {
            $arrCatid[] = $cas['id'];
        }
        if (count($arrCatid) > 0) {
            $register = Register::find()->where(['casting_id' => $arrCatid])->asArray()->all();
            return count($register);
        }
        return 0;
    }

    function getLeftdate() {
        $endDate = strtotime($this->end_time);
        $now = time();
        $diff = floor(($endDate - $now) / 24 / 60 / 60);
        return $diff;
    }

    function getImagepath() {
        return Yii::$app->params['media_path'] . $this->image_path;
    }

    public static function getMoreMovie($removeid, $isHot = false) {
        $query = Movie::find()
                ->where(['status' => 1])
                ->andWhere(['not in', 'id', $removeid])
                ->orderBy('id desc');
        if (!$isHot) {
            $query->andWhere(['hot' => 0]);
        }
        return $query->all();
    }

}
