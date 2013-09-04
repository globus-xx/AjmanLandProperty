<?php
/* @var $this TransactionTrackerController */
/* @var $model TransactionTracker */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'transaction-tracker-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'TransactionType'); ?>
		<?php echo $form->textField($model,'TransactionType',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'TransactionType'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'RecordID'); ?>
		<?php echo $form->textField($model,'RecordID'); ?>
		<?php echo $form->error($model,'RecordID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UserID'); ?>
		<?php echo $form->textField($model,'UserID',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'UserID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CpuID'); ?>
		<?php echo $form->textField($model,'CpuID',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'CpuID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DateTimeStart'); ?>
		<?php echo $form->textField($model,'DateTimeStart'); ?>
		<?php echo $form->error($model,'DateTimeStart'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DateTimeFinish'); ?>
		<?php echo $form->textField($model,'DateTimeFinish'); ?>
		<?php echo $form->error($model,'DateTimeFinish'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->