<?php
namespace frontend\models;
#Created by  Nguyen Quoc Khanh
#Created on Dec 25, 2017, 3:16:15 PM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.
use Yii;
use common\models\CastingBase;
/**
 * Description of Casting
 *
 * @author Nguyen Quoc Khanh
 */
class Casting extends CastingBase {
    //put your code here
    function getImagepath(){
        return Yii::$app->params['media_path'].$this->image_path;
    }
}
