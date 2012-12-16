<?php
/* @var $this LandSchemeController */
/* @var $model LandScheme */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'land-scheme-form',
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
		<?php echo $form->labelEx($model,'SchemeDrawing'); ?>
		<?php echo $form->textField($model,'SchemeDrawing'); ?>
		<?php echo $form->error($model,'SchemeDrawing'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MunicipalityID'); ?>
		<?php echo $form->textField($model,'MunicipalityID'); ?>
		<?php echo $form->error($model,'MunicipalityID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DateInserted'); ?>
		<?php echo $form->textField($model,'DateInserted'); ?>
		<?php echo $form->error($model,'DateInserted'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->