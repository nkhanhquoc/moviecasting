<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Provincial */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Provincial',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Provincials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provincial-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
