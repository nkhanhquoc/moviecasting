<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "runtime_statistics".
 *
 * @property string $id
 * @property string $module_id
 * @property string $time_bom_doi_luu_1
 * @property string $time_bom_doi_luu_2
 * @property string $time_chay_bom_cap_nuoc_lanh_1
 * @property string $time_chay_bom_cap_nuoc_lanh_2
 * @property string $time_chay_bom_hoi_duong_ong_1
 * @property string $time_chay_bom_hoi_duong_ong_2
 * @property string $time_chay_bom_tang_ap_1
 * @property string $time_chay_bom_tang_ap_2
 * @property string $time_chay_bom_nhiet_bon_gia_nhiet_1
 * @property string $time_chay_bom_nhiet_bon_gia_nhiet_2
 * @property string $time_chay_van_dien_tu_ba_nga
 * @property string $time_chay_van_dien_tu_mot_chieu
 * @property string $du_phong
 *
 * @property ModulesDB $module
 */
class RuntimeStatisticsDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'runtime_statistics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_id'], 'required'],
            [['module_id'], 'integer'],
            [['time_bom_doi_luu_1', 'time_bom_doi_luu_2', 'time_chay_bom_cap_nuoc_lanh_1', 'time_chay_bom_cap_nuoc_lanh_2', 'time_chay_bom_hoi_duong_ong_1', 'time_chay_bom_hoi_duong_ong_2', 'time_chay_bom_tang_ap_1', 'time_chay_bom_tang_ap_2', 'time_chay_bom_nhiet_bon_gia_nhiet_1', 'time_chay_bom_nhiet_bon_gia_nhiet_2', 'time_chay_van_dien_tu_ba_nga', 'time_chay_van_dien_tu_mot_chieu', 'du_phong'], 'string', 'max' => 50],
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
            'time_bom_doi_luu_1' => Yii::t('backend', 'Time Bom Doi Luu 1'),
            'time_bom_doi_luu_2' => Yii::t('backend', 'Time Bom Doi Luu 2'),
            'time_chay_bom_cap_nuoc_lanh_1' => Yii::t('backend', 'Time Chay Bom Cap Nuoc Lanh 1'),
            'time_chay_bom_cap_nuoc_lanh_2' => Yii::t('backend', 'Time Chay Bom Cap Nuoc Lanh 2'),
            'time_chay_bom_hoi_duong_ong_1' => Yii::t('backend', 'Time Chay Bom Hoi Duong Ong 1'),
            'time_chay_bom_hoi_duong_ong_2' => Yii::t('backend', 'Time Chay Bom Hoi Duong Ong 2'),
            'time_chay_bom_tang_ap_1' => Yii::t('backend', 'Time Chay Bom Tang Ap 1'),
            'time_chay_bom_tang_ap_2' => Yii::t('backend', 'Time Chay Bom Tang Ap 2'),
            'time_chay_bom_nhiet_bon_gia_nhiet_1' => Yii::t('backend', 'Time Chay Bom Nhiet Bon Gia Nhiet 1'),
            'time_chay_bom_nhiet_bon_gia_nhiet_2' => Yii::t('backend', 'Time Chay Bom Nhiet Bon Gia Nhiet 2'),
            'time_chay_van_dien_tu_ba_nga' => Yii::t('backend', 'Time Chay Van Dien Tu Ba Nga'),
            'time_chay_van_dien_tu_mot_chieu' => Yii::t('backend', 'Time Chay Van Dien Tu Mot Chieu'),
            'du_phong' => Yii::t('backend', 'Du Phong'),
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
