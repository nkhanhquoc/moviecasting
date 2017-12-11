<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Link ĐK DV',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Admin'), 'url' => '#'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row menu-create">
    <div class="col-md-12">
        <?= $this->render('_form', [
            'model' => $model,
            'title' => $this->title
        ]) ?>
    </div>
</div>
