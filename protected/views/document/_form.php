<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'document-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required. </p>

	<?php echo $form->errorSummary($model);  ?>

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
    <?php    echo $form->labelEx($model,'documentTypeId'); ?>
	  <?php   
    $allTypes = DocumentTypes::model()->findAll();
    
    $list = CHtml::listData($allTypes, 'id', 'title');
    echo CHtml::dropDownList('Document[documentTypeId]', null, $list, array('empty' => '(What Type of Document Is it?)'));
    ?>

            
            <script>
                            document.getElementById('Document_documentTypeId').value = <?=$model->documentTypeId?>;
            </script>   
                    
	</div>
	<div id="document-subform-container"><?php 
        
        
        
        if(isset($_model_document_metas))
	if(is_array($_model_document_metas)):  	
                echo $this->renderPartial('form-document-type', array('documentType'=>$_documentType,'_model_document_metas'=>$_model_document_metas));
        endif;
  
  ?></div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget();  ?>

</div><!-- form -->
<script language="JavaScript">
            
function getExtension(filename) {
    var parts = filename.split('.');
    return parts[parts.length - 1];
}

function check_file_type(filename) {
    var ext = getExtension(filename);       
    var types = '<?=$types?>';   
    var arr = types.split(",");
    var i=0;
    
    $.each( arr, function( key, value ) {        
        if(ext == value)
        i=1;            
      });   
      
      if(i==1)
          return true;
      else
          return false;
}

function fileSize(file)
{
             input = document.getElementById(file);
             file2 = input.files[0];  
             
            var max_size = '<?=$size?>';
            max_size = max_size *1024;            
            
            
             if(file2.size>max_size)
             {                
                 return false;
             }
             else
                 return true;         
}



  $(function(){
    $('#Document_documentTypeId').change(function(){
      $.ajax({
        url:'<?php echo Yii::app()->request->baseUrl;?>/index.php/Document/FormDocumentType',
        data:{documentTypeId:$(this).val()}
      }).done(function(response){
        $('#document-subform-container').html(response);
      });
    });
    
    
    $( "#document-form" ).submit(function(){   
                    
                          var file = $('#Document_file');
                          
                          if($("#Document_title").val()=="")
                          {
                              alert("من فضلك ادخل وصف الملف !!!");
                              return false;
                          }
                          else if($("#Document_file").val()=="")
                          {
                              alert("من فضلك اختر ملف للتحميل !!!");
                              return false;
                          }
                          else if(!fileSize('Document_file'))
                            {
                                  alert(' حجم الملف ضخم!!! ');
                                  return false;
                            }
                          else if(!check_file_type(file.val()))
                            {            
                                  alert('نوع الملف غير مدعوم');                                 
                                  return false;
                            }                                                                                
                });
  });  
</script>