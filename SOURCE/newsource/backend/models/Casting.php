<?php
namespace backend\models;
#Created by  Nguyen Quoc Khanh
#Created on Dec 12, 2017, 10:24:17 PM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.
use Yii;
use common\models\CastingBase;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\FileHelper;
use common\libs\Images;
/**
 * Description of Casting
 *
 * @author Nguyen Quoc Khanh
 */
class Casting extends CastingBase{
    //put your code here
     //put your code here
    public function behaviors() {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_time', 'updated_time'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_time'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    
    public function upload() {
        $structure = 'casting';

//        if ($this->validate()) {
        $struc_path = Yii::getAlias('@webroot') . '/' . Yii::$app->params['upload_dir'][$structure];

        if ($this->isNewRecord) {
            if (!is_dir($structure)) {
                FileHelper::createDirectory($struc_path);
            }
            $imagepath = Images::uploadFile($this, 'image_path', $structure);
            if ($imagepath['errorCode'] == 0) {
                // file is uploaded successfully
                $this->image_path = $imagepath['file'];
                return true;
            }
            return false;
        } else {
            if ($_FILES["Casting"]["name"]["image_path"] == null) {
                unset($this->image_path);
                return true;
            } else {
                if (!is_dir($structure)) {
                    FileHelper::createDirectory($struc_path);
                }
                $imagepath = Images::uploadFile($this, 'image_path', $structure);

                if ($imagepath['errorCode'] == 0) {
                    // file is uploaded successfully
                    $this->image_path = $imagepath['file'];
                    return true;
                }
                return false;
            }
        }
    }
    
    public function attributeLabels() {
        return [
            'name' => 'Tên',
            'movie_id' => 'Phim',
            'description' => 'Mô tả',
            'image_path' => 'Ảnh',
            'status' => 'Kích hoạt'
        ];
    }
    
     public function getAllMovie() {
        $query = Movie::find()->all();
        $list = [];
        if ($query) {
            foreach ($query as $vasService) {
                $list[$vasService->id] = $vasService->name;
            }
        }
        return $list;
    }
}
