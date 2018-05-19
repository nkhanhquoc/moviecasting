<?php
namespace backend\models;
#Created by  Nguyen Quoc Khanh
#Created on Dec 14, 2017, 9:49:45 PM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.
use Yii;
use common\models\NewsBase;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\FileHelper;
use common\libs\Images;
/**
 * Description of News
 *
 * @author Nguyen Quoc Khanh
 */
class News extends NewsBase{
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
        $structure = 'news';

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
            if ($_FILES["News"]["name"]["image_path"] == null) {
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
            'title' => 'Tiêu đề',
            'content' => 'Nội dung',
            'description' => 'Mô tả',
            'image_path' => 'Ảnh',
            'created_time'=>'Ngày tạo',
            'status' => "Trạng thái"
        ];
    }

}
