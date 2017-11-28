<?php

namespace console\models;

use common\models\ReportDailyBase;
use Yii;

class ReportDaily extends ReportDailyBase {

    public static function revenue($fromDate = null, $toDate = null) {
        date_default_timezone_set('Asia/Saigon');
        error_reporting(0);
        if ($fromDate == null) {
            $fromDate = date('Y-m-d', strtotime('-1 day'));
            $toDate = date('Y-m-d');
        }
        $dailyPackage = 1;
        $weeklyPackage = 2;
        $downloadCMD = 'DOWNLOAD';
        $registerCMD = 'REGISTER';
        $cancelCMD = 'CANCEL';
        $monfeeCMD = 'MONFEE';
        while (strtotime($fromDate) < strtotime($toDate)) {
            $data = [];
            $time = date('Y-m-d', strtotime($fromDate));
            Yii::info("report revenue start for $time", 'report');
            $toTime = date('Y-m-d', strtotime($time . '+1 day'));
            //Daily revenue
            $dailyRevenue = Yii::$app->db->createCommand("SELECT SUM(price) AS total FROM `transaction` WHERE `package_id`=$dailyPackage AND `created_time` >= '$time' AND `created_time` < '$toTime'")->queryOne();
            $data['REVENUE']['DAILY'] = ($dailyRevenue) ? intval($dailyRevenue['total']) : 0;
            Yii::info("['REVENUE']['DAILY'] = " . $data['REVENUE']['DAILY'], 'report');
            //Weekly revenue
            $dailyRevenue = Yii::$app->db->createCommand("SELECT SUM(price) AS total FROM `transaction` WHERE `package_id`=$weeklyPackage AND `created_time` >= '$time' AND `created_time` < '$toTime'")->queryOne();
            $data['REVENUE']['WEEKLY'] = ($dailyRevenue) ? intval($dailyRevenue['total']) : 0;
            Yii::info("['REVENUE']['WEEKLY'] = " . $data['REVENUE']['WEEKLY'], 'report');
            //Download revenue
            $dailyRevenue = Yii::$app->db->createCommand("SELECT SUM(price) AS total FROM `transaction` WHERE `action`='$downloadCMD' AND `created_time` >= '$time' AND `created_time` < '$toTime'")->queryOne();
            $data['REVENUE']['DOWNLOAD'] = ($dailyRevenue) ? intval($dailyRevenue['total']) : 0;
            Yii::info("['REVENUE']['DOWNLOAD'] = " . $data['REVENUE']['DOWNLOAD'], 'report');
            //Monfee revenue
            $dailyRevenue = Yii::$app->db->createCommand("SELECT SUM(price) AS total FROM `transaction` WHERE `action`='$monfeeCMD' AND `created_time` >= '$time' AND `created_time` < '$toTime'")->queryOne();
            $data['REVENUE']['MONFEE'] = ($dailyRevenue) ? intval($dailyRevenue['total']) : 0;
            Yii::info("['REVENUE']['MONFEE'] = " . $data['REVENUE']['MONFEE'], 'report');
            //new register
            $dailyRevenue = Yii::$app->db->createCommand("SELECT COUNT(`msisdn`) AS total FROM `transaction` WHERE `action`='$registerCMD' AND `created_time` >= '$time' AND `created_time` < '$toTime'")->queryOne();
            $data['SUB']['REGISTER'] = ($dailyRevenue) ? intval($dailyRevenue['total']) : 0;
            Yii::info("['SUB']['REGISTER'] = " . $data['SUB']['REGISTER'], 'report');
            //cancel
            $dailyRevenue = Yii::$app->db->createCommand("SELECT COUNT(`msisdn`) AS total FROM `transaction` WHERE `action`='$cancelCMD' AND `created_time` >= '$time' AND `created_time` < '$toTime'")->queryOne();
            $data['SUB']['CANCEL'] = ($dailyRevenue) ? intval($dailyRevenue['total']) : 0;
            Yii::info("['SUB']['CANCEL'] = " . $data['SUB']['CANCEL'], 'report');
            //sub active
            $dailyRevenue = Yii::$app->db->createCommand("SELECT COUNT(*) AS total FROM `user_package` WHERE `expired_time` > NOW() AND `active` = 1")->queryOne();
            $data['SUB']['ACTIVE'] = ($dailyRevenue) ? intval($dailyRevenue['total']) : 0;
            Yii::info("['SUB']['ACTIVE'] = " . $data['SUB']['ACTIVE'], 'report');
            //sub total
            $dailyRevenue = Yii::$app->db->createCommand("SELECT COUNT(*) AS total FROM `user_package` WHERE `active` = 1")->queryOne();
            $data['SUB']['TOTAL'] = ($dailyRevenue) ? intval($dailyRevenue['total']) : 0;
            Yii::info("['SUB']['TOTAL'] = " . $data['SUB']['TOTAL'], 'report');

            $report = ReportDailyBase::find()->where(['cp_id' => 0, 'datetime' => $time, 'name' => 'revenue'])->one();
            if ($report) {
                $report->value = json_encode($data);
            } else {
                $report = new ReportDailyBase();
                $report->cp_id = 0;
                $report->datetime = $time;
                $report->name = 'revenue';
                $report->value = json_encode($data);
            }
            $report->save(false);

            Yii::info("report revenue done for $time", 'report');
            $fromDate = date('Y-m-d', strtotime($time . '+1 day'));
        }
    }

    public static function subs($fromDate = null, $toDate = null) {
        date_default_timezone_set('Asia/Saigon');
        error_reporting(0);
        if ($fromDate == null) {
            $fromDate = date('Y-m-d', strtotime('-1 day'));
            $toDate = date('Y-m-d');
        }
        $dailyPackage = 1;
        $weeklyPackage = 2;
        $downloadCMD = 'DOWNLOAD';
        $registerCMD = 'REGISTER';
        $cancelCMD = 'CANCEL';
        $monfeeCMD = 'MONFEE';
        while (strtotime($fromDate) < strtotime($toDate)) {
            $data = [];
            $time = date('Y-m-d', strtotime($fromDate));
            Yii::info("report revenue start for $time", 'report');
            $toTime = date('Y-m-d', strtotime($time . '+1 day'));
            //Register new
            $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) as total FROM `transaction` WHERE `action`='$registerCMD' AND `created_time` >= '$time' AND `created_time` < '$toTime'")->queryOne();
            $data['REGISTER']['NEW'] = ($result) ? intval($result['total']) : 0;
            Yii::info("['REGISTER']['NEW'] = " . $data['REGISTER']['NEW'], 'report');
            //Register via wap
            $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) as total FROM `transaction` WHERE `action`='$registerCMD' AND method='wap' AND `created_time` >= '$time' AND `created_time` < '$toTime'")->queryOne();
            $data['REGISTER']['WAP'] = ($result) ? intval($result['total']) : 0;
            Yii::info("['REGISTER']['WAP'] = " . $data['REGISTER']['WAP'], 'report');
            //Register via sms
            $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) as total FROM `transaction` WHERE `action`='$registerCMD' AND method='sms' AND `created_time` >= '$time' AND `created_time` < '$toTime'")->queryOne();
            $data['REGISTER']['SMS'] = ($result) ? intval($result['total']) : 0;
            Yii::info("['REGISTER']['SMS'] = " . $data['REGISTER']['SMS'], 'report');
            //Cancel by system
            $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) as total FROM `transaction` WHERE `action`='$cancelCMD' AND method='cron' AND `created_time` >= '$time' AND `created_time` < '$toTime'")->queryOne();
            $data['CANCEL']['CRON'] = ($result) ? intval($result['total']) : 0;
            Yii::info("['CANCEL']['CRON'] = " . $data['CANCEL']['CRON'], 'report');
            //Cancel by user
            $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) as total FROM `transaction` WHERE `action`='$cancelCMD' AND method <> 'cron' AND `created_time` >= '$time' AND `created_time` < '$toTime'")->queryOne();
            $data['CANCEL']['USER'] = ($result) ? intval($result['total']) : 0;
            Yii::info("['CANCEL']['USER'] = " . $data['CANCEL']['USER'], 'report');
            //TB luy ke
            $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) AS total FROM `user_package` WHERE `active` > 0")->queryOne();
            $data['SUBS']['TOTAL'] = ($result) ? intval($result['total']) : 0;
            Yii::info("['SUBS']['TOTAL'] = " . $data['SUBS']['TOTAL'], 'report');
            //TB luy ke goi ngay
            $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) AS total FROM `user_package` WHERE `active` > 0 AND `package_id`=$dailyPackage")->queryOne();
            $data['SUBS']['DAILY']['TOTAL'] = ($result) ? intval($result['total']) : 0;
            Yii::info("['SUBS']['DAILY']['TOTAL'] = " . $data['SUBS']['DAILY']['TOTAL'], 'report');
            //TB luy ke goi tuan
            $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) AS total FROM `user_package` WHERE `active` > 0 AND `package_id`=$weeklyPackage")->queryOne();
            $data['SUBS']['WEEKLY']['TOTAL'] = ($result) ? intval($result['total']) : 0;
            Yii::info("['SUBS']['WEEKLY']['TOTAL'] = " . $data['SUBS']['WEEKLY']['TOTAL'], 'report');
            //TB active
            $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) AS total FROM `user_package` WHERE `active` = 1")->queryOne();
            $data['SUBS']['ACTIVE'] = ($result) ? intval($result['total']) : 0;
            Yii::info("['SUBS']['ACTIVE'] = " . $data['SUBS']['ACTIVE'], 'report');
            //TB luy ke goi ngay active
            $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) AS total FROM `user_package` WHERE `active` = 1 AND `package_id`=$dailyPackage")->queryOne();
            $data['SUBS']['DAILY']['ACTIVE'] = ($result) ? intval($result['total']) : 0;
            Yii::info("['SUBS']['DAILY']['ACTIVE'] = " . $data['SUBS']['DAILY']['ACTIVE'], 'report');
            //TB luy ke goi tuan active
            $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) AS total FROM `user_package` WHERE `active` = 1 AND `package_id`=$weeklyPackage")->queryOne();
            $data['SUBS']['WEEKLY']['ACTIVE'] = ($result) ? intval($result['total']) : 0;
            Yii::info("['SUBS']['WEEKLY']['ACTIVE'] = " . $data['SUBS']['WEEKLY']['ACTIVE'], 'report');
            //TB gia han thanh cong
            $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) as total FROM `transaction` WHERE `action`='$monfeeCMD' AND `created_time` >= '$time' AND `created_time` < '$toTime'")->queryOne();
            $data['MONFEE']['TOTAL']['SUCCESS'] = ($result) ? intval($result['total']) : 0;
            Yii::info("['MONFEE']['TOTAL']['SUCCESS'] = " . $data['MONFEE']['TOTAL']['SUCCESS'], 'report');
            //TB gia han thanh cong goi ngay
            $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) as total FROM `transaction` WHERE `action`='$monfeeCMD' AND `package_id`=$dailyPackage AND `created_time` >= '$time' AND `created_time` < '$toTime'")->queryOne();
            $data['MONFEE']['DAILY']['SUCCESS'] = ($result) ? intval($result['total']) : 0;
            Yii::info("['MONFEE']['DAILY']['SUCCESS'] = " . $data['MONFEE']['DAILY']['SUCCESS'], 'report');
            //TB gia han thanh cong goi tuan
            $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) as total FROM `transaction` WHERE `action`='$monfeeCMD' AND `package_id`=$weeklyPackage AND `created_time` >= '$time' AND `created_time` < '$toTime'")->queryOne();
            $data['MONFEE']['WEEKLY']['SUCCESS'] = ($result) ? intval($result['total']) : 0;
            Yii::info("['MONFEE']['WEEKLY']['SUCCESS'] = " . $data['MONFEE']['WEEKLY']['SUCCESS'], 'report');

            //TB gia han that bai
            $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) as total FROM `transaction_error` WHERE `action`='$monfeeCMD' AND `created_time` >= '$time' AND `created_time` < '$toTime'")->queryOne();
            $data['MONFEE']['TOTAL']['ERROR'] = ($result) ? intval($result['total']) : 0;
            Yii::info("['MONFEE']['TOTAL']['ERROR'] = " . $data['MONFEE']['TOTAL']['ERROR'], 'report');
            //TB gia han that bai goi ngay
            $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) as total FROM `transaction_error` WHERE `action`='$monfeeCMD' AND `package_id`=$dailyPackage AND `created_time` >= '$time' AND `created_time` < '$toTime'")->queryOne();
            $data['MONFEE']['DAILY']['ERROR'] = ($result) ? intval($result['total']) : 0;
            Yii::info("['MONFEE']['DAILY']['ERROR'] = " . $data['MONFEE']['DAILY']['ERROR'], 'report');
            //TB gia han that bai goi tuan
            $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) as total FROM `transaction_error` WHERE `action`='$monfeeCMD' AND `package_id`=$weeklyPackage AND `created_time` >= '$time' AND `created_time` < '$toTime'")->queryOne();
            $data['MONFEE']['WEEKLY']['ERROR'] = ($result) ? intval($result['total']) : 0;
            Yii::info("['MONFEE']['WEEKLY']['ERROR'] = " . $data['MONFEE']['WEEKLY']['ERROR'], 'report');

            //Tong luot truy cap
            $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) as total FROM `session` WHERE `created_time` >= '$time' AND `created_time` < '$toTime'")->queryOne();
            $data['SESSION']['TOTAL'] = ($result) ? intval($result['total']) : 0;
            Yii::info("['SESSION']['TOTAL'] = " . $data['SESSION']['TOTAL'], 'report');

            $report = ReportDailyBase::find()->where(['cp_id' => 0, 'datetime' => $time, 'name' => 'subs'])->one();
            if ($report) {
                $report->value = json_encode($data);
            } else {
                $report = new ReportDailyBase();
                $report->cp_id = 0;
                $report->datetime = $time;
                $report->name = 'subs';
                $report->value = json_encode($data);
            }
            $report->save(false);

            Yii::info("report revenue done for $time", 'report');
            $fromDate = date('Y-m-d', strtotime($time . '+1 day'));
        }
    }

    public static function content($fromDate = null, $toDate = null) {
        $type = 'content';
        date_default_timezone_set('Asia/Saigon');
        error_reporting(0);
        if ($fromDate == null) {
            $fromDate = date('Y-m-d', strtotime('-1 day'));
            $toDate = date('Y-m-d');
        }
        while (strtotime($fromDate) < strtotime($toDate)) {
            $data = [];
            $time = date('Y-m-d', strtotime($fromDate));
            Yii::info("report $type start for $time", 'report');
            $toTime = date('Y-m-d', strtotime($time . '+1 day'));
            //category
            $categorys = \backend\models\VtArticleCategories::getListParentCategory1();
            foreach ($categorys as $id => $name) {
                if ($id) {
                    //video
                    $result = Yii::$app->db->createCommand("SELECT COUNT(*) as total FROM `video` WHERE `category_id`=:cat", ['cat' => $id])->queryOne();
                    $data[$name]['VIDEO']['TOTAL'] = ($result) ? intval($result['total']) : 0;
                    //article
                    $result = Yii::$app->db->createCommand("SELECT COUNT(*) as total FROM `article_items` WHERE `category_id`=:cat", ['cat' => $id])->queryOne();
                    $data[$name]['ARTICLE']['TOTAL'] = ($result) ? intval($result['total']) : 0;
                    //Tong luot truy cap video
                    $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) as total FROM `watching_list` WHERE `category_id`=:cat AND `started_time` >= '$time' AND `started_time` < '$toTime'", ['cat' => $id])->queryOne();
                    $data[$name]['VIDEO']['ACCESS'] = ($result) ? intval($result['total']) : 0;
                    //Tong luot truy cap article
                    $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) as total FROM `article_view` WHERE `category_id`=:cat AND `started_time` >= '$time' AND `started_time` < '$toTime'", ['cat' => $id])->queryOne();
                    $data[$name]['ARTICLE']['ACCESS'] = ($result) ? intval($result['total']) : 0;
                }
            }

            $report = ReportDailyBase::find()->where(['cp_id' => 0, 'datetime' => $time, 'name' => $type])->one();
            if ($report) {
                $report->value = json_encode($data);
            } else {
                $report = new ReportDailyBase();
                $report->cp_id = 0;
                $report->datetime = $time;
                $report->name = $type;
                $report->value = json_encode($data);
            }
            $report->save(false);

            Yii::info("report $type done for $time", 'report');
            $fromDate = date('Y-m-d', strtotime($time . '+1 day'));
        }
    }

    public static function medialink($fromDate = null, $toDate = null) {
        $type = 'medialink';
        date_default_timezone_set('Asia/Saigon');
        error_reporting(0);
        if ($fromDate == null) {
            $fromDate = date('Y-m-d', strtotime('-1 day'));
            $toDate = date('Y-m-d');
        }
        $dailyPackage = 1;
        $weeklyPackage = 2;
        $downloadCMD = 'DOWNLOAD';
        $registerCMD = 'REGISTER';
        $cancelCMD = 'CANCEL';
        $monfeeCMD = 'MONFEE';
        while (strtotime($fromDate) < strtotime($toDate)) {
            $data = [];
            $time = date('Y-m-d', strtotime($fromDate));
            Yii::info("report $type start for $time", 'report');
            $toTime = date('Y-m-d', strtotime($time . '+1 day'));
            //media link
            $mediaLink = \common\models\MediaLinksBase::findAll();
            foreach ($mediaLink as $item) {
                //access
                $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) as total FROM `session` WHERE `source`=:source AND `created_time` >= '$time' AND `created_time` < '$toTime'", ['source' => $item->name])->queryOne();
                $data[$item->name]['ACCESS'] = ($result) ? intval($result['total']) : 0;
                //register
                $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) AS total FROM `transaction` WHERE `source`=:source AND `action`='$registerCMD' AND `created_time` >= '$time' AND `created_time` < '$toTime'", ['source' => $item->name])->queryOne();
                $data[$item->name]['REGISTER'] = ($result) ? intval($result['total']) : 0;
                //So tb bi huy
                $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) AS total FROM `transaction` WHERE `source`=:source AND `action`='$cancelCMD' AND method='cron' AND `created_time` >= '$time' AND `created_time` < '$toTime'", ['source' => $item->name])->queryOne();
                $data[$item->name]['CANCEL']['CRON'] = ($result) ? intval($result['total']) : 0;
                //So tb tu huy
                $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) AS total FROM `transaction` WHERE `source`=:source AND `action`='$cancelCMD' AND method <> 'cron' AND `created_time` >= '$time' AND `created_time` < '$toTime'", ['source' => $item->name])->queryOne();
                $data[$item->name]['CANCEL']['USER'] = ($result) ? intval($result['total']) : 0;
                //So luot gia han
                $result = Yii::$app->db_app->createCommand("SELECT COUNT(*) AS total FROM `transaction` WHERE `source`=:source AND `action`='$monfeeCMD' AND `created_time` >= '$time' AND `created_time` < '$toTime'", ['source' => $item->name])->queryOne();
                $data[$item->name]['MONFEE']['TOTAL'] = ($result) ? intval($result['total']) : 0;
                //doanh thu
                $result = Yii::$app->db_app->createCommand("SELECT sum(price) AS total FROM `transaction` WHERE `source`=:source AND `created_time` >= '$time' AND `created_time` < '$toTime'", ['source' => $item->name])->queryOne();
                $data[$item->name]['REVENUE'] = ($result) ? intval($result['total']) : 0;
            }

            $report = ReportDailyBase::find()->where(['cp_id' => 0, 'datetime' => $time, 'name' => $type])->one();
            if ($report) {
                $report->value = json_encode($data);
            } else {
                $report = new ReportDailyBase();
                $report->cp_id = 0;
                $report->datetime = $time;
                $report->name = $type;
                $report->value = json_encode($data);
            }
            $report->save(false);

            Yii::info("report $type done for $time", 'report');
            $fromDate = date('Y-m-d', strtotime($time . '+1 day'));
        }
    }

}
