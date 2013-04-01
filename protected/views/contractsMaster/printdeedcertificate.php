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
			
			
		}
		
		@font-face
		{
			font-family: GE SS Two Light;
			
		}
		
		@page 
		{
			size: A4;
			margin:0px;
		}
		body
		{
			margin: 0;
			padding; 0;
		}
		table,th,td
		{
			text-align: center;
			border:1px solid rgb(90,20,0);
			font-family:GE SS Two Light;
		}
		td.heading
		{
			font-weight:900;
		}
		#previousowner
		{
			font-size:80%;
		}
	
	</style>
</head>

<body style='-webkit-print-color-adjust:exact;'>
<br><br><br><br><br><br><br>

<h1 style='font-family:GE SS Two Medium; text-align:center;'>شهادة ملكية</h1>

<table style="width:18cm; margin:auto;">

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
		<td class='heading'>رقم سند الملكية</td>
		<td class='info'><?php echo $deed->land->LandID; ?></td>
		<td class='heading'>المساحة</td>
		<td style="text-align:center;" class='info'><?php echo $deed->land->TotalArea; ?>&nbsp;&nbsp;&nbsp; متر مربع</td>	
	</tr>
	
</table>

<br>

<table style="width:18cm; margin:auto;">

	<tr>
		<td style="width:13.3cm;" class='heading'>اسم المالك</td>
		<td class='heading'>الحصص</td>
	</tr>
	
	<?php
	
	for($i=0; $i<$cnt; $i++)
	{
		echo "<tr>";
		echo "<td>".$deed->deedDetails[$i]->customer->CustomerNameArabic."</td>";
		if ($deed->deedDetails[$i]->Share=="كامل الحصص")
			echo "<td>".$deed->deedDetails[$i]->Share."</td></tr>";
		else
			echo "<td>".$deed->deedDetails[$i]->Share." %</td></tr>";
	}
	?>
		
</table>

<div style="padding-top: 10px; width:18cm; margin:auto; font-family:GE SS Two Light;">
آلت إليه&nbsp;<?php if($cm = ContractsMaster::model()->findByPk($deed->ContractID))
echo $how[$cm->ContractType]; ?>&nbsp;من&nbsp;&nbsp;<span id="previousowner">&nbsp;&nbsp;&nbsp;&nbsp;<?

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

?></span>&nbsp;&nbsp;&nbsp;&nbsp;بموجب العقد رقم  &nbsp;&nbsp;<?php echo $deed->ContractID; ?><br>
بتاريخ <?php echo date('d-m-Y'); ?>

<br><br><br><br><br>
<div style="width:18cm; margin:auto; font-family:GE SS Two Light; text-align:left;">رئيس قسم التصرفات العقارية</div>
<br>
<div style="width:11cm; margin:right; font-family:GE SS Two Light; text-align:right; font-size:0.7em;">هذه الشهادة تعتبر لاغية في حالة محو أو شطب أي بيان من بياناتها أو إضافة بيانات أخرى إليها, وينتفي العمل بها في  حال اصدار سند الملكية  أو مضي ثلاثة أشهر من تاريخ اصدارها</div>
<div style="width:11cm; margin:right; font-family:GE SS Two Light; text-align:right; font-size:0.7em;">ملاحظة: رقم السند القديم <?php echo $deed->land->Remarks; ?></div>

