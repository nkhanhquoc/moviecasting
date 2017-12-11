<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SysConfig */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Cấu hình',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Quản lý'), 'url' => '#'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Quản lý cấu hình'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row sys-config-create">
    <div class="col-md-12">
        <?= $this->render('_form', [
            'model' => $model,
            'title' => $this->title
        ]) ?>
    </div>
</div>
