<?php

	namespace backend\controllers;

	use Yii;
	use backend\models\SysConfig;
	use backend\models\SysConfigSearch;
	use yii\web\Controller;
	use yii\web\NotFoundHttpException;
	use yii\filters\VerbFilter;

	/**
	 * SysConfigController implements the CRUD actions for SysConfig model.
	 */
	class SysConfigController extends Controller {

	  public function behaviors() {
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
	   * Lists all SysConfig models.
	   * @return mixed
	   */
	  public function actionIndex() {
		$searchModel = new SysConfigSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
		]);
	  }

	  /**
	   * Displays a single SysConfig model.
	   * @param string $id
	   * @return mixed
	   */
	  public function actionView($id) {
		return $this->render('view', [
				'model' => $this->findModel($id),
		]);
	  }

	  /**
	   * Creates a new SysConfig model.
	   * If creation is successful, the browser will be redirected to the 'view' page.
	   * @return mixed
	   */
	  public function actionCreate() {
		$model = new SysConfig();

		if ($model->load(Yii::$app->request->post())) {
		  $model->config_key = strtoupper($model->config_key);
            if ($model->save()) {
                Yii::$app->session->setFlash('info', 'Thêm mới cấu hình thành công!');
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else {
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
	   * Updates an existing SysConfig model.
	   * If update is successful, the browser will be redirected to the 'view' page.
	   * @param string $id
	   * @return mixed
	   */
	  public function actionUpdate($id) {
		$model = $this->findModel($id);
		$configKey=$model->config_key;
		if ($model->load(Yii::$app->request->post())) {
		  $model->config_key = $configKey;
		  if ($model->save()) {
              Yii::$app->session->setFlash('info', 'Cập nhật cấu hình thành công!');
              return $this->redirect(['view', 'id' => $model->id]);
          } else {
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

	  /**
	   * Deletes an existing SysConfig model.
	   * If deletion is successful, the browser will be redirected to the 'index' page.
	   * @param string $id
	   * @return mixed
	   */
	  public function actionDelete($id) {
//		$this->findModel($id)->delete();
//
		return $this->redirect(['index']);
	  }

	  /**
	   * Finds the SysConfig model based on its primary key value.
	   * If the model is not found, a 404 HTTP exception will be thrown.
	   * @param string $id
	   * @return SysConfig the loaded model
	   * @throws NotFoundHttpException if the model cannot be found
	   */
	  protected function findModel($id) {
		if (($model = SysConfig::findOne($id)) !== null) {
		  return $model;
		} else {
		  throw new NotFoundHttpException('The requested page does not exist.');
		}
	  }

	}
	