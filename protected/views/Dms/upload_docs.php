<style>
    .span-19 {width:955px;}
    .bar {
    height: 18px;
    background: green;
    }
</style>

<center>
    
<div style='width:500px;'>
        
        
<h1> تحميل الملفات  </h1>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl;?>/jQuery-File-Upload-master/css/bootstrap.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl;?>/jQuery-File-Upload-master/css/jquery.fileupload-ui.css">



<span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>اختر الملفات...</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="files[]" multiple>
</span>
    <br>
    <br>
    <!-- The global progress bar -->
    <div id="progress" class="progress">
        <div class="progress-bar progress-bar-success"></div>
    </div>
    
    <a href='<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/process_docs' id='go_link' style='display: none;'>الذهاب الى المرحلة التالية</a>
    <!-- The container for the uploaded files -->
    <div id="files" class="files">
        <h3>الملفات المحملة مسبقا</h3>
         <a href="<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/view_files">رؤية الملفات</a>   
        <table id='results' style="display: none;border:1px solid #000;" ></table>
        <br><br>
        <form id="update_file" style="display: none">
            <label>اختر ملف</label>    
             
            <br>
            <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span> تعديل ...</span>
                    <!-- The file input field used as target for the file upload widget -->
<!--                    <input id="fileupload" type="submit"  >-->
                    <input type="file" id="file_upload" name="file" />   
            </span>
           
        </form>
            
    </div>


    
<script src="<?php echo Yii::app()->request->baseUrl;?>/jQuery-File-Upload-master/js/vendor/jquery.ui.widget.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/jQuery-File-Upload-master/js/jquery.iframe-transport.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/jQuery-File-Upload-master/js/jquery.fileupload.js"></script>

<script>
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url =  '<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/multipleupload';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',              
        add: function (e, data) {
            
            
        
                        var fileType = data.files[0].name.split('.').pop(), allowdtypes = '<?php echo $filetypes;?>';  
                        
                        
                        if (allowdtypes.indexOf(fileType) < 0) {
                            alert('الملف  ' +  data.files[0].name  +'  ' +' غير مسموح به ');
                            return false;
                        }
                         
                        var filesize = <?php echo $filesize;?>;                            
                        if(data.originalFiles[0]['size'] > filesize*1024*1024) {
                                alert('الملف  ' +  data.files[0].name  +'  ' +'حجمه كبير ');
                                return false;
                         }
        
                        data.submit();

                    },                 
        stop:function (e, data) {                                
            $('#go_link').show();                                                                
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );                                
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');



                                        var landid = '<?php echo Yii::app()->session['landid']?>'; 
                                        $.ajax({    
                                            type: "POST",
                                            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/get_docs",
                                            data: "landid="+landid,
                                            async : false,
                                            success: function(data) {                                         
                                                $("#update_file").show();                                                  
                                                $("#results").show();    
                                                $("#results").html(data);    
                                                if (data.match("لا توجد وثائق متوفرة")) {
                                                     // Code
                                                     $("#update_file").hide(); 
                                                }
                                            }
                                        });   
                                        
                                        
                                        
                                                                                                                       
                                        // Change this to the location of your server-side upload handler:
                                                    var docid = $('input:radio[name=doc]:checked').val(); 
                                                    var url =  'Update_file';
                                                    
                                                    
                                                    $('#file_upload').fileupload({
                                                        url: url,
                                                        dataType: 'json',                                                            
                                                        add: function (e, data) {                                                                                                                                                                                                                
                                                                        var fileType = data.files[0].name.split('.').pop(), allowdtypes = '<?php echo $filetypes;?>';  
                                                                        docid = $('input:radio[name=doc]:checked').val(); 
                                                                        if(docid==undefined)
                                                                          { alert("اختر وثيقة من فضلك");  return false;   }    
                                                                        else if(docid!=undefined)
                                                                        {
                                                                                    $.ajax({    
                                                                                      type: "POST",
                                                                                      url: "<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/set_id",
                                                                                      data: "id="+docid,
                                                                                      async : false                                                                                      
                                                                                  });                                                                             
                                                                        }
                                                                        else if (allowdtypes.indexOf(fileType) < 0) {
                                                                            alert('الملف  ' +  data.files[0].name  +'  ' +' غير مسموح به ');
                                                                            return false;
                                                                        }
                                                                        var filesize = <?php echo $filesize;?>;                            
                                                                        if(data.originalFiles[0]['size'] > filesize*1024*1024) {
                                                                                alert('الملف  ' +  data.files[0].name  +'  ' +'حجمه كبير ');
                                                                                return false;
                                                                         }
                                                                        data.submit();
                                                                    },                 
                                                        stop:function (e, data) {                                
                                                                     alert("تم تعديل الملف بنجاح"); 
                                                                     var landid = '<?php echo Yii::app()->session['landid']?>'; 
                                                                    $.ajax({    
                                                                        type: "POST",
                                                                        url: "<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/get_docs",
                                                                        data: "landid="+landid,
                                                                        async : false,
                                                                        success: function(data) {                                         
                                                                            $("#update_file").show();                                                  
                                                                            $("#results").show();    
                                                                            $("#results").html(data);    
                                                                            if (data.match("لا توجد وثائق متوفرة")) {
                                                                                 // Code
                                                                                 $("#update_file").hide(); 
                                                                            }
                                                                        }
                                                                    });  
                                                        },                                                        
                                                        progressall: function (e, data) {
                                                            var progress = parseInt(data.loaded / data.total * 100, 10);
                                                            $('#progress .progress-bar').css(
                                                                'width',
                                                                progress + '%'
                                                            );                                
                                                        }
                                                    })  .prop('disabled', !$.support.fileInput)
                                                        .parent().addClass($.support.fileInput ? undefined : 'disabled');                                                                                                                                                                                                                                                
                        });

function delete_file(id,filepath)
{    
    if (confirm('هل أنت متأكد ؟')) {
          // Save it!         
         $.ajax({
                                type: "POST",
                                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/delete_doc",
                                data: "docid="+id+"&filepath="+filepath,
                                async : false,
                                success: function(data) {                                        
                                    alert(data);
                                    
                                    var landid = '<?php echo Yii::app()->session['landid']?>'; 
                                        $.ajax({    
                                            type: "POST",
                                            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/get_docs",
                                            data: "landid="+landid,
                                            async : false,
                                            success: function(data) {                                         
                                                $("#update_file").show();                                                  
                                                $("#results").show();    
                                                $("#results").html(data);                                                     
                                                
                                                if (data.match("لا توجد وثائق متوفرة")) {
                                                     // Code
                                                     $("#update_file").hide(); 
                                                }
                                            }
                                        }); 
                                        
                                }
               });
                            
                            
                            
         } else {
         // Do nothing!         
        }                                      
                                        
}
</script>

</div>

</center>




