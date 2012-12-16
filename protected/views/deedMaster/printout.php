<html dir="rtl">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

	<title>Deed</title>
	</head>
<body <body style='-webkit-print-color-adjust:exact;'>

<style>

@page
{
	size: A4;
	margin:0px;
}

table
{ 
	margin: auto;
	width: 15cm;
	border-collapse: collapse;
    border: 3px solid black; 
    cellspacing: 0px;
}
tr, td
{
	
	
	vertical-align: center;
	horizontal-align: center;
	text-align: center;
	border-collapse:collapse;
	border: 2px solid black;
	
}
td.title
{
	font-weight: bold;
}
td.textleft
{
	text-align:right;
	font-weight: bold;
}
td.shares
{
	font-weight:bold;
	text-align:center;
}
span.dots
{
	text-align:center;
	font-size: 14px;
	font-weight: bold;
}
#directions
{
	border-top: 2px solid black;
	border-bottom: 2px solid black;
	text-align: right
}	
#previousowner, #howithappened
{
	font-weight:bold;
}
div.beforetable
{
	width: 15cm;
	margin: auto;
}
</style>

<div>
<div style="text-align: center; width:4.5cm; padding:0cm; border:0cm; margin:0cm;position:absolute;right:2.3cm;top:6.5cm;">
<h3><? echo $deed->LandID; ?></h3>
</div>
</div>

<div style="position:absolute;right:2.3cm;top:9cm; padding:0px;">

<div class="beforetable">

<div style="float:right; width:33%"><span style="font-weight:900;">البلدة &nbsp;&nbsp;&nbsp;:</span><span style="font-weight:bold;">عجمــــان</span></div>
<div style="float: right; width:33%"><span style="font-weight:900;">المنطقة:&nbsp;&nbsp;</span><span style="font-weight:bold;"> <? echo $deed->land->location; ?></span></div>
<div style="float: right; width:33%"><span style="font-weight:900;">الحوض:&nbsp;&nbsp; </span><span style="font-weight:bold;"><? echo $deed->land->Plot_No; ?></span></div>

<div style="float:right; width:33%"><span style="font-weight:900;">القطعة&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</span><span style="font-weight:bold;"><? echo $deed->land->Piece; ?></span></div>
<div style="float: right; width:33%"><span style="font-weight:900;">الطول&nbsp;:&nbsp;&nbsp;</span><span style="font-weight:bold;">
<? if ($deed->land->length>0) 
	echo $deed->land->length." متر";
 else
	echo "//";
 ?></span></div>
<div style="float: right; width:33%"><span style="font-weight:900;">العرض&nbsp;:&nbsp;&nbsp;</span><span style="font-weight:bold;">
<?
if ($deed->land->width>0)
 echo $deed->land->width." متر";
else
 echo "//";
 ?></span></div>

<div style="float: right; width:100%"><span style="font-weight:900;">المساحة: </span><span style="font-weight:bold;"><? echo $deed->land->TotalArea;?> متر مربع</span></div>

</div>
<br><br><div style="height:25px"></div>
<table>
<tr>
<td id="topheading" class="title" colspan="2">الحـــــدود</td>
</tr>

<tr>
<td id="directions" colspan="2">
	<div style="float:right; width:50%">&nbsp;<b>شمالاً: </b><span class="dots"><? echo $deed->land->North." متر"; ?></span></div>
	<div style="float:right; width:50%"><b>جنوباً: </b><span class="dots"><? echo $deed->land->South." متر"; ?></span></div><br>
	
	<div style="float:right; width:50%">&nbsp;<b>شرقاً : </b><span class="dots"><? echo $deed->land->East." متر"; ?></span></div>
	<div style="float:right; width:50%"><b>غرباً : </b><span class="dots"><? echo $deed->land->West." متر"; ?></span></div>
</td>
</tr>



<tr>
	<td class="title" style="width:70%;">اســـم المالك</td>
	<td class="title" style="width:30%;">الحصص</td>
	
</tr>

<tr>
	<td class="textleft">&nbsp;<? echo $deed->deedDetails[0]->customer->CustomerNameArabic; ?>&nbsp;</td>
	
	<td class="shares"><? if ($deed->deedDetails[0]->Share=="كامل الحصص") { echo "كامل الحصص";} else  echo $deed->deedDetails[0]->Share." %"; ?></td>
</tr>

<tr>
	<td class="textleft">&nbsp;<? 
	if ($cnt>1) {
	echo $deed->deedDetails[1]->customer->CustomerNameArabic; } ?>&nbsp;</td>
	
	<td class="shares"><? if ($cnt>1) {
	if ($deed->deedDetails[1]->Share=="كامل الحصص") { echo "كامل الحصص";} else echo $deed->deedDetails[1]->Share." %"; } ?>
	</td>
</tr>

<tr>
	<td class="textleft">&nbsp;<?	if ($cnt>2) {
	echo $deed->deedDetails[2]->customer->CustomerNameArabic; } ?>&nbsp;</td>
	
	<td class="shares"><?	if ($cnt>2) {
	if ($deed->deedDetails[2]->Share=="كامل الحصص") { echo "كامل الحصص";} else echo $deed->deedDetails[2]->Share." %"; } ?></td>
</tr>

<tr>
	<td class="textleft">&nbsp;<?	if ($cnt>3) {
	echo $deed->deedDetails[3]->customer->CustomerNameArabic; } ?>&nbsp;</td>
	
	<td class="shares"><?	if ($cnt>3) {
	if ($deed->deedDetails[3]->Share=="كامل الحصص") { echo "كامل الحصص";} else echo $deed->deedDetails[3]->Share." %"; } ?></td>
</tr>

<tr>
	<td class="textleft">&nbsp;<?	if ($cnt>4) {
	echo $deed->deedDetails[4]->customer->CustomerNameArabic; } ?>&nbsp;</td>
	<td class="shares"><?	if ($cnt>4) {
	if ($deed->deedDetails[4]->Share=="كامل الحصص") { echo "كامل الحصص";} else echo $deed->deedDetails[4]->Share." %"; } ?></td>
</tr>

<tr>
	<td class="textleft">&nbsp;<?	if ($cnt>5) {
	echo $deed->deedDetails[5]->customer->CustomerNameArabic; } ?>&nbsp;</td>
	
	<td class="shares"><?	if ($cnt>5) {
	if ($deed->deedDetails[5]->Share=="كامل الحصص") { echo "كامل الحصص";} else echo $deed->deedDetails[5]->Share." %"; } ?></td>
</tr>

<tr>
	<td class="textleft">&nbsp;<?	if ($cnt>6) {
	echo $deed->deedDetails[6]->customer->CustomerNameArabic; } ?>&nbsp;</td>
	
	<td class="shares"><?	if ($cnt>6) {
	if ($deed->deedDetails[6]->Share=="كامل الحصص") { echo "كامل الحصص";} else echo $deed->deedDetails[6]->Share." %"; } ?></td>
</tr>

<tr>
	<td class="textleft">&nbsp;<?	if ($cnt>7) {
	echo $deed->deedDetails[7]->customer->CustomerNameArabic; } ?>&nbsp;</td>
	
	<td class="shares"><?	if ($cnt>7) {
	if ($deed->deedDetails[7]->Share=="كامل الحصص") { echo "كامل الحصص";} else echo $deed->deedDetails[7]->Share." %"; } ?></td>
</tr>

<tr>
        <td class="textleft">&nbsp;<?   if ($cnt>8) {
        echo $deed->deedDetails[8]->customer->CustomerNameArabic; } ?>&nbsp;</td>

        <td class="shares"><?   if ($cnt>8) {
        if ($deed->deedDetails[8]->Share=="كامل الحصص") { echo "كامل الحصص";} else echo $deed->deedDetails[8]->Share." %"; } ?></td>
</tr>

<tr>
        <td class="textleft">&nbsp;<?   if ($cnt>9) {
        echo $deed->deedDetails[9]->customer->CustomerNameArabic; } ?>&nbsp;</td>

        <td class="shares"><?   if ($cnt>9) {
        if ($deed->deedDetails[9]->Share=="كامل الحصص") { echo "كامل الحصص";} else echo $deed->deedDetails[9]->Share." %"; } ?></td>
</tr>

<tr>
        <td class="textleft">&nbsp;<?   if ($cnt>10) {
        echo $deed->deedDetails[10]->customer->CustomerNameArabic; } ?>&nbsp;</td>

        <td class="shares"><?   if ($cnt>10) {
        if ($deed->deedDetails[10]->Share=="كامل الحصص") { echo "كامل الحصص";} else echo $deed->deedDetails[10]->Share." %"; } ?></td>
</tr>

</table>
<div class="beforetable" style="margin-top: 5px;">
	جرى تسجيل المال غير المنقول المبين أوصافه بإسم / أسماء المالك / المالكين الذين انتقل إليهم بطريق<span id="howithappened">&nbsp;<? echo $deed->Remarks; ?></span> 
	من المالك السابق <span id="previousowner"><?

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
                	echo $olddeed->deedDetails[$i]->customer->CustomerNameArabic.", "; 
        	}
	}
}
else
	echo $deed->PreviousOwners;

?></span>
	وقد أعطي هذا السند إثباتاً بذلك.<br>
<div style="padding-top:90px;">تاريخ : <span id="deeddate"><?php echo date('d-m-Y'); ?></span> م</div>
</div>

</div>
<div style="padding-top:20px; position:absolute; top:23.5cm;right:2.3cm;">
<h3>رقـم&nbsp;&nbsp;<?php echo $deed->DeedID+13070; ?></h3>
</div>

</body>
<link type="text/css" href="/AjmanLandProperty/css/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="/AjmanLandProperty/js/jquery-1.8.1.min.js"></script> 

<script type='text/javascript'>

$("#howithappened").bind('dblclick',function() {
	
		var Remarks = prompt("دخل طريقة التحويل الملكية");
		var DeedID = '<?php echo $deed->DeedID; ?>';
	
		if (Remarks == null)
		{
			return;
		}
	
		var params = {
			Remarks: Remarks,
			DeedID: DeedID,
			type: "remarks",
		}
		var paramJSON = JSON.stringify(params);	
		
		
		$.post(
			'<?php echo $this->createUrl("DeedMaster/updateinfo")?>', 
			{ data: paramJSON },
			function(data) 
			{
		        result = JSON.parse(data); 
		        window.location.reload();
			}
		);
		
	});


$("#previousowner").bind('dblclick',function() {
	
		var PreviousOwners = prompt("تعديا على اسم مالك السابق");
		var DeedID = '<?php echo $deed->DeedID; ?>';
		
		if (PreviousOwners == null)
		{
			return;
		}

		var params = {
			PreviousOwners: PreviousOwners,
			DeedID: DeedID,
			type: "PO",
		}
		var paramJSON = JSON.stringify(params);	
		
		
		$.post(
			'<?php echo $this->createUrl("DeedMaster/updateinfo")?>', 
			{ data: paramJSON },
			function(data) 
			{
		        result = JSON.parse(data); 
		        window.location.reload();
			}
		);
		
	});
	

</script>
</html>
