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
	    <?php echo $form->labelEx($model, 'file'); ?>
        <?php echo $form->fileField($model, 'file'); ?>
        <?php echo $form->error($model, 'file'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fileName'); ?>
		<?php echo $form->textField($model,'fileName',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'fileName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mimeType'); ?>
		<?php echo $form->textField($model,'mimeType',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'mimeType'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fileSize'); ?>
		<?php echo $form->textField($model,'fileSize'); ?>
		<?php echo $form->error($model,'fileSize'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->