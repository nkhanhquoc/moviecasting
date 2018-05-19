<?php

namespace backend\controllers;

#Created by  Nguyen Quoc Khanh
#Created on Dec 13, 2017, 9:35:58 PM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.

use backend\models\Register;
use backend\models\RegisterSearch;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * Description of RegisterController
 *
 * @author Nguyen Quoc Khanh
 */
class RegisterController extends AppController {
    //put your code here

    /**
     * Displays a single Game model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('update', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Lists all Game models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new RegisterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Game model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Game the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Register::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Updates an existing Game model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $params = Yii::$app->request->post();
            $star = $params['Register']['star'];
            $p1 = $model->uploadPortrait('portrait');
            $p2 = $model->uploadPortrait('portrait_2');
            $p3 = $model->uploadPortrait('portrait_3');
            if ($star < 6 && $star > 0 && ($p1 || $p2 || $p3)) {
                $model->save();
                Yii::$app->session->setFlash('success', "Cập nhật thành công!");
//                return $this->render('update', [
//                            'model' => $model,
//                ]);
            } else {
                Yii::$app->session->setFlash('error', "Cập nhật thất bại!");
//                return $this->render('update', [
//                            'model' => $model,
//                ]);
            }
            $model = $this->findModel($id);
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Creates a new Game model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Register();
        if ($model->load(Yii::$app->request->post())) {
            if ($_FILES["Register"]["name"]["portrait"] == null && $_FILES["Register"]["name"]["portrait_2"] == null && $_FILES["Register"]["name"]["portrait_3"] == null) {
                $model->addError('portrait', 'Ảnh chân dung không được để trống.');
                return $this->render('create', [
                            'model' => $model,
                ]);
            } else {
                $p1 = $model->uploadPortrait('portrait');
                $p2 = $model->uploadPortrait('portrait_2');
                $p3 = $model->uploadPortrait('portrait_3');
                if ($p1 || $p2 || $p3) {
                    $model->save();
                    Yii::$app->session->setFlash('success', "Thêm mới thành công!");

                    return $this->redirect(['update', 'id' => $model->id]);
                }
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function actionExport() {
//        die("abc");
        ini_set('max_execution_time', 3600);
        ini_set('memory_limit', '-1');
        $fileName = 'Dang_ky_' . date('YmdHis') . '.xlsx';
        ob_start();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
//        $sheet->setCellValue('A1', 'Khánh Tộng !');


        header('Content-Encoding: UTF-8');
        header("Pragma: public");
//        header("Content-type: text/x-csv; charset=UTF-8");
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=UTF-8");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Disposition: attachment;filename=' . $fileName);
        $header = array("TT", "HỌ VÀ TÊN", "GIỚI TÍNH", "NĂM SINH", "ĐIỆN THOẠI", "KHU VỰC", "CHIỀU CAO", "CÂN NẶNG", "SỐ ĐO", "LINK FACEBOOK", "LINK SẢN PHẨM","VAI DIỄN");


        $searchModel = new RegisterSearch();
        $results = $searchModel->search(Yii::$app->request->queryParams)->query->all();
//        var_dump($results);die;
//        $query = $this->buildQuery();
//        $results = $query->execute();
        /** loop through array  */
        $j = 1;
        foreach ($results as $report_daily) {
            if($j ==1){
                $sheet->setCellValue('A1', $header[0]);
                $sheet->setCellValue('B1', $header[1]);
                $sheet->setCellValue('C1', $header[2]);
                $sheet->setCellValue('D1', $header[3]);
                $sheet->setCellValue('E1', $header[4]);
                $sheet->setCellValue('F1', $header[5]);
                $sheet->setCellValue('G1', $header[6]);
                $sheet->setCellValue('H1', $header[7]);
                $sheet->setCellValue('I1', $header[8]);
                $sheet->setCellValue('J1', $header[9]);
                $sheet->setCellValue('K1', $header[10]);
                $sheet->setCellValue('L1', $header[10]);
            }
        else {
                $sheet->setCellValue("A$j", $j);
                $sheet->setCellValue("B$j", $report_daily['name']);
                $sheet->setCellValue("C$j", $report_daily->getGenreName());
                $sheet->setCellValue("D$j", $report_daily['birth_year']);
                $sheet->setCellValue("E$j", $report_daily['msisdn']);
                $sheet->setCellValue("F$j", $report_daily['location']);
                $sheet->setCellValue("G$j", $report_daily['height']);
                $sheet->setCellValue("H$j", $report_daily['weight']);
                $sheet->setCellValue("I$j", $report_daily['chest'] . "-" . $report_daily['waist'] . "-" . $report_daily['butt']);
                $sheet->setCellValue("J$j", $report_daily['facebook']);
                $sheet->setCellValue("K$j", $report_daily['product']);
                $sheet->setCellValue("L$j", $report_daily->getCastingName());
        }
            $j++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');exit;
        die;
    }

}
