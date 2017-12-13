<?php

namespace backend\controllers;

#Created by  Nguyen Quoc Khanh
#Created on Dec 13, 2017, 9:35:58 PM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Register;
use backend\models\RegisterSearch;

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
        $params = Yii::$app->request->post();
        if($params){
            $star = $params['Register']['star'];
            if ($star < 6 and $star > 0) {
                $model->star = $star;
                $model->save(false);
                Yii::$app->session->setFlash('success', "Cập nhật thành công!");
                return $this->render('update', [
                            'model' => $model,
                ]);
            } else {
                 Yii::$app->session->setFlash('error', "Cập nhật thất bại!");
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
            
        }
        return $this->render('update', [
                            'model' => $model,
                ]);
    }

}