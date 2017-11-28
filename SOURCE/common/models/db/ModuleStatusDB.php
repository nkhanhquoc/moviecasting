<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "module_status".
 *
 * @property string $id
 * @property string $module_id
 * @property string $bom_doi_luu_1
 * @property string $bom_doi_luu_2
 * @property string $bom_cap_nuoc_lanh_1
 * @property string $bom_cap_nuoc_lanh_2
 * @property string $bom_hoi_duong_ong_1
 * @property string $bom_hoi_duong_ong_2
 * @property string $bom_tang_ap_1
 * @property string $bom_tang_ap_2
 * @property string $bom_ha_nhiet_bon_gia_nhiet_1
 * @property string $bom_ha_nhiet_bon_gia_nhiet_2
 * @property string $van_dien_tu_ba_nga
 * @property string $van_dien_tu_mot_chieu
 *
 * @property ModulesDB $module
 */
class ModuleStatusDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_id'], 'required'],
            [['module_id'], 'integer'],
            [['bom_doi_luu_1', 'bom_doi_luu_2', 'bom_cap_nuoc_lanh_1', 'bom_cap_nuoc_lanh_2', 'bom_hoi_duong_ong_1', 'bom_hoi_duong_ong_2', 'bom_tang_ap_1', 'bom_tang_ap_2', 'bom_ha_nhiet_bon_gia_nhiet_1', 'bom_ha_nhiet_bon_gia_nhiet_2', 'van_dien_tu_ba_nga', 'van_dien_tu_mot_chieu'], 'string', 'max' => 50],
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
            'bom_doi_luu_1' => Yii::t('backend', 'Bom Doi Luu 1'),
            'bom_doi_luu_2' => Yii::t('backend', 'Bom Doi Luu 2'),
            'bom_cap_nuoc_lanh_1' => Yii::t('backend', 'Bom Cap Nuoc Lanh 1'),
            'bom_cap_nuoc_lanh_2' => Yii::t('backend', 'Bom Cap Nuoc Lanh 2'),
            'bom_hoi_duong_ong_1' => Yii::t('backend', 'Bom Hoi Duong Ong 1'),
            'bom_hoi_duong_ong_2' => Yii::t('backend', 'Bom Hoi Duong Ong 2'),
            'bom_tang_ap_1' => Yii::t('backend', 'Bom Tang Ap 1'),
            'bom_tang_ap_2' => Yii::t('backend', 'Bom Tang Ap 2'),
            'bom_ha_nhiet_bon_gia_nhiet_1' => Yii::t('backend', 'Bom Ha Nhiet Bon Gia Nhiet 1'),
            'bom_ha_nhiet_bon_gia_nhiet_2' => Yii::t('backend', 'Bom Ha Nhiet Bon Gia Nhiet 2'),
            'van_dien_tu_ba_nga' => Yii::t('backend', 'Van Dien Tu Ba Nga'),
            'van_dien_tu_mot_chieu' => Yii::t('backend', 'Van Dien Tu Mot Chieu'),
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
