<?php
/* @var $this LandDetailsController */
/* @var $model LandDetails */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'LandDetailID'); ?>
		<?php echo $form->textField($model,'LandDetailID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LandID'); ?>
		<?php echo $form->textField($model,'LandID',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Direction'); ?>
		<?php echo $form->textField($model,'Direction',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Dimension'); ?>
		<?php echo $form->textField($model,'Dimension'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Description'); ?>
		<?php echo $form->textField($model,'Description',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->