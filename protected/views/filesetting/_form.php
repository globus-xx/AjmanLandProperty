<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'filesetting-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">الحقول المميزة باالعلامة <span class="required">*</span> مطلوبة.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">		
                <label for="Filesetting_file_types" class="required">انواع الملفات  <span class="required">*</span></label>                
		<?php echo $form->textField($model,'file_types',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'file_types'); ?>
	</div>

	<div class="row">		
                <label for="Filesetting_file_size" class="required">الحد الاقصى لحجم الملفات  مقاسا ب MB<span class="required">*</span></label>
		<?php echo $form->textField($model,'file_size'); ?>
		<?php echo $form->error($model,'file_size'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->