<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Modules */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Modules',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Modules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modules-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
