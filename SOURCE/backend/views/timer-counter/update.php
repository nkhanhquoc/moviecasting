<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TimerCounter */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Timer Counter',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Timer Counters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="timer-counter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
