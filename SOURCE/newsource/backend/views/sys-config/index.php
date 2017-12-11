<?php

//	use awesome\backend\grid\AwsGridView;
	use awesome\backend\widgets\AwsBaseHtml;
	use yii\helpers\Html;
	use yii\widgets\Pjax;
	use yii\grid\GridView;

/* @var $this yii\web\View */
	/* @var $searchModel backend\models\SysConfigSearch */
	/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Quản lý'), 'url' => '#'];
	$this->title = Yii::t('backend', 'Sys Configs');
	$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row sys-config-index">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
				<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>
				<div class="caption">
                    <i class="icon-layers "></i>
                    <span class="caption-subject  sbold uppercase">
						<?= AwsBaseHtml::encode($this->title) ?>
                    </span>
                </div>
                <div class="actions">
					<?=
						Html::a(Yii::t('backend', 'Create {modelClass}', [
								'modelClass' => 'cấu hình',
							]), ['create'], ['class' => 'btn btn-info btn-outline btn-circle btn-sm'])
					?>
                </div>
            </div>

            <div class="portlet-body">
                <div class="table-container">
					<?php
						Pjax::begin(['formSelector' => 'form', 'enablePushState' => false, 'id' => 'mainGridPjax']);
					?>

					<?=
						GridView::widget([
							'dataProvider' => $dataProvider,
							'filterModel' => $searchModel,
							'columns' => [
								['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'config_key',
                                    'value' => function($data) {
                                        return wordwrap($data->config_key, 20, ' ', true);
                                        //return \yii\helpers\StringHelper::truncate($data->description, 50);
                                    },
                                    'filter' => Html::activeTextInput($searchModel, 'config_key',[
                                        'maxlength' => 50,
                                        'class' => 'form-control',
                                    ])
                                ],
                                [
                                    'attribute' => 'config_value',
                                    'value' => function($data) {
                                        return wordwrap($data->config_value, 20, ' ', true);
                                        //return \yii\helpers\StringHelper::truncate($data->description, 50);
                                    },
                                    'filter' => Html::activeTextInput($searchModel, 'config_value',[
                                        'maxlength' => 50,
                                        'class' => 'form-control',
                                    ])
                                ],
                                [
                                    'attribute' => 'description',
                                    'value' => function($data) {
                                        return wordwrap($data->description, 20, ' ', true);
                                        //return \yii\helpers\StringHelper::truncate($data->description, 50);
                                    },
                                    'filter' => Html::activeTextInput($searchModel, 'description',[
                                        'maxlength' => 50,
                                        'class' => 'form-control',
                                    ])
                                ],
								[
								    'class' => 'yii\grid\ActionColumn',
                                    'headerOptions'=> ['style'=>'width: 80px;'],
                                    'contentOptions' => ['class' => 'row-actions'],
                                    'template' => '{view} {update}',
                                ],
							],
						]);
					?>

					<?php
						Pjax::end();
					?>
                </div>
            </div>
        </div>
    </div>
</div>
