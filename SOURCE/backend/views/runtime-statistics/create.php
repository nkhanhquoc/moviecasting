<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RuntimeStatistics */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Runtime Statistics',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Runtime Statistics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="runtime-statistics-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
