<?php
/* @var $this RealEstatePeopleController */
/* @var $model RealEstatePeople */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CardID'); ?>
		<?php echo $form->textField($model,'CardID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CardNo'); ?>
		<?php echo $form->textField($model,'CardNo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Nationality'); ?>
		<?php echo $form->textField($model,'Nationality',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Role'); ?>
		<?php echo $form->textField($model,'Role',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IssueDate'); ?>
		<?php echo $form->textField($model,'IssueDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EndDate'); ?>
		<?php echo $form->textField($model,'EndDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EntryDate'); ?>
		<?php echo $form->textField($model,'EntryDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RealEstateID'); ?>
		<?php echo $form->textField($model,'RealEstateID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CardEndDate'); ?>
		<?php echo $form->textField($model,'CardEndDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UserID'); ?>
		<?php echo $form->textField($model,'UserID',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'OperationType'); ?>
		<?php echo $form->textField($model,'OperationType',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->