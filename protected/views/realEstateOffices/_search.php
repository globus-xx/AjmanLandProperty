<?php
/* @var $this RealEstateOfficesController */
/* @var $model RealEstateOffices */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'RealEstateID'); ?>
		<?php echo $form->textField($model,'RealEstateID',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CommercialName'); ?>
		<?php echo $form->textField($model,'CommercialName',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'OwnerName'); ?>
		<?php echo $form->textField($model,'OwnerName'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RegisteredDate'); ?>
		<?php echo $form->textField($model,'RegisteredDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ExpiryDate'); ?>
		<?php echo $form->textField($model,'ExpiryDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Address'); ?>
		<?php echo $form->textField($model,'Address',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MobilePhone'); ?>
		<?php echo $form->textField($model,'MobilePhone',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Email'); ?>
		<?php echo $form->textField($model,'Email',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->