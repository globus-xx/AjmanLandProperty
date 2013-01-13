<?php
/* @var $this ContractsMasterController */
/* @var $model ContractsMaster */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contracts-master-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'LandID'); ?>
		<?php echo $form->textField($model,'LandID',array('size'=>10,'maxlength'=>10,'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'LandID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DateCreated'); ?>
		<?php echo $form->textField($model,'DateCreated'); ?>
		<?php echo $form->error($model,'DateCreated'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UserID'); ?>
		<?php echo $form->textField($model,'UserID',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'UserID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ContractType'); ?>
		<?php echo $form->textField($model,'ContractType',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'ContractType'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DeedID'); ?>
		<?php echo $form->textField($model,'DeedID',array('size'=>10,'maxlength'=>10,'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'DeedID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SchemeID'); ?>
		<?php echo $form->textField($model,'SchemeID'); ?>
		<?php echo $form->error($model,'SchemeID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'AmountEntered'); ?>
		<?php echo $form->textField($model,'AmountEntered'); ?>
		<?php echo $form->error($model,'AmountEntered'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'AmountCorrected'); ?>
		<?php echo $form->textField($model,'AmountCorrected'); ?>
		<?php echo $form->error($model,'AmountCorrected'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UserIDcorrected'); ?>
		<?php echo $form->textField($model,'UserIDcorrected',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'UserIDcorrected'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UserIDApproved'); ?>
		<?php echo $form->textField($model,'UserIDApproved',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'UserIDApproved'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Fee'); ?>
		<?php echo $form->textField($model,'Fee'); ?>
		<?php echo $form->error($model,'Fee'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'InvoiceNo'); ?>
		<?php echo $form->textField($model,'InvoiceNo',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'InvoiceNo'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'Remarks'); ?>
		<?php echo $form->textField($model,'Remarks'); ?>
		<?php echo $form->error($model,'Remarks'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'Status'); ?>
		<?php echo $form->textField($model,'Status',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'Status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
