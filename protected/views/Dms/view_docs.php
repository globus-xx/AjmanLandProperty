
<center>
    
<h1> رؤية الملفات</h1>

<?php
$user = getenv("username");
$dir = "dms/".$landid ;
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
       
        echo "<br>"; 
        echo CHtml::link('تحميل',array('dms/download', 'file_name'=>$file));
        echo "<br>";
        
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
<a href='<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/upload/' target='_parent'> اغلاق  </a>    
<?php
}
else
{    
?>
<a href='<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/process2/<?php echo $id+1; ?>' >الذهاب الى الملف التالي</a> &nbsp;&nbsp;&nbsp;
<a href='<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/process2/<?php echo $id-1; ?>' >الذهاب الى الملف السابق</a> &nbsp;&nbsp;&nbsp;
<a href='<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/upload/' target='_parent'> اغلاق  </a>    
<?php
}
?>


