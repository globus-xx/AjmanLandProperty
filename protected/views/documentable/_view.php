<div class="well-bordered form" style="direction: rtl">
<h2  style="display:inline-block;">الوثائق المرفقة</h2>
<a style="display:inline-block;" href="javascript:void(0)" class="toggle-attach-a-document" >ارفاق وثيقة؟</a>
<div class="well document-attachinary-holder" style="display:none;">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'documentable-form',
	'enableAjaxValidation'=>false,
  'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    
    
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
         <h5> يمكنك اختيار احدى الطريقتين لتحميل وثيقة : </h5>
	 	<h5>    1- اختر وثيقة محملة مسبقا       </h5>  
		<small>اكتب للبحث عن الوثيقة التي تريد ارفاقها     </small><br/>
		<input id="search_for_document" />
		<?php echo $form->hiddenField($model,'documentId'); ?>
		<?php echo $form->error($model,'documentId'); ?>
		<?php echo $form->hiddenField($model,'documentable_type'); ?>
		<?php echo $form->hiddenField($model,'documentable_id'); ?>
		<a id="link-attach-document-to-element" href="javascript:void(0)">ارفاق وثيقة</a> 
		
	</div>

<?php $this->endWidget(); ?>
    
    
<h5>2- اختر وثيقة من جهازك   </h5>





<?php $form2=$this->beginWidget('CActiveForm', array(
	'id'=>'document-form2',
        'action'=>Yii::app()->createUrl('//Documentable/upload'),
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>



	<p class="note">الحقول المميزة بالعلامة <span class="required">*</span> مطلوبة .</p>

	<?php echo $form2->errorSummary($model2);  ?>

	<div class="row">
		
        وصف الملف :   <span class="required">*</span>
		<?php echo $form2->textField($model2,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form2->error($model2,'title'); ?>
	</div>
  <div class="row">    
      اختر الملف :     <span class="required">*</span>
    <?php echo $form2->fileField($model2, 'file');?>
    <?php echo $form2->error($model2,'file'); ?>
      
                <?php echo $form2->hiddenField($model,'documentId'); ?>		
		<?php echo $form2->hiddenField($model,'documentable_type'); ?>
		<?php echo $form2->hiddenField($model,'documentable_id'); ?>
  </div>
	
	

	<div class="row buttons">
            <!--<a id="link-attach-document-to-element" href="javascript:void(0)">تحميل وثيقة</a>--> 	
            <?php echo CHtml::submitButton($model2->isNewRecord ? 'تحميل' : 'تخزين'); ?> &nbsp;&nbsp;&nbsp;&nbsp;   <small><a href="javascript:void(0)" class="toggle-hide-attach-a-document" >الغاء</a></small>
	</div>

<?php $this->endWidget();  ?>    
    
    
</div>
<ul>
	<?php
	 foreach($documentables as $documentable):?>
	<li>
		<?php echo ($documentable->document->attributes['title']);?>
		<a href="<?php echo Yii::app()->createUrl('document/download', array('id'=>$documentable->document->id));?>">تحميل</a>
		<a class="link-to-detach-document" href="javascript:void(0)" data-id="<?php echo $documentable->attributes['id'];?>">اخراج الوثيقة</a>
	</li>
<?php endforeach;?>
</ul>

</div><!-- form -->
<script language="javascript">
    
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
            max_size = max_size *1024*1024;            
            
            
            
            
             if(file2.size>max_size)
             {                
                 return false;
             }
             else
                 return true;         
}


  $(function(){
  	$('.toggle-attach-a-document').click(function(){
  		$('.document-attachinary-holder').show();
  	});
  	$('.toggle-hide-attach-a-document').click(function(){
  		$('.document-attachinary-holder').hide();
  	});
  	$('.link-to-detach-document').click(function(){
  		var _this = $(this);
  		$.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php/Documentable/Delete",
            data: { id:$(this).attr('data-id')},
            success: function(data) {
            	$(_this).parents('li').remove();
            }
        });
  	});
  	$('#link-attach-document-to-element').click(function(){
  		form = $(this).parents('form').first();
  		datastring = $(form).serialize();

  		$.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php/Documentable/Create",
            data: datastring,
            success: function(data) {
            	$('#link-attach-document-to-element').parents('.form').first().replaceWith(data);
            }
        });
  	});
	 $( "#search_for_document" ).autocomplete({
		source: "<?php echo Yii::app()->request->baseUrl;?>/index.php/Document/Search",
		minLength: 2,
		focus: function( event, ui ) {
			$("#search_for_document").val( ui.item.title );
			return false;
		},
		select: function( event, ui ) {
			$("#search_for_document").val(ui.item.title);
			$("#Documentable_documentId").val( ui.item.id );
			return false;
		  }
		}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
			return $( "<li>" )
			.append( "<a>" + item.title + "<br>" + item.fileName + "</a>" )
			.appendTo( ul );
		};
                
                
                $( "#document-form2" ).submit(function(){   
                    
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