<!--            
        <input type="submit" value="generate .docx file">   
-->


<script src="../../jquery-1.8.3.min.js" type="text/javascript"></script>
<link href="../../facebox/src/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
<script src="../../facebox/src/facebox.js" type="text/javascript"></script>


<script type="text/javascript" src="../../tinymce_3.5.8/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		// using false to ensure that the default browser settings are used for best Accessibility
		// ACCESSIBILITY SETTINGS
		content_css : false,
		// Use browser preferred colors for dialogs.
		browser_preferred_colors : true,
		detect_highcontrast : true,

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
        
        
jQuery(document).ready(function($) {
  $('a[rel*=facebox]').facebox() 
})
</script>


<?php
/* @var $this ContractsMasterController */
/* @var $model ContractsMaster */



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('contracts-master-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>إدارة الملفات</h1>
<p style="display:none;">>
يمكنك إدخال عامل تشغيل مقارنة اختياريا ( (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
أو <b>=</b>)  في بداية كل القيم البحث لتحديد الكيفية التي ينبغي أن يتم المقارنة
</p>


<table style="width:300px;margin: 0 auto;">
    
    <tr><td>اسم المتغيرات</td><td>الوظيفة</td></tr>
    
    <tr><td>tdate</td><td>تاريخ اليوم</td></tr>
    <tr><td>letterid</td><td>رقم الصادر</td></tr>
    <tr><td>letterid</td><td>رقم الصادر</td></tr>
    
    <tr><td>landid</td><td>سند ملك رقم</td></tr>
    <tr><td>location</td><td>المنطقة</td></tr>
    <tr><td>plotnum</td><td>رقم الحوض</td></tr>
    <tr><td>peice</td><td>رقم القطعة</td></tr>
    <tr><td>pgroup</td><td>المالك السابق</td></tr>
    <tr><td>ogroup</td><td>المالك الحالي</td></tr> 
    <tr><td>landprice</td><td>سعر بيع الارض </td></tr> 
    <tr><td>buydate</td><td>تاريخ بيع الارض </td></tr> 
    <tr><td>destination</td><td>اسم الوجهة</td></tr> 
    <tr><td>employeename</td><td>اسم المستخدم</td></tr> 
     
</table>

<form action="gosave" method="post" >

<table style="width:600px">
<tr><td>لاضافة ملف</td></tr>
<tr><td>عنوان الملف</td><td>:</td><td><input type="text" name="ftitle" size="130"></td></tr>
<tr><td width="50%">محتوى الملف</td><td>:</td><td> <textarea id="elm1" name="ftext" rows="15" cols="100"  > </textarea></td></tr>
<tr><td colspan="3"><input type="submit" name="go" value="حفط"></td></tr>


</table>

</form>


<script type="text/javascript">
if (document.location.protocol == 'file:') {
	alert("The examples might not work properly on the local file system due to security settings in your browser. Please use a real webserver.");
}
</script>

<?php

/*
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'contracts-master-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'LetterID',
		'Title',
		
		array(
			'class'=>'CButtonColumn',
		),
                            
            
            
	),
));
 * 
 */

?>
<hr>
<table style="width:350px;margin: 0 auto;">
<tr><td colspan="2"><center><h3>الرسائل المولدة</h3></td></tr>    
<tr><td>عنوان الملف</td><td>تعديل</td></tr>

<?php
foreach($item as $row)
{  
  ?>
 
<tr><td><?php echo $row->Title ?></td><td><a href="open/<?php echo $row->LetterID ?>"  ><img src="../../images/viewIcon.png" title="View" /></a>&nbsp;<a href="download/<?php echo $row->LetterID ?>" ><img src="../../images/download.png" title="Download"/></a>&nbsp;<a href="update/<?php echo $row->LetterID ?>" ><img src="../../images/update3.png" title="Update" /></a>&nbsp;<a href="delete/<?php echo $row->LetterID ?>" ><img src="../../images/delete.png" title="Delete"/></a></td></tr>

<?php
}
?>
</table>



<hr>
<table style="width:150px;margin: 0 auto;">
<tr><td colspan="2"><h3>الرسائل الصادرة</h3></td></tr>
<tr><td>اسم المستخدم</td><td>رؤية</td></tr>

<?php
foreach($lettersgenerated as $row)
{  
  ?>
 
<tr><td ><?php echo $row->UserName ?> </td><td><a href="viewExportedLetters/<?php echo $row->ExportedletterID ?>" ><img src="../../images/viewIcon.png" title="View" /></a></td></tr>

<?php
}
?>
</table>





