<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "game".
 *
 * @property string $id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 * @property string $link
 * @property string $image_path
 */
class GameDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'link', 'image_path'], 'string', 'max' => 255],
            [['name','link'],'trim'],
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
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'status' => Yii::t('backend', 'Status'),
            'link' => Yii::t('backend', 'Link'),
            'image_path' => Yii::t('backend', 'Image Path'),
        ];
    }
}
