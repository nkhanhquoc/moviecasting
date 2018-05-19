<?php


use awesome\backend\grid\AwsGridView;
use awesome\backend\widgets\AwsBaseHtml;
use backend\models\User;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Users');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Admin'), 'url' => '#'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row user-index">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                <div class="caption">
                    <i class="icon-layers "></i>
                    <span class="caption-subject  sbold uppercase">
                        <?= AwsBaseHtml::encode($this->title) ?>
                    </span>
                </div>
                <div class="actions">
                    <?= Html::a(Yii::t('backend', 'Create {modelClass}', [
                        'modelClass' => 'User',
                    ]),
                        ['create'], ['class' => 'btn btn-info  btn-outline btn-circle btn-sm']) ?>
                </div>
            </div>

            <div class="portlet-body">
                <div class="table-container">
                    <?php
                    Pjax::begin(['formSelector' => 'form', 'enablePushState' => false, 'id' => 'mainGridPjax']);
                    ?>

                    <?= \yii\grid\GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            'id',
                            'username',
//                            'email:email',
                            [
                                'attribute' => 'status',
                                'format' => 'raw', //raw, html
                                'content' => function($data) {
                                    return ($data->status == User::STATUS_ACTIVE) ? Yii::t('backend', 'Actived') : Yii::t('backend', 'Inactive');
                                }
                            ],
                            [
                                'attribute' => 'created_at',
                                'format' => 'raw', //raw, html
                                'content' => function($data) {
                                    return date('H:i:s d/m/Y', $data->created_at);
                                }
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'headerOptions'=> ['style'=>'width: 100px;'],
                                'contentOptions' => ['class' => 'row-actions'],
                            ],
                        ],
                    ]); ?>

                    <?php
                    Pjax::end();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
