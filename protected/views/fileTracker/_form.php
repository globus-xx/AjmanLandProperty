<?php
/* @var $this FileTrackerController */
/* @var $model FileTracker */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'file-tracker-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'LandID'); ?>
		<?php echo $form->textField($model,'LandID',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'LandID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UserIDgiver'); ?>
		<?php echo $form->textField($model,'UserIDgiver',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'UserIDgiver'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UserIDreceiver'); ?>
		<?php echo $form->textField($model,'UserIDreceiver',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'UserIDreceiver'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Department'); ?>
		<?php echo $form->textField($model,'Department',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Department'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DateTime'); ?>
		<?php echo $form->textField($model,'DateTime',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'DateTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Status'); ?>
		<?php echo $form->textField($model,'Status',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
