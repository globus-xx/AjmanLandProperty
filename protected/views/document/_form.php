<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'document-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
	<div class="row">
    <?php echo $form->labelEx($model,'documentTypeId'); ?>
	  <?php
    $allTypes = DocumentTypes::model()->findAll();
    $list = CHtml::listData($allTypes, 'id', 'title');
    echo CHtml::dropDownList('Document[documentTypeId]', null, $list, array('empty' => '(What Type of Document Is it?)'));
    ?>
	  
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->