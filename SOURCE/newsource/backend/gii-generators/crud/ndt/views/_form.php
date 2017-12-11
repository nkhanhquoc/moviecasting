<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use awesome\backend\widgets\AwsBaseHtml;
use awesome\backend\form\AwsActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $title string */
/* @var $form AwsActiveForm */
?>

<?= "<?php " ?> $form = AwsActiveForm::begin(); ?>

    <div class="portlet light portlet-fit portlet-form bordered <?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-paper-plane "></i>
                <span class="caption-subject  sbold uppercase">
                <?= "<?= " ?> $title ?>
                </span>
            </div>

        </div>
        <div class="portlet-body">
            <div class="form-body">
                <?php
                foreach ($generator->getColumnNames() as $attribute) {
                    if (in_array($attribute, $safeAttributes)) {
                        echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
                    }
                }
                ?>
            </div>
        </div>
        <div class="portlet-title">
            
            <div class="actions">
                <?= "<?= " ?> AwsBaseHtml::submitButton($model->isNewRecord ? <?= $generator->generateString('Create') ?> : <?= $generator->generateString('Update') ?>, ['class' => 'btn btn-info  btn-outline btn-circle btn-sm']) ?>
                <button type="button" name="back" class="btn btn-transparent black btn-outline btn-circle btn-sm"
                        onclick="history.back(-1)">
                    <i class="fa fa-angle-left"></i> Back
                </button>
            </div>
        </div>
    </div>

<?= "<?php " ?>AwsActiveForm::end(); ?>
