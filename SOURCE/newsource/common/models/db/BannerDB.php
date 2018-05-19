<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "banner".
 *
 * @property string $id
 * @property string $name
 * @property integer $is_active
 * @property string $created_at
 * @property string $updated_at
 * @property string $link
 * @property string $image_path
 * @property string $description
 * @property string $short_description
 * @property integer $type_banner
 */
class BannerDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_active', 'type_banner'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name','short_description'], 'required'],
            [['name', 'link', 'short_description'], 'string', 'max' => 255],
            [['name', 'link', 'description', 'short_description','created_at', 'updated_at'], 'trim'],
            [['image_path'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg','maxSize' => 1024*1024,'message' => 'Dữ liệu không đúng định dạng'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'name' => Yii::t('backend', 'Name'),
            'is_active' => Yii::t('backend', 'Is Active'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'link' => Yii::t('backend', 'Link'),
            'image_path' => Yii::t('backend', 'Image Path'),
            'description' => Yii::t('backend', 'Description'),
            'short_description' => Yii::t('backend', 'Short Description'),
            'type_banner' => Yii::t('backend', 'Type Banner'),
        ];
    }
}
