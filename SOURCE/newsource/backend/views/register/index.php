<?php
use awesome\backend\grid\AwsGridView;
use awesome\backend\widgets\AwsBaseHtml;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use backend\models\Movie;
use Yii;
use kartik\export\ExportMenu;
//use kartik\grid\GridView;



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
                
                <div class="actions">
                     <?= Html::a(Yii::t('backend', 'Export', [
                        'modelClass' => 'Đăng ký',
                    ]),
                        ['export'], ['class' => 'btn btn-info btn-outline btn-circle btn-sm']) ?>
                    

                </div>
            </div>

            <div class="portlet-body">
                <div class="table-container">

                    <?php
                    Pjax::begin(['formSelector' => 'form', 'enablePushState' => false, 'id' => 'mainGridPjax']);

                    ?>
                    <?=  GridView::widget([
                        'dataProvider' => $dataProvider,
//                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'castingName',
                            'name',
                            'birth_year',
                            'sodo',
                            'facebook',
                            [
                                'attribute' => 'portrait',
                                'format' => 'raw', //raw, html
                                'content' => function($dataProvider) {
                                    return Html::img($dataProvider['portrait'], ['width' => '60px','class'=>'img_hover']);
                                }
                            ],
                                    
                            [
                                 'attribute' => 'portrait_2',
                                'format' => 'raw', //raw, html
                                'content' => function($dataProvider) {
                                    return Html::img($dataProvider['portrait_2'], ['width' => '60px','class'=>'img_hover']);
                                }
                            ],
                                    [
                                 'attribute' => 'portrait_3',
                                'format' => 'raw', //raw, html
                                'content' => function($dataProvider) {
                                    return Html::img($dataProvider['portrait_3'], ['width' => '60px','class'=>'img_hover']);
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
                            ['class' => 'yii\grid\ActionColumn','template'=>'{update} {delete}'],
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
