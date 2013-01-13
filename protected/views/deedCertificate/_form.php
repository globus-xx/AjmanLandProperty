<?php
/* @var $this DeedCertificateController */
/* @var $model DeedCertificate */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'deed-certificate-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'sha1'); ?>
		<?php echo $form->textField($model,'sha1',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'sha1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LandID'); ?>
		<?php echo $form->textField($model,'LandID',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'LandID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DeedID'); ?>
		<?php echo $form->textField($model,'DeedID'); ?>
		<?php echo $form->error($model,'DeedID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ContractsID'); ?>
		<?php echo $form->textField($model,'ContractsID'); ?>
		<?php echo $form->error($model,'ContractsID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UserID'); ?>
		<?php echo $form->textField($model,'UserID',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'UserID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DateTime'); ?>
		<?php echo $form->textField($model,'DateTime',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'DateTime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->