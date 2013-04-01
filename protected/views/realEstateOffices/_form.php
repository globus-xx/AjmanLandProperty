<?php
/* @var $this RealEstateOfficesController */
/* @var $model RealEstateOffices */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'real-estate-offices-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'RealEstateID'); ?>
		<?php echo $form->textField($model,'RealEstateID',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'RealEstateID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CommercialName'); ?>
		<?php echo $form->textField($model,'CommercialName',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'CommercialName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'OwnerName'); ?>
		<?php echo $form->textField($model,'OwnerName'); ?>
		<?php echo $form->error($model,'OwnerName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'RegisteredDate'); ?>
		<?php echo $form->textField($model,'RegisteredDate'); ?>
		<?php echo $form->error($model,'RegisteredDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ExpiryDate'); ?>
		<?php echo $form->textField($model,'ExpiryDate'); ?>
		<?php echo $form->error($model,'ExpiryDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Address'); ?>
		<?php echo $form->textField($model,'Address',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'Address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MobilePhone'); ?>
		<?php echo $form->textField($model,'MobilePhone',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'MobilePhone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Email'); ?>
		<?php echo $form->textField($model,'Email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'Email'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'حفظ' : 'حفظ'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
