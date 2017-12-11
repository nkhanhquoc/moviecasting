<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Product',
]) . ' ' . $model->NAME;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Admin'), 'url' => '#'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Product'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update') . ' ' . $model->NAME;
?>
<div class="row menu-update">
    <div class="col-md-12">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => $this->title
    ]) ?>

    </div>
</div>
