<?php
/* @var $this InvoicesController */
/* @var $model Invoices */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'invoices-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'InvoiceDateTime'); ?>
		<?php echo $form->textField($model,'InvoiceDateTime'); ?>
		<?php echo $form->error($model,'InvoiceDateTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UserID'); ?>
		<?php echo $form->textField($model,'UserID',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'UserID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Product'); ?>
		<?php echo $form->textField($model,'Product',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'Product'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TransactionID'); ?>
		<?php echo $form->textField($model,'TransactionID'); ?>
		<?php echo $form->error($model,'TransactionID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Amount'); ?>
		<?php echo $form->textField($model,'Amount'); ?>
		<?php echo $form->error($model,'Amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CustomerID'); ?>
		<?php echo $form->textField($model,'CustomerID'); ?>
		<?php echo $form->error($model,'CustomerID'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->