<?php
/* @var $this DeedMasterController */
/* @var $model DeedMaster */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'deed-master-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">الخانات بال <span class="required">*</span> الزامية.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'DeedID'); ?>
		<?php echo $form->textField($model,'DeedID',array('size'=>10,'maxlength'=>10,'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'DeedID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LandID'); ?>
		<?php echo $form->textField($model,'LandID',array('size'=>10,'maxlength'=>100,'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'LandID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SchemeID'); ?>
		<?php echo $form->textField($model,'SchemeID'); ?>
		<?php echo $form->error($model,'SchemeID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DateCreated'); ?>
		<?php echo $form->textField($model,'DateCreated'); ?>
		<?php echo $form->error($model,'DateCreated'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'DateHijri'); ?>
		<?php echo $form->textField($model,'DateHijri'); ?>
		<?php echo $form->error($model,'DateHijri'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UserID'); ?>
		<?php echo $form->textField($model,'UserID',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'UserID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ContractID'); ?>
		<?php echo $form->textField($model,'ContractID',array('size'=>10,'maxlength'=>10,'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'ContractID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'InvoiceNo'); ?>
		<?php echo $form->textField($model,'InvoiceNo'); ?>
		<?php echo $form->error($model,'InvoiceNo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Docs'); ?>
		<?php echo $form->textField($model,'Docs'); ?>
		<?php echo $form->error($model,'Docs'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Remarks'); ?>
		<?php echo $form->textField($model,'Remarks',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'Remarks'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
