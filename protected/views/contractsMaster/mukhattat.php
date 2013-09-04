<?php
$how = array(
	'بالشراء',
	'بالوراثة',
	'بالتنازل',
	'وقف',
	'بالهبة',
	);
?>

<html dir="rtl">
<head>
	<meta http-equiv="Content-Language" content="ar">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>شهادة ملكية</title>
	
	<style>
		
		@font-face
		{
			font-family: GE SS Two Medium;
			font-stretch: ultra-expanded;
			
			
		}
		
		@font-face
		{
			font-family: GE SS Two Light;
			
		}
		
		@page 
		{
			size: A4;
			margin:0px;
			size:landscape;
		}
		body
		{
			margin: 0;
			padding; 0;
		}
		table,th,td
		{
			text-align: center;
			border-collapse: collapse;
			border:1px solid rgb(90,20,0);
			font-family: GE SS Two Light;
			font-size:95%;
		}
		td.heading
		{
			font-weight:900;
		}
		#previousowner
		{
			font-size:95%;
		}
	
	</style>
</head>

<body style='-webkit-print-color-adjust:exact;'>
<img src='/AjmanLandProperty/images/banner.jpg' style='width:130mm; margin-top:7mm; margin-bottom:0mm; margin-right:8mm;'>

<div style='position:absolute; top:3.2cm; right:11.5cm;'>
<span style='font-family:GE SS Two Light; font-size:40%'>نموذج رقم 2 ت 12/2012</span>
</div>

<h4 style='font-family:GE SS Two Light; width:130mm; text-align:center; margin-top:3mm; margin-bottom:1mm; margin-right:8mm;'>مخطط موقع هندسي</h1>

<table style="width:130mm; margin-top:0mm; margin-bottom:0mm; margin-left:0mm; margin-right:8mm;">

	<tr>
		<td class='heading'>المدينة</td>
		<td class='info'><?php echo $deed->land->LocationID; ?></td>
		<td class='heading'>القطاع</td>
		<td class='info'><?php echo $deed->land->Plot_No; ?></td>
	</tr>

	<tr>
		<td class='heading'>الحي</td>
		<td class='info'><?php echo $deed->land->location; ?></td>
		<td class='heading'>القطعة</td>
		<td class='info'><?php echo $deed->land->Piece; ?></td>
	</tr>
	
	<tr>
		<td class='heading'>المساحة</td>
		<td style="text-align:center;" class='info'><?php echo $deed->land->TotalArea." متر مربع"; ?></td>
		<td class='heading'>رقم السند</td>
		<td><?php echo $deed->land->LandID; ?></td>
	</tr>
	
	<tr><td colspan=4 class='heading'>الحدود</td></tr>
	<tr>
		<td class='heading'>شمالاَ</td>
		<td><?php echo $deed->land->North." متر"; ?></td>
		<td class='heading'>جنوباَ</td>
		<td><?php echo $deed->land->South." متر"; ?></td>
	</tr>
	
	<tr style='border-bottom:1px solid rgb(255,255,255);'>
		<td class='heading'>شرقاَ</td>
		<td><?php echo $deed->land->East." متر"; ?></td>
		<td class='heading'>غرباَ</td>
		<td><?php echo $deed->land->West." متر"; ?></td>
	</tr>
</table>

<table style="width:130mm; margin-top:0mm; margin-bottm:0mm;margin-right:8mm;">

	<tr style='border-bottom:2px solid rgb(90,20,0);'>
		<td style="width:105mm;" class='heading'>اسم المالك</td>
		<td class='heading'>الحصص</td>
	</tr>
	
	<?php
	
	for($i=0; $i<$cnt; $i++)
	{
		echo "<tr>";
		echo "<td style='width:105mm;'>".$deed->deedDetails[$i]->customer->CustomerNameArabic."</td>";
		if ($deed->deedDetails[$i]->Share=="كامل الحصص")
			echo "<td>".$deed->deedDetails[$i]->Share."</td></tr>";
		else
			echo "<td>".$deed->deedDetails[$i]->Share." %</td></tr>";
	}
	?>
	
</table>

<div style="font-family:GE SS Two Light; font-size:70%; margin-right:8mm; margin-top:1mm; width:130mm;" id='tochange'>
آلت إليه&nbsp;<?php 

$cm = ContractsMaster::model()->findByPk($deed->ContractID);

if(!$cm)
	echo "با".$deed->Remarks;
else
	echo $how[$cm->ContractType]; 

?>&nbsp;من&nbsp;&nbsp;<span id="previousowner">&nbsp;&nbsp;&nbsp;&nbsp;<?

if(!$deed->PreviousOwners)
{
	if(!$deed->ContractID)
		echo "صاحب السمو الحاكم";
	else
	{
		 $olddeed = DeedMaster::model()->findByPk($deed->contract->DeedID);

	        $searchCriteria=new CDbCriteria;
        	$searchCriteria->condition = 'DeedID = :deedid';
	        $searchCriteria->params = array(':deedid'=> $olddeed->DeedID);

        	$cntline = DeedDetails::model()->count($searchCriteria);

        	for($i=0; $i<$cntline; $i++)
        	{
                	if ($i==$cntline-1)
						echo $olddeed->deedDetails[$i]->customer->CustomerNameArabic." "; 
					else
						echo $olddeed->deedDetails[$i]->customer->CustomerNameArabic.", "; 
        	}
	}
}
else
	echo $deed->PreviousOwners;

?></span>&nbsp;&nbsp;&nbsp;&nbsp;بموجب العقد رقم  &nbsp;&nbsp;<?php echo $deed->ContractID; ?>
بتاريخ <?php echo date('d-m-Y'); ?></div>

<div style="position:absolute; top:15.0cm;">
<div style="font-family:GE SS Two Light; font-size:70%; margin-right:8mm; margin-top:1mm; width:130mm;">
ملاحظة: رقم السند القديم <?php echo $deed->land->Remarks; ?>
</div>
<div style="font-family:GE SS Two Light; font-size:70%; margin-right:8mm; margin-top:1mm; width:130mm;">
ملاحظة: هذا المخطط للاستعمال الرسمي لدائرة الأراضي والأملاك وفي حالة اتخاذ أي تغيرات على العقار يلزم مراجعة دائرة البلدية والتخطيط بعجمان
</div>

<div style='margin-top:5mm;'>
<span class='signatures' style='font-family:GE SS Two Light; font-size:70%; margin-right:8mm; margin-top:5mm; width:130mm;'>
قسم الشؤون الهندسية
</span>

<span class='signatures' style='font-family:GE SS Two Light; font-size:70%; margin-right:80mm; margin-top:5mm; width:130mm;'>
مدير عام الدائرة
</span>
</div>

</div>

<link type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.8.1.min.js"></script> 

<script type='text/javascript'>

$("#tochange").bind('dblclick',function() {
	var Remarks = prompt("دخل الملاحظة");
	if (Remarks== null)
	{
		return;
	}
	else
		$("#tochange").html(Remarks);
		
});
</script>
