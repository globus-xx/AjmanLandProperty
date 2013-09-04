<?php
/* @var $this DeedMasterController */
/* @var $model DeedMaster */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'DeedID'); ?>
		<?php echo $form->textField($model,'DeedID',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LandID'); ?>
		<?php echo $form->textField($model,'LandID',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SchemeID'); ?>
		<?php echo $form->textField($model,'SchemeID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DateCreated'); ?>
		<?php echo $form->textField($model,'DateCreated'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UserID'); ?>
		<?php echo $form->textField($model,'UserID',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ContractID'); ?>
		<?php echo $form->textField($model,'ContractID',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'InvoiceNo'); ?>
		<?php echo $form->textField($model,'InvoiceNo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Docs'); ?>
		<?php echo $form->textField($model,'Docs'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Remarks'); ?>
		<?php echo $form->textField($model,'Remarks',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->