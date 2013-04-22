<?php
/* @var $this DestinationController */
/* @var $model Destination */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'DestinationID'); ?>
		<?php echo $form->textField($model,'DestinationID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DestinationName'); ?>
		<?php echo $form->textField($model,'DestinationName',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->