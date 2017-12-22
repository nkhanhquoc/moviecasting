<?php

use awesome\backend\widgets\AwsBaseHtml;
use backend\models\User;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Admin'), 'url' => '#'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Contact'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row user-view">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list "></i>
                    <span class="caption-subject  sbold uppercase">
                        <?= AwsBaseHtml::encode($this->title) ?>
                    </span>
                </div>
                
            </div>
            <div class="portlet-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'name',
                        'content',
                        [
                            'label' => 'Trạng thái',
                            'value' => ($model->status == User::STATUS_ACTIVE) ? Yii::t('backend', 'Đã xem') : Yii::t('backend', 'Chưa xem'),
                        ],
                        'created_time',
                        'updated_time'
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
