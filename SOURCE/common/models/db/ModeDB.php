<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "mode".
 *
 * @property string $id
 * @property string $name
 * @property string $image_path
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $created_at
 * @property integer $created_by
 *
 * @property UserDB $updatedBy
 * @property UserDB $createdBy
 * @property ModulesDB[] $modules
 */
class ModeDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'image_path'], 'required'],
            [['updated_at', 'created_at'], 'safe'],
            [['updated_by', 'created_by'], 'integer'],
            [['name', 'image_path'], 'string', 'max' => 255]
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
            'image_path' => Yii::t('backend', 'Image Path'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'created_at' => Yii::t('backend', 'Created At'),
            'created_by' => Yii::t('backend', 'Created By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(UserDB::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(UserDB::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModules()
    {
        return $this->hasMany(ModulesDB::className(), ['mode_id' => 'id']);
    }
}
