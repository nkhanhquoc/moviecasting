<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "modules".
 *
 * @property string $id
 * @property string $name
 * @property string $msisdn
 * @property string $mode_id
 * @property string $country_id
 * @property string $privincial_id
 * @property string $distric_id
 * @property string $customer_code
 * @property string $address
 * @property string $alarm
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 * @property string $money
 *
 * @property DataClientDB[] $dataClients
 * @property ModuleStatusDB[] $moduleStatuses
 * @property ModeDB $mode
 * @property CountryDB $country
 * @property ProvincialDB $privincial
 * @property DistricDB $distric
 * @property UserDB $createdBy
 * @property UserDB $updatedBy
 * @property OutputModeDB[] $outputModes
 * @property ParamConfigDB[] $paramConfigs
 * @property RuntimeStatisticsDB[] $runtimeStatistics
 * @property SensorDB[] $sensors
 * @property TimerCounterDB[] $timerCounters
 */
class ModulesDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modules';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['msisdn'], 'required'],
            [['mode_id', 'country_id', 'privincial_id', 'distric_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'address'], 'string', 'max' => 255],
            [['msisdn'], 'string', 'max' => 15],
            [['customer_code'], 'string', 'max' => 100],
            [['alarm', 'money'], 'string', 'max' => 50],
            [['customer_code'], 'unique']
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
            'msisdn' => Yii::t('backend', 'Msisdn'),
            'mode_id' => Yii::t('backend', 'Mode ID'),
            'country_id' => Yii::t('backend', 'Country ID'),
            'privincial_id' => Yii::t('backend', 'Privincial ID'),
            'distric_id' => Yii::t('backend', 'Distric ID'),
            'customer_code' => Yii::t('backend', 'Customer Code'),
            'address' => Yii::t('backend', 'Address'),
            'alarm' => Yii::t('backend', 'Alarm'),
            'created_by' => Yii::t('backend', 'Created By'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'money' => Yii::t('backend', 'Money'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDataClients()
    {
        return $this->hasMany(DataClientDB::className(), ['module_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleStatuses()
    {
        return $this->hasMany(ModuleStatusDB::className(), ['module_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMode()
    {
        return $this->hasOne(ModeDB::className(), ['id' => 'mode_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(CountryDB::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrivincial()
    {
        return $this->hasOne(ProvincialDB::className(), ['id' => 'privincial_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistric()
    {
        return $this->hasOne(DistricDB::className(), ['id' => 'distric_id']);
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
    public function getUpdatedBy()
    {
        return $this->hasOne(UserDB::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOutputModes()
    {
        return $this->hasMany(OutputModeDB::className(), ['module_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParamConfigs()
    {
        return $this->hasMany(ParamConfigDB::className(), ['module_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuntimeStatistics()
    {
        return $this->hasMany(RuntimeStatisticsDB::className(), ['module_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSensors()
    {
        return $this->hasMany(SensorDB::className(), ['module_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimerCounters()
    {
        return $this->hasMany(TimerCounterDB::className(), ['module_id' => 'id']);
    }
}
