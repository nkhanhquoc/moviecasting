<?php


use awesome\backend\grid\AwsGridView;
use awesome\backend\widgets\AwsBaseHtml;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use backend\models\Movie;
use Yii;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Đăng ký');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row menu-index">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
                <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                <div class="caption">
                    <i class="icon-layers "></i>
                    <span class="caption-subject sbold uppercase">
                        <?= AwsBaseHtml::encode($this->title) ?>
                    </span>
                </div>
                <div class="actions">
                    <?= Html::a(Yii::t('backend', 'Create {modelClass}', [
                        'modelClass' => 'Đăng ký',
                    ]),
                        ['create'], ['class' => 'btn btn-info btn-outline btn-circle btn-sm']) ?>
                </div>
            </div>

            <div class="portlet-body">
                <div class="table-container">
                    <?php
                    Pjax::begin(['formSelector' => 'form', 'enablePushState' => false, 'id' => 'mainGridPjax']);
                    ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
//                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'castingName',
                            'name',
                            'birth_year',
                            'sodo',
                            [
                                'attribute' => 'genre',
                                'format' => 'raw', //raw, html
                                'content' => function($dataProvider) {
                                switch($dataProvider['genre']){
                                    case 1: return "Nam"; 
                                    case 2: return "Nữ"; 
                                }
                                }
                            ],
                                    'msisdn',
                                    'facebook',
                            [
                                 'attribute' => 'star',
                                'format' => 'raw', //raw, html
                                'content' => function($dataProvider) {
                                    return Yii::$app->params['register_star'][$dataProvider['star']];
                                }
                            ],
                            [
                                'attribute' => 'status',
                                'format' => 'raw', //raw, html
                                'content' => function($dataProvider) {
                                switch($dataProvider['status']){
                                    case 1: return "Active"; 
                                    case 0: return "Denied"; 
                                };
                                }
                            ],
                            'created_time',                           
                            ['class' => 'yii\grid\ActionColumn'],
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
