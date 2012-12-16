<?php
/* @var $this ContractsDetailController */
/* @var $model ContractsDetail */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contracts-detail-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ContractID'); ?>
		<?php echo $form->textField($model,'ContractID',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'ContractID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Type'); ?>
		<?php echo $form->textField($model,'Type',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'Type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CustomerID'); ?>
		<?php echo $form->textField($model,'CustomerID'); ?>
		<?php echo $form->error($model,'CustomerID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Share'); ?>
		<?php echo $form->textField($model,'Share'); ?>
		<?php echo $form->error($model,'Share'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CardID'); ?>
		<?php echo $form->textField($model,'CardID',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'CardID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Side'); ?>
		<?php echo $form->textField($model,'Side',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'Side'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
