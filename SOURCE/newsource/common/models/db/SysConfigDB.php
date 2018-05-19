<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "sys_config".
 *
 * @property string $id
 * @property string $config_key
 * @property string $config_value
 * @property string $description
 */
class SysConfigDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['config_key'], 'required'],
            [['config_value', 'description'], 'string'],
            [['config_key'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'config_key' => Yii::t('backend', 'Config Key'),
            'config_value' => Yii::t('backend', 'Config Value'),
            'description' => Yii::t('backend', 'Description'),
        ];
    }
}
