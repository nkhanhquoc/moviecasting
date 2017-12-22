<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Đăng ký',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Đăng ký'), 'url' => ['index']];
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
