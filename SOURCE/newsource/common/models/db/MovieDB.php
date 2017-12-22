<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "movie".
 *
 * @property string $id
 * @property string $name
 * @property string $short_description
 * @property string $description
 * @property string $end_time
 * @property string $image_path
 * @property string $created_time
 * @property integer $type
 * @property string $updated_time
 * @property integer $status
 * @property integer $hot
 */
class MovieDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'movie';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['end_time', 'created_time', 'updated_time'], 'safe'],
            [['type', 'status', 'hot'], 'integer'],
            [['name', 'short_description', 'image_path'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 2000]
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
            'short_description' => Yii::t('backend', 'Short Description'),
            'description' => Yii::t('backend', 'Description'),
            'end_time' => Yii::t('backend', 'End Time'),
            'image_path' => Yii::t('backend', 'Image Path'),
            'created_time' => Yii::t('backend', 'Created Time'),
            'type' => Yii::t('backend', 'Type'),
            'updated_time' => Yii::t('backend', 'Updated Time'),
            'status' => Yii::t('backend', 'Status'),
            'hot' => Yii::t('backend', 'Hot'),
        ];
    }
}
