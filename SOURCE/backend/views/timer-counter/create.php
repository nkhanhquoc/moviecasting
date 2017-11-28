<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TimerCounter */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Timer Counter',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Timer Counters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timer-counter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
