<?php
use awesome\backend\grid\AwsGridView;
use awesome\backend\widgets\AwsBaseHtml;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use backend\models\Product;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Thông tin đăng ký');
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
                            'MSISDN',
                            [
                                'attribute' => 'PRODUCT_ID',
                                'format' => 'raw', //raw, html
                                'content' => function($dataProvider) {
                                    $prod = Product::findOne($dataProvider['PRODUCT_ID']);
                                    return $prod->NAME;
                                }                            ],
                            [
                                'attribute' => 'Dịch vụ',
                                'format' => 'raw', //raw, html
                                'content' => function($dataProvider) {
                                    $prod = Product::findOne($dataProvider['PRODUCT_ID']);
                                    $sv = backend\models\VasService::findOne($prod->VAS_SERVICE_ID);
                                    return $sv->NAME;
                                }
                            ],   
                           [
                                'attribute' => 'STATUS',
                                'format' => 'raw', //raw, html
                                'content' => function($dataProvider) {
                                    switch($dataProvider['STATUS']){
                                        case "1": return "Đang chờ xử lý";
                                        case "0": return "Khách hàng hủy";
                                        case "2": return "Đã xử lý";
                                        case "3": return "Không đủ số lượng ĐK";
                                        default: return "Không rõ|".$dataProvider['STATUS'];
                                    }
                                }
                            ], 
                            'CREATED_TIME',
                             [
                                'attribute' => 'ERROR_CODE',
                                'format' => 'raw', //raw, html
                                'content' => function($dataProvider) {
                                    switch($dataProvider['ERROR_CODE']){
                                        case "0": return "Thành công|".$dataProvider['ERROR_CODE'];
                                        case "18": return "Tài khoản không đủ|".$dataProvider['ERROR_CODE'];
                                        case "22": return "KH không được SD DV|".$dataProvider['ERROR_CODE'];
                                        default: return "Thất bại|".$dataProvider['ERROR_CODE'];
                                    }
                                }
                            ],
                                    'NEXT_TIME_RETRY',
                                    'EXPIRED_RETRY'
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
