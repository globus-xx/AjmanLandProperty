<?php
/* @var $this HajzMasterController */
/* @var $model HajzMaster */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'HajzID'); ?>
		<?php echo $form->textField($model,'HajzID',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LandID'); ?>
		<?php echo $form->textField($model,'LandID',array('size'=>10,'maxlength'=>10)); ?>
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
		<?php echo $form->label($model,'Type'); ?>
		<?php echo $form->textField($model,'Type',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TypeDetail'); ?>
		<?php echo $form->textField($model,'TypeDetail',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DocsCreated'); ?>
		<?php echo $form->textField($model,'DocsCreated'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UserIDcreated'); ?>
		<?php echo $form->textField($model,'UserIDcreated',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DateCreated'); ?>
		<?php echo $form->textField($model,'DateCreated'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'AmountMortgaged'); ?>
		<?php echo $form->textField($model,'AmountMortgaged'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PeriodofTime'); ?>
		<?php echo $form->textField($model,'PeriodofTime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UserIDended'); ?>
		<?php echo $form->textField($model,'UserIDended',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DateEnded'); ?>
		<?php echo $form->textField($model,'DateEnded'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DocsEnded'); ?>
		<?php echo $form->textField($model,'DocsEnded'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IsActive'); ?>
		<?php echo $form->textField($model,'IsActive'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->