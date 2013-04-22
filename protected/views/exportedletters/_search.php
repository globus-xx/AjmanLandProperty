<?php
/* @var $this ExportedlettersController */
/* @var $model Exportedletters */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ExportedletterID'); ?>
		<?php echo $form->textField($model,'ExportedletterID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Exportedlettertext'); ?>
		<?php echo $form->textArea($model,'Exportedlettertext',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UserName'); ?>
		<?php echo $form->textField($model,'UserName',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ExportedDate'); ?>
		<?php echo $form->textField($model,'ExportedDate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->