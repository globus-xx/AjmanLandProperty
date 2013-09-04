<?php
/* @var $this LandSchemeController */
/* @var $model LandScheme */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'SchemeID'); ?>
		<?php echo $form->textField($model,'SchemeID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LandID'); ?>
		<?php echo $form->textField($model,'LandID',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SchemeDrawing'); ?>
		<?php echo $form->textField($model,'SchemeDrawing'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MunicipalityID'); ?>
		<?php echo $form->textField($model,'MunicipalityID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DateInserted'); ?>
		<?php echo $form->textField($model,'DateInserted'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->