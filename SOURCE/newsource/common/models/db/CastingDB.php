<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "casting".
 *
 * @property string $id
 * @property string $name
 * @property string $movie_id
 * @property string $description
 * @property string $image_path
 * @property string $created_time
 * @property string $updated_time
 * @property integer $status
 */
class CastingDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'casting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['movie_id', 'status'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['name', 'image_path'], 'string', 'max' => 255],
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
            'movie_id' => Yii::t('backend', 'Movie ID'),
            'description' => Yii::t('backend', 'Description'),
            'image_path' => Yii::t('backend', 'Image Path'),
            'created_time' => Yii::t('backend', 'Created Time'),
            'updated_time' => Yii::t('backend', 'Updated Time'),
            'status' => Yii::t('backend', 'Status'),
        ];
    }
}
