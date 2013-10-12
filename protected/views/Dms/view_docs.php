
<center>
    
<h1> رؤية الملفات</h1>

<?php
$user = getenv("username");
$dir2 = "dms/".$landid ;
$dh2 = opendir($dir2);
$i=0;
$counter = 0;

while (($file2 = readdir($dh2)) !== false) {    
    if($file2!="."&&$file2!="..")
    {
        $counter++;
    }
}
closedir($dh2);  


$dh2 = opendir($dir2);
while (($file2 = readdir($dh2)) !== false) {
    
if($file2!="."&&$file2!="..")
{
    
    if($id==$i)
    {
        $ext=pathinfo($file2, PATHINFO_EXTENSION);
        
        if($ext=="jpg"||$ext=="png"||$ext=="bmp")
          echo "<img src='".Yii::app()->request->baseUrl.'/'.$dir2.'/'.$file2."' style='max-width:500px;max-height:375px' /> ";        
        else if($ext=="pdf")
          echo "<img src='".Yii::app()->request->baseUrl."/images/pdf-icon.jpg' style='max-width:500px;max-height:375px' />";
        else if($ext=="tiff" || $ext=="tif")
            echo "<img src='".Yii::app()->request->baseUrl."/images/tiff.png' style='max-width:500px;max-height:375px' />";        
        else if($ext=="docx" || $ext=="doc")
            echo "<img src='".Yii::app()->request->baseUrl."/images/docx.png' style='max-width:500px;max-height:375px' />";
        else
            echo "<img src='".Yii::app()->request->baseUrl."/images/unknown.png' style='max-width:500px;max-height:375px' />";
       
        echo "<br>"; 
        echo CHtml::link('تحميل',array('dms/download', 'file_name'=>$file2));
        echo "<br>";
        
        break;                
    }        
    else
        $i++;
    
}

}                                               
closedir($dh2);                  


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

<?php
if($id>0)
{
?>
<a href='<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/process2/<?php echo $id-1; ?>' >الذهاب الى الملف السابق</a> &nbsp;&nbsp;&nbsp;
<?php
}
?>

<a href='<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/upload/' target='_parent'> اغلاق  </a>    
<?php
}
?>


