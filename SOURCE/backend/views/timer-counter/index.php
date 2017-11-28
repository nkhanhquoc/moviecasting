<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\widgets\AwsGridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TimerCounterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Timer Counters');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timer-counter-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=
        Html::a(Yii::t('backend', 'Create {modelClass}', [
                    'modelClass' => 'Timer Counter',
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
            [
                'label' => 'Module',
                'content' => function ($data) {
                    return Html::encode($data->module->name);
                },
                'filter' => backend\models\Modules::getAll()
            ],
            'counter',
            'timer_1',
            'timer_2',
            'timer_3',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php
    Pjax::end();
    ?>
</div>
