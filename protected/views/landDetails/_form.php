<?php
/* @var $this LandDetailsController */
/* @var $model LandDetails */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'land-details-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'LandID'); ?>
		<?php echo $form->textField($model,'LandID',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'LandID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Direction'); ?>
		<?php echo $form->textField($model,'Direction',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'Direction'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Dimension'); ?>
		<?php echo $form->textField($model,'Dimension'); ?>
		<?php echo $form->error($model,'Dimension'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Description'); ?>
		<?php echo $form->textField($model,'Description',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->