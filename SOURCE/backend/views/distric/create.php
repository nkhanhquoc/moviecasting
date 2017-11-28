<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Distric */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Distric',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Districs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="distric-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
