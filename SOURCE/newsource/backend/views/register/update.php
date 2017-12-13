<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Phim',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Admin'), 'url' => '#'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Phim'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update') . ' ' . $model->name;
?>
<div class="row menu-update">
    <div class="col-md-12">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => $this->title
    ]) ?>

    </div>
</div>
