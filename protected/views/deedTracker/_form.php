<?php
/* @var $this DeedTrackerController */
/* @var $model DeedTracker */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'deed-tracker-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'DeedID'); ?>
		<?php echo $form->textField($model,'DeedID',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'DeedID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UserID'); ?>
		<?php echo $form->textField($model,'UserID',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'UserID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DateTime'); ?>
		<?php echo $form->textField($model,'DateTime'); ?>
		<?php echo $form->error($model,'DateTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Status'); ?>
		<?php echo $form->textField($model,'Status',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'Status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->