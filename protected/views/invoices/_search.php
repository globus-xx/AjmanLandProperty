<?php
/* @var $this InvoicesController */
/* @var $model Invoices */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'InvoiceNo'); ?>
		<?php echo $form->textField($model,'InvoiceNo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'InvoiceDateTime'); ?>
		<?php echo $form->textField($model,'InvoiceDateTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UserID'); ?>
		<?php echo $form->textField($model,'UserID',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Product'); ?>
		<?php echo $form->textField($model,'Product',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TransactionID'); ?>
		<?php echo $form->textField($model,'TransactionID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Amount'); ?>
		<?php echo $form->textField($model,'Amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CustomerID'); ?>
		<?php echo $form->textField($model,'CustomerID'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->