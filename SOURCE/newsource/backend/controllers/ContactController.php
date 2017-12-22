<?php
namespace backend\controllers;
#Created by  Nguyen Quoc Khanh
#Created on Dec 15, 2017, 11:18:21 PM
#Copyright(c) 2017 Nguyen Quoc Khanh,  All Rights Reserved.
#This software is the proprietary information of Nguyen Quoc Khanh.
use Yii;
use backend\models\Contact;
use backend\models\ContactSearch;
use yii\filters\VerbFilter;
/**
 * Description of ContactController
 *
 * @author Nguyen Quoc Khanh
 */
class ContactController extends AppController{
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
        $model = $this->findModel($id);
        $model->status = 1;
        $model->save(false);
        return $this->render('view', [
            'model' => $model,
        ]);
    }
    
      /**
     * Lists all Game models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContactSearch();
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
        if (($model = Contact::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
     /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param  integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
       
            return $this->render('view', [
                'model' => $model,
            ]);
        
    }
}
