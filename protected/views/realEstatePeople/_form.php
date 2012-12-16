<?php
/* @var $this RealEstatePeopleController */
/* @var $model RealEstatePeople */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'real-estate-people-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'CardNo'); ?>
		<?php echo $form->textField($model,'CardNo'); ?>
		<?php echo $form->error($model,'CardNo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'Name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Nationality'); ?>
		<?php echo $form->textField($model,'Nationality',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Nationality'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Role'); ?>
		<?php echo $form->textField($model,'Role',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Role'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IssueDate'); ?>
		<?php echo $form->textField($model,'IssueDate'); ?>
		<?php echo $form->error($model,'IssueDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EndDate'); ?>
		<?php echo $form->textField($model,'EndDate'); ?>
		<?php echo $form->error($model,'EndDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EntryDate'); ?>
		<?php echo $form->textField($model,'EntryDate'); ?>
		<?php echo $form->error($model,'EntryDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'RealEstateID'); ?>
		<?php echo $form->textField($model,'RealEstateID'); ?>
		<?php echo $form->error($model,'RealEstateID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CardEndDate'); ?>
		<?php echo $form->textField($model,'CardEndDate'); ?>
		<?php echo $form->error($model,'CardEndDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UserID'); ?>
		<?php echo $form->textField($model,'UserID',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'UserID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'OperationType'); ?>
		<?php echo $form->textField($model,'OperationType',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'OperationType'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->