<?php
/* @var $this LandFinesController */
/* @var $model LandFines */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'LandFinesID'); ?>
		<?php echo $form->textField($model,'LandFinesID',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LandID'); ?>
		<?php echo $form->textField($model,'LandID',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FineType'); ?>
		<?php echo $form->textField($model,'FineType'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FineDescription'); ?>
		<?php echo $form->textField($model,'FineDescription',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DateInserted'); ?>
		<?php echo $form->textField($model,'DateInserted'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DocsCreated'); ?>
		<?php echo $form->textField($model,'DocsCreated'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Closed'); ?>
		<?php echo $form->textField($model,'Closed'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DateClosed'); ?>
		<?php echo $form->textField($model,'DateClosed'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UserIDclosed'); ?>
		<?php echo $form->textField($model,'UserIDclosed',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DocsClosed'); ?>
		<?php echo $form->textField($model,'DocsClosed'); ?>
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