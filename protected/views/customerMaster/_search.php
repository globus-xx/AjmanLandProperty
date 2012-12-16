<?php
/* @var $this CustomerMasterController */
/* @var $model CustomerMaster */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CustomerID'); ?>
		<?php echo $form->textField($model,'CustomerID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CustomerNameArabic'); ?>
		<?php echo $form->textField($model,'CustomerNameArabic',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CustomerNameEnglish'); ?>
		<?php echo $form->textField($model,'CustomerNameEnglish',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'HomeAddress'); ?>
		<?php echo $form->textField($model,'HomeAddress',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'HomePhone'); ?>
		<?php echo $form->textField($model,'HomePhone',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MobilePhone'); ?>
		<?php echo $form->textField($model,'MobilePhone',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DateofBirth'); ?>
		<?php echo $form->textField($model,'DateofBirth'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Nationality'); ?>
		<?php echo $form->textField($model,'Nationality',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Signature'); ?>
		<?php echo $form->textField($model,'Signature'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DocumentType'); ?>
		<?php echo $form->textField($model,'DocumentType',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DocumentNumber'); ?>
		<?php echo $form->textField($model,'DocumentNumber',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IssuedOn'); ?>
		<?php echo $form->textField($model,'IssuedOn'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ExpiresOn'); ?>
		<?php echo $form->textField($model,'ExpiresOn'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EmailAddress'); ?>
		<?php echo $form->textField($model,'EmailAddress',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Document'); ?>
		<?php echo $form->textField($model,'Document'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Photo'); ?>
		<?php echo $form->textField($model,'Photo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CustomerType'); ?>
		<?php echo $form->textField($model,'CustomerType',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->