<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "param_config".
 *
 * @property string $id
 * @property string $module_id
 * @property string $convection_pump
 * @property string $cold_water_supply_pump
 * @property string $return_pump
 * @property string $incresed_pressure_pump
 * @property string $heat_pump
 * @property string $heat_resistor
 * @property string $three_way_valve
 * @property string $backflow_valve
 * @property string $reserved
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $created_at
 * @property integer $created_by
 *
 * @property ModulesDB $module
 * @property UserDB $updatedBy
 * @property UserDB $createdBy
 */
class ParamConfigDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'param_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_id'], 'required'],
            [['module_id', 'updated_by', 'created_by'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['convection_pump', 'cold_water_supply_pump', 'return_pump', 'incresed_pressure_pump', 'heat_pump', 'heat_resistor', 'three_way_valve', 'backflow_valve', 'reserved'], 'string', 'max' => 255]
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
            'convection_pump' => Yii::t('backend', 'Convection Pump'),
            'cold_water_supply_pump' => Yii::t('backend', 'Cold Water Supply Pump'),
            'return_pump' => Yii::t('backend', 'Return Pump'),
            'incresed_pressure_pump' => Yii::t('backend', 'Incresed Pressure Pump'),
            'heat_pump' => Yii::t('backend', 'Heat Pump'),
            'heat_resistor' => Yii::t('backend', 'Heat Resistor'),
            'three_way_valve' => Yii::t('backend', 'Three Way Valve'),
            'backflow_valve' => Yii::t('backend', 'Backflow Valve'),
            'reserved' => Yii::t('backend', 'Reserved'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'created_at' => Yii::t('backend', 'Created At'),
            'created_by' => Yii::t('backend', 'Created By'),
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
}
