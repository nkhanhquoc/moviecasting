<?php


use awesome\backend\grid\AwsGridView;
use awesome\backend\widgets\AwsBaseHtml;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Admin'), 'url' => '#'];
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
                        'modelClass' => 'Product',
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
                            'NAME',
                            'CODE',
                            [
                                'attribute' => 'STATUS',
                                'format' => 'raw', //raw, html
                                'content' => function($dataProvider) {
                                switch($dataProvider['STATUS']){
                                    case 0: return "Hủy";
                                    case 1: return "Kích hoạt";
                                    case 2: return "Đã xử lý";
                                    default: return $dataProvider['STATUS'];
                                }
                                }
//                                        'filter' => Html::activeDropDownList($searchModel, 'STATUS', array("0" => "Hủy", "1" => "Kích hoạt","2"=>"Đã xử lý"),array('prompt'=>'Tất cả')),
                            ],
                            'END_TIME',
                            'NO_MIN_REG',
                            'CURRENT_REG',
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
