<?php

#Created by  Nguyen Quoc Khanh
#Created on Dec 11, 2017, 4:39:31 PM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.
namespace backend\controllers;

use Yii;
use backend\models\Movie;
use backend\models\MovieSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use xj\uploadify\UploadAction;
use backend\components\common\Utility;


/**
 * Description of MovieController
 *
 * @author Nguyen Quoc Khanh
 */
class MovieController extends AppController{
    //put your code here
     public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    
     /**
     * Displays a single Game model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('update', [
            'model' => $this->findModel($id),
        ]);
    }
    
      /**
     * Lists all Game models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MovieSearch();
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
    protected function findModel($id)
    {
        if (($model = Movie::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    /**
     * Creates a new Game model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Movie();
        if ($model->load(Yii::$app->request->post())) {
            if ($_FILES["Movie"]["name"]["image_path"]== null){
                $model->addError('image_path', 'Ảnh không được để trống.');
                return $this->render('create', [
                    'model' => $model,
                ]);
            }else{
                if ($model->upload()) {
                    $model->save(false);
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
    
    /**
     * Updates an existing Game model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

//           var_dump(Yii::$app->request->post());die;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->upload() && $model->uploadBanner())
            {
//                $model->updateCategory();
//                $model->save();
                Yii::$app->session->setFlash('success', "Cập nhật thành công!");
                return $this->render('update', [
                    'model' => $model,
                ]);
            }else
            {
                Yii::$app->session->setFlash('error', "Cập nhật thất bai!");
                return $this->render('update', [
                    'model' => $model,
                ]);
            }

        } else {
            return $this->render('update', [
                    'model' => $model,
                ]);
        }
    }
}
