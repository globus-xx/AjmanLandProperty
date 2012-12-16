<?php
/* @var $this TransactionTrackerController */
/* @var $model TransactionTracker */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'TransactionID'); ?>
		<?php echo $form->textField($model,'TransactionID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TransactionType'); ?>
		<?php echo $form->textField($model,'TransactionType',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RecordID'); ?>
		<?php echo $form->textField($model,'RecordID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UserID'); ?>
		<?php echo $form->textField($model,'UserID',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CpuID'); ?>
		<?php echo $form->textField($model,'CpuID',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DateTimeStart'); ?>
		<?php echo $form->textField($model,'DateTimeStart'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DateTimeFinish'); ?>
		<?php echo $form->textField($model,'DateTimeFinish'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->