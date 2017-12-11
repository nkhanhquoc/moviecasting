<?php

	use awesome\backend\widgets\AwsBaseHtml;
	use awesome\backend\form\AwsActiveForm;

/* @var $this yii\web\View */
	/* @var $model backend\models\SysConfig */
	/* @var $title string */
	/* @var $form AwsActiveForm */
?>

<?php $form = AwsActiveForm::begin(); ?>

<div class="portlet light portlet-fit portlet-form bordered sys-config-form">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-paper-plane "></i>
			<span class="caption-subject sbold uppercase">
				<?= $title ?>
			</span>
		</div>

	</div>
	<div class="portlet-body">
		<div class="form-body">
			<?php if (!$model->isNewRecord): ?>
				  <?= $form->field($model, 'config_key')->textInput(['disabled' => TRUE]) ?>
				<?php else: ?>
				  <?= $form->field($model, 'config_key')->textInput(['maxlength' => 255]) ?>
			<?php endif; ?>

			<?= $form->field($model, 'config_value')->textarea(['rows' => 6, 'maxlength' => 1000]) ?>

			<?= $form->field($model, 'description')->textarea(['rows' => 6,  'maxlength' => 1000]) ?>

		</div>
	</div>
	<div class="portlet-title">

		<div class="actions">
			<?= AwsBaseHtml::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => 'btn btn-info btn-outline btn-circle btn-sm']) ?>
			<a type="button" name="back" class="btn btn-transparent black btn-outline btn-circle btn-sm"
			   href="<?= \yii\helpers\Url::to(['sys-config/index']); ?>">
				<i class="fa fa-angle-left"></i> <?= Yii::t('backend', 'Back'); ?>
			</a>
		</div>
	</div>
</div>

<?php AwsActiveForm::end(); ?>
