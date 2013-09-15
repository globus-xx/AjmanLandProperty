<style>
    .span-19 {width:955px;}
</style>

<center>
    
<div style='width:500px;'>
        
        
<h1> تحميل الملفات  </h1>
 
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl;?>/jQuery-File-Upload-master/css/bootstrap.min.css">
<!-- Generic page styles -->

<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl;?>/jQuery-File-Upload-master/css/jquery.fileupload-ui.css">


<style>   
.bar {
    height: 18px;
    background: green;
}
</style>

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
    <!-- The container for the uploaded files -->
    <div id="files" class="files"></div>

    <a href='process_docs' id='go_link' style='display: none;'>الذهاب الى المرحلة التالية</a>
    
<script src="<?php echo Yii::app()->request->baseUrl;?>/jQuery-File-Upload-master/js/vendor/jquery.ui.widget.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/jQuery-File-Upload-master/js/jquery.iframe-transport.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/jQuery-File-Upload-master/js/jquery.fileupload.js"></script>

<script>
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url =  'multipleupload';
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
});
</script>

</div>

</center>




