<?php

namespace common\socket;

class Socket {

    public $id;
    public $ie;
    public $data;
    public $moduleId;
    public $module;
    public $msisdn;

    function getId() {
        return $this->id;
    }

    function getIe() {
        return $this->ie;
    }

    function getData() {
        return $this->data;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIe($ie) {
        $this->ie = $ie;
    }

    function setData($data) {
        $this->data = $data;
    }

    function getModuleId() {
        return $this->moduleId;
    }

    function getModule() {
        return $this->module;
    }

    function setModule($module) {
        $customerCode = self::bin2dec(substr($module, 40));
        \Yii::info('customerCode: ' . $customerCode);
        $this->module = \backend\models\Modules::find()->where(['customer_code' => $customerCode])->one();
    }

    function setModuleId() {
        $module = $this->module;
        if ($module) {
            $this->moduleId = $module->id;
            \Yii::info('moduleId: ' . $module->id);
        }
    }

    public function __construct($str) {
        \Yii::info('data client: ' . $str);
        $this->id = substr($str, 0, 64);
        $this->setModule($this->id);
        $this->setModuleId();
        $this->ie = substr($str, 64, 8);
        $this->data = substr($str, 72);
        \Yii::info('IE name : ' . $this->ie);
        switch ($this->ie) {
            case OUTPUT_MODE_IE_NAME:
                $mode = \backend\models\OutputMode::find()->where(['module_id' => intval($this->moduleId)])->one();
                if (!$mode) {
                    $mode = new \backend\models\OutputMode();
                    $mode->module_id = intval($this->moduleId);
                }
                $mode->convection_pump = substr($this->data, 0, 24);
                $mode->cold_water_supply_pump = substr($this->data, 24, 24);
                $mode->return_pump = substr($this->data, 24 * 2, 24);
                $mode->incresed_pressure_pump = substr($this->data, 24 * 3, 24);
                $mode->heat_pump = substr($this->data, 24 * 4, 24);
                $mode->heater_resister = substr($this->data, 24 * 5, 24);
                $mode->three_way_valve = substr($this->data, 24 * 6, 24);
                $mode->backflow_valve = substr($this->data, 24 * 7, 24);
                $mode->reserved = substr($this->data, 24 * 8, 24);
                $mode->save(false);
                break;
            case PARAMETTER_IE_NAME:
                $mode = \backend\models\ParamConfig::find()->where(['module_id' => intval($this->moduleId)])->one();
                if (!$mode) {
                    $mode = new \backend\models\ParamConfig();
                    $mode->module_id = intval($this->moduleId);
                }
                $mode->convection_pump = substr($this->data, 0, 8);
                $mode->cold_water_supply_pump = substr($this->data, 8, 16);
                $mode->return_pump = substr($this->data, 8 * 3, 40);
                $mode->incresed_pressure_pump = substr($this->data, 8 * 8, 8);
                $mode->heat_pump = substr($this->data, 8 * 9, 8);
                $mode->heat_resistor = substr($this->data, 8 * 10, 8);
                $mode->three_way_valve = substr($this->data, 8 * 11, 16);
                $mode->backflow_valve = substr($this->data, 8 * 13, 40);
                $mode->reserved = substr($this->data, 8 * 18, 8);
                $mode->save(false);
                break;
            case TIMER_COUNTER_IE_NAME:
                $mode = \backend\models\TimerCounter::find()->where(['module_id' => intval($this->moduleId)])->one();
                if (!$mode) {
                    $mode = new \backend\models\TimerCounter();
                    $mode->module_id = intval($this->moduleId);
                }
                $mode->counter = substr($this->data, 0, 8);
                $mode->timer_1 = substr($this->data, 8, 8);
                $mode->timer_2 = substr($this->data, 8 * 2, 8);
                $mode->timer_3 = substr($this->data, 8 * 3, 8);
                $mode->save(false);
                break;
            case ON_OFF_STATUS_IE_NAME:
                $mode = \backend\models\ModuleStatus::find()->where(['module_id' => intval($this->moduleId)])->one();
                if (!$mode) {
                    $mode = new \backend\models\ModuleStatus();
                    $mode->module_id = intval($this->moduleId);
                }
                $mode->bom_doi_luu_1 = substr($this->data, 0, 8);
                $mode->bom_doi_luu_2 = substr($this->data, 8, 8);
                $mode->bom_cap_nuoc_lanh_1 = substr($this->data, 8 * 2, 8);
                $mode->bom_cap_nuoc_lanh_2 = substr($this->data, 8 * 3, 8);
                $mode->bom_hoi_duong_ong_1 = substr($this->data, 8 * 4, 8);
                $mode->bom_hoi_duong_ong_2 = substr($this->data, 8 * 5, 8);
                $mode->bom_tang_ap_1 = substr($this->data, 8 * 6, 8);
                $mode->bom_tang_ap_2 = substr($this->data, 8 * 7, 8);
                $mode->bom_ha_nhiet_bon_gia_nhiet_1 = substr($this->data, 8 * 8, 8);
                $mode->bom_ha_nhiet_bon_gia_nhiet_2 = substr($this->data, 8 * 9, 8);
                $mode->van_dien_tu_ba_nga = substr($this->data, 8 * 10, 8);
                $mode->van_dien_tu_mot_chieu = substr($this->data, 8 * 11, 8);
                $mode->save(false);
                break;
            case RUNTIM_STATISTICS_IE_NAME:
                $mode = \backend\models\RuntimeStatistics::find()->where(['module_id' => intval($this->moduleId)])->one();
                if (!$mode) {
                    $mode = new \backend\models\RuntimeStatistics();
                    $mode->module_id = intval($this->moduleId);
                }
                $mode->time_bom_doi_luu_1 = substr($this->data, 0, 8);
                $mode->time_bom_doi_luu_2 = substr($this->data, 8, 8);
                $mode->time_chay_bom_cap_nuoc_lanh_1 = substr($this->data, 8 * 2, 8);
                $mode->time_chay_bom_cap_nuoc_lanh_2 = substr($this->data, 8 * 3, 8);
                $mode->time_chay_bom_hoi_duong_ong_1 = substr($this->data, 8 * 4, 8);
                $mode->time_chay_bom_hoi_duong_ong_2 = substr($this->data, 8 * 5, 8);
                $mode->time_chay_bom_tang_ap_1 = substr($this->data, 8 * 6, 8);
                $mode->time_chay_bom_tang_ap_2 = substr($this->data, 8 * 7, 8);
                $mode->time_chay_bom_nhiet_bon_gia_nhiet_1 = substr($this->data, 8 * 8, 8);
                $mode->time_chay_bom_nhiet_bon_gia_nhiet_2 = substr($this->data, 8 * 9, 8);
                $mode->time_chay_van_dien_tu_ba_nga = substr($this->data, 8 * 10, 8);
                $mode->time_chay_van_dien_tu_mot_chieu = substr($this->data, 8 * 11, 8);
                $mode->du_phong = substr($this->data, 8 * 12, 8);
                $mode->save(false);
                break;
            case SENSOR_VALUE_IE_NAME:
                $mode = \backend\models\Sensor::find()->where(['module_id' => intval($this->moduleId)])->one();
                if (!$mode) {
                    $mode = new \backend\models\Sensor();
                    $mode->module_id = intval($this->moduleId);
                }
                $mode->cam_bien_dan_thu = substr($this->data, 0, 8);
                $mode->cam_bien_bon_solar = substr($this->data, 8, 8);
                $mode->cam_bien_muc_nuoc_bon_solar = substr($this->data, 8 * 2, 8);
                $mode->cam_bien_nhiet_do_bon_gia_nhiet = substr($this->data, 8 * 3, 8);
                $mode->cam_bien_ap_suat_bon_gia_nhiet = substr($this->data, 8 * 4, 8);
                $mode->cam_bien_ap_suat_duong_ong = substr($this->data, 8 * 5, 8);
                $mode->cam_bien_nhiet_do_duong_ong = substr($this->data, 8 * 6, 8);
                $mode->cam_bien_nhiet_dinh_bon_solar = substr($this->data, 8 * 7, 8);
                $mode->cam_bien_tran = substr($this->data, 8 * 8, 8);
                $mode->du_phong = substr($this->data, 8 * 9, 8);
                $mode->save(false);
                break;
            case CREATE_MODELE:
                $msisdn = self::bin2dec($this->data);
                if ($msisdn) {
                    $mode = \backend\models\Modules::find()->where(['msisdn' => $msisdn])->one();
                    if (!$mode) {
                        $mode = new \backend\models\Modules();
                        $mode->msisdn = $msisdn;
                        $mode->save(false);
                    }
                }
                break;
        }
    }

    public static function bin2dec($str) {
        $dec = '';
        $len = strlen($str);
        $sub = '';
        for ($i = 0; $i < $len; $i ++) {
            $sub .= $str[$i];
            if (strlen($sub) == 4) {
                $dec .= bindec($sub);
                $sub = '';
            }
        }
        return $dec;
    }

    public static function dec2bin($str) {
        $bin = '';
        $len = strlen($str);
        for ($i = 0; $i < $len; $i ++) {
            $sub = decbin($str[$i]);
            while (strlen($sub) < 4) {
                $sub = '0' . $sub;
            }
            $bin .= $sub;
        }
        return $bin;
    }

}
