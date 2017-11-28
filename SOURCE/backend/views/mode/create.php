<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Mode */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Mode',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Modes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mode-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
