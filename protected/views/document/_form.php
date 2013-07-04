<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'document-form',
	'enableAjaxValidation'=>false,
  'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
  <div class="row">
    <?php echo $form->labelEx($model,'file'); ?>
    <?php echo $form->fileField($model, 'file');?>
    <?php echo $form->error($model,'file'); ?>
  </div>
	<div class="row">
    <?php echo $form->labelEx($model,'documentTypeId'); ?>
	  <?php
    $allTypes = DocumentTypes::model()->findAll();
    $list = CHtml::listData($allTypes, 'id', 'title');
    echo CHtml::dropDownList('Document[documentTypeId]', null, $list, array('empty' => '(What Type of Document Is it?)'));
    ?>

	</div>
	<div id="document-subform-container"><?php 
	if(is_array($_model_document_metas)):
  	echo $this->renderPartial('form-document-type', array('documentType'=>$_documentType,'_model_document_metas'=>$_model_document_metas));
  endif;
  ?></div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script language="JavaScript">
  $(function(){
    $('#Document_documentTypeId').change(function(){
      $.ajax({
        url:'<?php echo Yii::app()->request->baseUrl;?>/index.php/Document/FormDocumentType',
        data:{documentTypeId:$(this).val()}
      }).done(function(response){
        $('#document-subform-container').html(response);
      });
    });
  });
  
</script>