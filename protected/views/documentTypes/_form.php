<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'document-types-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

    <fieldset id="container-for-form-meta">
        <legend>خيارات خاصة</legend>
        <?php 
        
        if(isset($_model_document_type_meta))
        if (is_array($_model_document_type_meta)):
          foreach($_model_document_type_meta as $one_meta):
            $this->renderPartial('//documentTypes/_form_meta', array('model' => $one_meta, 'form' => $form));
          endforeach;
         
        endif;
         
        ?>
    </fieldset>
    <a href="javascript:void(0);" id="link-add-new-custom-option" >Add New Custom Option</a>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
    
<script type="text" id="template-document-meta">
    <?php         
    if(isset($_model_document_type_metas))
    $this->renderPartial('//documentTypes/_form_meta', array('model' => $_model_document_type_metas, 'form' => $form));        
else {
        $this->renderPartial('//documentTypes/_form_meta', array('model' => $_model_document_type_meta, 'form' => $form));        
}
    ?>
</script>

</div><!-- form -->
<script language="javascript">
    $(function(){
        $('#link-add-new-custom-option').click(function(){
            html = $('#template-document-meta').html();
            tm = new Date().getTime();
            
            var s = new RegExp("DocumentTypeMeta\\[","g");
            r = 'DocumentTypeMeta['+tm+'][';
            html = html.replace(s,r);
            
            var s = new RegExp("DocumentTypeMeta_","g");
            r = 'DocumentTypeMeta_'+tm+'_';
            html = html.replace(s,r);
            
            $('#container-for-form-meta').append(html);
        });
        
        // hack for existing textfields
        $('#container-for-form-meta .row').each(function(){
            html = $(this).html();
            tm = new Date().getTime();
            
            var s = new RegExp("DocumentTypeMeta\\[","g");
            r = 'DocumentTypeMeta['+tm+'][';
            html = html.replace(s,r);
            
            var s = new RegExp("DocumentTypeMeta_","g");
            r = 'DocumentTypeMeta_'+tm+'_';
            html = html.replace(s,r);
            $(this).html(html);
        });
    });
    
</script>
