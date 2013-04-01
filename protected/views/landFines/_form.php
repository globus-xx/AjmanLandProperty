<?php
/* @var $this LandFinesController */
/* @var $model LandFines */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'land-fines-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'LandID'); ?>
		<?php echo $form->textField($model,'LandID',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'LandID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FineType'); ?>
		<?php echo $form->textField($model,'FineType'); ?>
		<?php echo $form->error($model,'FineType'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FineDescription'); ?>
		<?php echo $form->textField($model,'FineDescription',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'FineDescription'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DateInserted'); ?>
		<?php echo $form->textField($model,'DateInserted'); ?>
		<?php echo $form->error($model,'DateInserted'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DocsCreated'); ?>
		<?php echo $form->textField($model,'DocsCreated'); ?>
		<?php echo $form->error($model,'DocsCreated'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Closed'); ?>
		<?php echo $form->textField($model,'Closed'); ?>
		<?php echo $form->error($model,'Closed'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DateClosed'); ?>
		<?php echo $form->textField($model,'DateClosed'); ?>
		<?php echo $form->error($model,'DateClosed'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UserIDclosed'); ?>
		<?php echo $form->textField($model,'UserIDclosed',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'UserIDclosed'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DocsClosed'); ?>
		<?php echo $form->textField($model,'DocsClosed'); ?>
		<?php echo $form->error($model,'DocsClosed'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Remarks'); ?>
		<?php echo $form->textField($model,'Remarks',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'Remarks'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->