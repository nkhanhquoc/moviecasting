<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $image_path
 * @property string $created_time
 * @property string $updated_time
 * @property integer $status
 */
class NewsDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_time', 'updated_time'], 'safe'],
            [['status'], 'integer'],
            [['title', 'description', 'image_path'], 'string', 'max' => 255],
            [['content'], 'string', 'max' => 2000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'title' => Yii::t('backend', 'Title'),
            'description' => Yii::t('backend', 'Description'),
            'content' => Yii::t('backend', 'Content'),
            'image_path' => Yii::t('backend', 'Image Path'),
            'created_time' => Yii::t('backend', 'Created Time'),
            'updated_time' => Yii::t('backend', 'Updated Time'),
            'status' => Yii::t('backend', 'Status'),
        ];
    }
}
