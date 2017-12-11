<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "help".
 *
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property integer $category
 * @property string $number_order
 * @property string $image_path
 * @property string $description
 * @property string $id
 */
class HelpDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'help';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['category', 'number_order'], 'integer'],
            [['image_path'], 'required'],
            [['name', 'image_path', 'description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('backend', 'Name'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'category' => Yii::t('backend', 'Category'),
            'number_order' => Yii::t('backend', 'Number Order'),
            'image_path' => Yii::t('backend', 'Image Path'),
            'description' => Yii::t('backend', 'Description'),
            'id' => Yii::t('backend', 'ID'),
        ];
    }
}
