<?php
/* @var $this WebserviceLogsController */
/* @var $model WebserviceLogs */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'webservice-logs-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'File_Name'); ?>
		<?php echo $form->textField($model,'File_Name',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'File_Name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Time_Added'); ?>
		<?php echo $form->textField($model,'Time_Added'); ?>
		<?php echo $form->error($model,'Time_Added'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->