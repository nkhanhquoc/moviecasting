<?php

namespace console\controllers;

use yii\console\Controller;

class ReportController extends Controller {

    public function actionIndex($fromDate = null, $toDate = null) {
        echo "fromDate: $fromDate\n";
        echo "toDate: $toDate\n";
        echo 'start at ' . date('Y-m-d H:i:s') . "\n";
        \console\models\ReportDaily::revenue($fromDate, $toDate);
        \console\models\ReportDaily::subs($fromDate, $toDate);
        \console\models\ReportDaily::content($fromDate, $toDate);
        \console\models\ReportDaily::medialink($fromDate, $toDate);
        echo 'done at ' . date('Y-m-d H:i:s') . "\n";
    }

}
