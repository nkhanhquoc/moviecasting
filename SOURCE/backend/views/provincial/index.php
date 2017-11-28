<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\widgets\AwsGridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProvincialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Provincials');
$this->params['breadcrumbs'][] = $this->title;
$country = backend\models\Country::getAll();
$listUsers = backend\models\User::getAllUser();
?>
<div class="provincial-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=
        Html::a(Yii::t('backend', 'Create {modelClass}', [
                    'modelClass' => 'Provincial',
                ]), ['create'], ['class' => 'btn btn-success'])
        ?>
    </p>
    <?php
    Pjax::begin(['formSelector' => 'form', 'enablePushState' => false]);
    ?>
    <?=
    AwsGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'code',
            'name',
            [
                'label' => 'Quốc gia',
                'attribute' => 'country_id',
                'content' => function ($data) {
                    return Html::encode($data->country->name);
                },
                'filter' => $country
            ],
            [
                'label' => 'Người tạo',
                'attribute' => 'created_by',
                'content' => function ($data) {
                    return Html::encode($data->createdBy->username);
                },
                'filter' => $listUsers
            ],
            'created_at',
            // 'updated_by',
            // 'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php
    Pjax::end();
    ?>
</div>
