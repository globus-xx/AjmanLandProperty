<?php
/* @var $this LandMasterController */
/* @var $model LandMaster */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'land-master-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">الخانات بال <span class="required">*</span>إلزامية.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'LandID'); ?>
		<?php echo $form->textField($model,'LandID',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'LandID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LocationID'); ?>
		<?php echo $form->textField($model,'LocationID',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'LocationID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Plot_No'); ?>
		<?php echo $form->textField($model,'Plot_No',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'Plot_No'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'Piece'); ?>
		<?php echo $form->textField($model,'Piece',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'Piece'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php echo $form->textField($model,'location',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'location'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Land_Type'); ?>
		<?php echo $form->textField($model,'Land_Type',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'Land_Type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TotalArea'); ?>
		<?php echo $form->textField($model,'TotalArea'); ?>
		<?php echo $form->error($model,'TotalArea'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'length'); ?>
		<?php echo $form->textField($model,'length'); ?>
		<?php echo $form->error($model,'length'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'width'); ?>
		<?php echo $form->textField($model,'width'); ?>
		<?php echo $form->error($model,'width'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'AreaUnit'); ?>
		<?php echo $form->textField($model,'AreaUnit',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'AreaUnit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Remarks'); ?>
		<?php echo $form->textField($model,'Remarks',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'Remarks'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'North'); ?>
		<?php echo $form->textField($model,'North',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'North'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'South'); ?>
		<?php echo $form->textField($model,'South',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'South'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'East'); ?>
		<?php echo $form->textField($model,'East',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'East'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'West'); ?>
		<?php echo $form->textField($model,'West',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'West'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
