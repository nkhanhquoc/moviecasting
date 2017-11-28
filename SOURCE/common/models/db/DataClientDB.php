<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "data_client".
 *
 * @property string $id
 * @property string $module_id
 * @property string $data
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 *
 * @property ModulesDB $module
 * @property UserDB $createdBy
 */
class DataClientDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'data_client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_id', 'data'], 'required'],
            [['module_id', 'status', 'created_by'], 'integer'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'module_id' => Yii::t('backend', 'Module ID'),
            'data' => Yii::t('backend', 'Data'),
            'status' => Yii::t('backend', 'Status'),
            'created_at' => Yii::t('backend', 'Created At'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_at' => Yii::t('backend', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(ModulesDB::className(), ['id' => 'module_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(UserDB::className(), ['id' => 'created_by']);
    }
}
