<?php
/* @var $this ContractsMasterController */
/* @var $model ContractsMaster */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ContractsID'); ?>
		<?php echo $form->textField($model,'ContractsID',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LandID'); ?>
		<?php echo $form->textField($model,'LandID',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DateCreated'); ?>
		<?php echo $form->textField($model,'DateCreated'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UserID'); ?>
		<?php echo $form->textField($model,'UserID',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ContractType'); ?>
		<?php echo $form->textField($model,'ContractType',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DeedID'); ?>
		<?php echo $form->textField($model,'DeedID',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SchemeID'); ?>
		<?php echo $form->textField($model,'SchemeID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'AmountEntered'); ?>
		<?php echo $form->textField($model,'AmountEntered'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'AmountCorrected'); ?>
		<?php echo $form->textField($model,'AmountCorrected'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UserIDcorrected'); ?>
		<?php echo $form->textField($model,'UserIDcorrected',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UserIDApproved'); ?>
		<?php echo $form->textField($model,'UserIDApproved',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Fee'); ?>
		<?php echo $form->textField($model,'Fee'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'InvoiceNo'); ?>
		<?php echo $form->textField($model,'InvoiceNo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->