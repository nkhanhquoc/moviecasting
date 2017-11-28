<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "timer_counter".
 *
 * @property string $id
 * @property string $module_id
 * @property string $counter
 * @property string $timer_1
 * @property string $timer_2
 * @property string $timer_3
 *
 * @property ModulesDB $module
 */
class TimerCounterDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'timer_counter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_id'], 'required'],
            [['module_id'], 'integer'],
            [['counter', 'timer_1', 'timer_2', 'timer_3'], 'string', 'max' => 50],
            [['module_id'], 'unique']
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
            'counter' => Yii::t('backend', 'Counter'),
            'timer_1' => Yii::t('backend', 'Timer 1'),
            'timer_2' => Yii::t('backend', 'Timer 2'),
            'timer_3' => Yii::t('backend', 'Timer 3'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(ModulesDB::className(), ['id' => 'module_id']);
    }
}
