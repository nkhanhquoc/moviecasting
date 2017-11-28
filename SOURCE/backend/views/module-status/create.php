<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ModuleStatus */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Module Status',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Module Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
