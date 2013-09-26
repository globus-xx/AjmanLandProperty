
<center>
    
<h1> معالجة الملفات</h1>

<?php
$user = getenv("username");
$dir = "dms/".Yii::app()->user->ID ;
$dh = opendir($dir);
$i=0;
$counter = 0;

while (($file = readdir($dh)) !== false) {    
    if($file!="."&&$file!="..")
    {
        $counter++;
    }
}
closedir($dh);  


$dh = opendir($dir);
while (($file = readdir($dh)) !== false) {
    
if($file!="."&&$file!="..")
{
    
    if($id==$i)
    {
        $ext=pathinfo($file, PATHINFO_EXTENSION);
        
        if($ext=="jpg"||$ext=="png"||$ext=="bmp")
          echo "<img src='".Yii::app()->request->baseUrl.'/'.$dir.'/'.$file."' style='max-width:500px;max-height:375px' /> ";        
        else if($ext=="pdf")
          echo "<img src='".Yii::app()->request->baseUrl."/images/pdf-icon.jpg' style='max-width:500px;max-height:375px' />";
        else if($ext=="tiff" || $ext=="tif")
            echo "<img src='".Yii::app()->request->baseUrl."/images/tiff.png' style='max-width:500px;max-height:375px' />";        
        else if($ext=="docx" || $ext=="doc")
            echo "<img src='".Yii::app()->request->baseUrl."/images/docx.png' style='max-width:500px;max-height:375px' />";
        else
            echo "<img src='".Yii::app()->request->baseUrl."/images/unknown.png' style='max-width:500px;max-height:375px' />";
        
        echo "<input type='hidden' id='image_name' value='".$file."' />";
        echo "<br>".$file . "<br>";
        
        break;                
    }        
    else
        $i++;
    
}

}                                               
closedir($dh);                  


  
if($counter==$i)
{
?>
<a href='<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/end_process/' target='_parent'> انهاء العملية </a>    
<?php
}
else
{    
?>

<select id='select_type'>
    <option value='' id="choose_empty" > choose </option>
<?php
foreach($filetypes as $row)
{
    ?>
    <option value='<?php echo $row['id']?>' >  <?php echo $row['title']?>  </option>
    <?php
}
?>
</select>
<spsn>اختر نوع الملف</span>
<?php
}
?>

<br><br>

    <table id='results' border='1' style='display: none;' ></table>
    <br>
    <table id='customer_information' border='1' style='display: none;' ></table>
    
<br>
<a href='<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/process/<?php echo $id+1; ?>' id='go_next' style='display:none;'>الذهاب الى الملف التالي</a>

</center>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery-1.8.1.min.js"></script>
<script>      
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */                       			                                   
                        $("#select_type").change(function() {  
				
                              var returnvalue = $("#select_type option:selected").text();
                              var landid = '<?php echo Yii::app()->session['landid']?>'; 
                              
                              
                              
                                if($.trim(returnvalue) == "Deed" || $.trim(returnvalue) == "Mukhattat")
                                    {                                                                       
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/get_deeds",
                                            data: "landid="+landid+"&doctype="+$('#select_type').val(),
                                            async : false,
                                            success: function(data) {                                                    
                                                $("#results").show();                                                  
                                                $("#results").html(data);                                                
                                            }
                                        });
                                        
                                        $("#choose_empty").prop("disabled", true);
                                    }      
                                    else if($.trim(returnvalue) == "Contract")
                                    {                                      
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/get_contracts",
                                            data: "landid="+landid+"&doctype="+$('#select_type').val(),
                                            async : false,
                                            success: function(data) {                                                    
                                                $("#results").show();                                                  
                                                $("#results").html(data);                                                
                                            }
                                        });
                                        
                                        $("#choose_empty").prop("disabled", true);
                                    }
                                    else if($.trim(returnvalue) == "Passport copy" || $.trim(returnvalue) == "Emirates ID")
                                    {
                                         $.ajax({
                                            type: "POST",
                                            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/get_customers",
                                            data: "landid="+landid+"&doctype="+$('#select_type').val(),
                                            async : false,
                                            success: function(data) {                                                    
                                                $("#results").show();                                                  
                                                $("#results").html(data);                                                
                                            }
                                        });
                                        
                                        $("#choose_empty").prop("disabled", true);
                                    }
                                    else
                                    {
                                    
                                     $.ajax({
                                            type: "POST",
                                            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/get_deeds",
                                            data: "landid="+landid+"&doctype="+$('#select_type').val(),
                                            async : false,
                                            success: function(data) {                                                    
                                                $("#results").show();                                                  
                                                $("#results").html(data);                                                
                                            }
                                        });
                                        
                                        $("#choose_empty").prop("disabled", true);
                                    
                                    }
                                                                                                        
			});
                                                                     
                });
                
                
                function choose_deed(deedid,table_name,doc_type)
                {                         
                    $.ajax({
                                            type: "POST",
                                            url: "<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/add_relation",
                                            data: "table_name="+table_name+"&id="+deedid+"&file_name="+$('#image_name').val()+"&doc_type="+doc_type,
                                            async : false,
                                            success: function(data) { 
                                                 //alert(data);
                                                if(table_name == "customerMaster")
                                                    {                                                        
                                                        $("#customer_information").show();                                                  
                                                        $("#customer_information").html(data); 
                                                    }
                                                $('#go_next').show();
                                            }
                    });                                                                                
                }
</script>   