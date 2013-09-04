<html dir="rtl">

	<?php
	
	$daysofweek = array(
		'Sunday'=>'الأحد',
		'Monday'=>'الاثنين',
		'Tuesday'=>'الثلاثاء',
		'Wednesday'=>'الأربعاء',
		'Thursday'=>'الخميس',
		'Friday'=>'الجمعة',
		'Saturday'=>'السبت',
		);
		
	$wakeeltypes = array(
		'general wakeel'=>'وكيل عام',
		'special wakeel'=>'وكيل خاص',
		'wakeel of wakeel'=>'وكيل الوكيل',
		'inheritors wakeel'=>'وكيل الورثة',
		'inheritor'=>'وارث',
		'wali'=>'ولي',
		'owner of company'=>'مالك الرخصة',
		);
	
	switch ($cm->ContractType)
	{
		case "0":
			$contype = "بيــع";
			break;
		case "1":
			$contype = "وراثة";
			break;
		case "2":
			$contype = "تنازل";
			break;
		case "3":
			$contype = "وقـــف";
			break;
		case "4":
			$contype = "هبـــة";
			break;
	}
	
	switch($cm->ContractType)
			{
				case "0":
					$buyertype = "مشتري";
					break;
				case "1":
					$buyertype = "المورث";
					break;
				case "2":
					$buyertype = "المتنازل له";
					break;
				case "3":
					$buyertype = "موقوف له";
					break;
				case "4":
					$buyertype = "موهوب له";
					break;
				default:
					$buyertype = "مشتري";
			}
			
			switch($cm->ContractType)
			{
				case "0":
					$sellertype = "البائع";
					break;
				case "1":
					$sellertype = "المتوفي";
					break;
				case "2":
					$sellertype = "المتنازل";
					break;
				case "3":
					$sellertype = "واقف";
					break;
				case "4":
					$sellertype = "واهب";
					break;
				default:
					$sellertype = "البائع";
					break;
			}
	?>

<head>
	<meta http-equiv="Content-Language" content="ar">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title><?php echo $contype; ?></title>
	
	<style>
		@page 
		{
			margin: 0;
		}
		body
		{
			margin: 0;
			padding: 0;
		}
		table,th,td
		{
			border-collapse:collapse;
			border:1px solid black;
                }
                
		td
		{
			
                        text-overflow: string;
                        white-space: nowrap;
		}
                
                
                                      
    	
	</style>
</head>
<body style='-webkit-print-color-adjust:exact;'>
	<br>
       <?php $pagecounter=1; ?>
        <font color="#876532" style="float:right;margin:10px 100px 0px 0px;">Page :<?php echo $pagecounter ?>, contract id : <?php echo $cm->ContractsID; ?></font>
        <div id="printarea" style="width:800px;margin:0 auto;padding:50px; ">
                               
	<h1 align="center">عقــــد <?php echo $contype; ?></h1>
	<h4 align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      رقم ألعقد &nbsp;<?php echo $cm->ContractsID; ?></h4>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;إنه في يوم <?php echo $daysofweek[date('l', strtotime($cm->DateCreated))]; ?> الموافق <?php echo '<span dir="ltr">'.$cm->DateCreated.'</span>'; ?> بإمارة عجمان تم التوقيع على العقد المذكور بياناته أدناه:

<h3 align="right" style="background:grey;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;بيانات اﻷطراف</h3>

<div id="sellertable" style="margin:0.5cm;"><table width="780" style="text-align:center">
<tr><td colspan="6" style='background:rgb(150,150,150);font-weight:bold'>الطرف اﻷول:</td></tr>
<th>الإسم</th><th>الجنسية</th><th>الإثبات</th><th>رقم الإثبات</th><th>الصفة</th><th>النسبة</th>

<?php
$countnsw=0;
$header=0;

	for ($i = 0; $i<=$nsw-1; $i++)
        if($countnsw<34)
        {
           $countnsw++;
            echo "<tr><td width=200 class=data>".$wsellers[$i]->customer->CustomerNameArabic."</td><td class=data>".$wsellers[$i]->customer->Nationality."</td><td class=data>".$wsellers[$i]->customer->DocumentType."</td><td class=data>".$wsellers[$i]->customer->DocumentNumber."</td><td class=data>".$wakeeltypes[$wsellers[$i]->Type]."</td><td>".""."</td></tr>";
        }
		
        else 
        {
$countnsw=1;            
$pagecounter++;
                ?>

</table>
<br>
<font color="#876532" style="float:right;margin:10px 0px 220px 0px;">Page :<?php echo $pagecounter ?>, contract id : <?php echo $cm->ContractsID; ?></font>    
<table width="780" style="text-align:center">

<tr><td colspan="6"  style='font-weight:bold;'>&nbsp;</td></tr>
<tr><td colspan="6" style='background:rgb(150,150,150);font-weight:bold'>الطرف اﻷول:</td></tr>
<th>الإسم</th><th>الجنسية</th><th>الإثبات</th><th>رقم الإثبات</th><th>الصفة</th><th>النسبة</th>
<?php
echo "<tr><td width=200 class=data>".$wsellers[$i]->customer->CustomerNameArabic."</td><td class=data>".$wsellers[$i]->customer->Nationality."</td><td class=data>".$wsellers[$i]->customer->DocumentType."</td><td class=data>".$wsellers[$i]->customer->DocumentNumber."</td><td class=data>".$wakeeltypes[$wsellers[$i]->Type]."</td><td>".""."</td></tr>";
$header++;

        }
       
        
       
$countns=$countnsw;
$header=0;

	for ($i = 0; $i<=$ns-1; $i++)
        if($countns<34)
        {
          $countns++;
          echo "<tr><td width=200 class=data>".$sellers[$i]->customer->CustomerNameArabic."</td><td class=data>".$sellers[$i]->customer->Nationality."</td><td class=data>".$sellers[$i]->customer->DocumentType."</td><td class=data>".$sellers[$i]->customer->DocumentNumber."</td><td class=data>".$sellertype."</td><td class=data>".$sellers[$i]->Share."</td></tr>";  
        }
		
        else 
        {
            $countns=1;
           $pagecounter++;
                ?>

</table>
<br>
<font color="#876532" style="float:right;margin:10px 0px 220px 0px;">Page :<?php echo $pagecounter ?>, contract id : <?php echo $cm->ContractsID; ?></font>    
<table width="780" style="text-align:center">
    
            <tr><td colspan="6"  style='font-weight:bold;'>&nbsp;</td></tr>
            <tr><td colspan="6" style='background:rgb(150,150,150);font-weight:bold'>الطرف اﻷول:</td></tr>
            <th>الإسم</th><th>الجنسية</th><th>الإثبات</th><th>رقم الإثبات</th><th>الصفة</th><th>النسبة</th>
            <?php
            echo "<tr><td width=200 class=data>".$sellers[$i]->customer->CustomerNameArabic."</td><td class=data>".$sellers[$i]->customer->Nationality."</td><td class=data>".$sellers[$i]->customer->DocumentType."</td><td class=data>".$sellers[$i]->customer->DocumentNumber."</td><td class=data>".$sellertype."</td><td class=data>".$sellers[$i]->Share."</td></tr>";
            $header++;        
            
        }
        
		
?>
<!-- 
</table>
</div>	


<div id="buyertable" style="margin:0.5cm;"><table width="650">-->
<tr><td colspan="6"  style='background:rgb(150,150,150);font-weight:bold;'>الطرف الثاني:</td></tr>
<th>الإسم</th><th>الجنسية</th><th>الإثبات</th><th>رقم الإثبات</th><th>الصفة</th><th>النسبة</th>

<?php

$countnbw=$countns;
$header=0;

	for ($i = 0; $i<=$nbw-1; $i++)
        if($countnbw<34)
        {
            $countnbw++;
            echo "<tr><td class=data>".$wbuyers[$i]->customer->CustomerNameArabic."</td><td class=data>".$wbuyers[$i]->customer->Nationality."</td><td class=data>".$wbuyers[$i]->customer->DocumentType."</td><td class=data>".$wbuyers[$i]->customer->DocumentNumber."</td><td class=data>".$wakeeltypes[$wbuyers[$i]->Type]."</td><td>".""."</td></tr>";
        }
	
        else 
        {
            $countnbw=1;
            $pagecounter++;
                ?>

</table>
<br>
<font color="#876532" style="float:right;margin:10px 0px 220px 0px;">Page :<?php echo $pagecounter ?>, contract id : <?php echo $cm->ContractsID; ?></font>    
<table width="780" style="text-align:center">
    
<tr><td colspan="6"  style='font-weight:bold;'>&nbsp;</td></tr>
<tr><td colspan="6"  style='background:rgb(150,150,150);font-weight:bold;'>الطرف الثاني:</td></tr>
<th>الإسم</th><th>الجنسية</th><th>الإثبات</th><th>رقم الإثبات</th><th>الصفة</th><th>النسبة</th>

<?php
echo "<tr><td class=data>".$wbuyers[$i]->customer->CustomerNameArabic."</td><td class=data>".$wbuyers[$i]->customer->Nationality."</td><td class=data>".$wbuyers[$i]->customer->DocumentType."</td><td class=data>".$wbuyers[$i]->customer->DocumentNumber."</td><td class=data>".$wakeeltypes[$wbuyers[$i]->Type]."</td><td>".""."</td></tr>";
$header++; 

        }        
            
?>

               
    
    <?php
    
$countnb=$countnbw;
$header=0; 
    
	for ($i = 0; $i<=$nb-1; $i++)
	{
            if($countnb<34)
            {
                $countnb++;
                if ($buyers[$i]->Share=="كامل الحصص")
			echo "<tr><td class=data>".$buyers[$i]->customer->CustomerNameArabic."</td><td class=data>".$buyers[$i]->customer->Nationality."</td><td class=data>".$buyers[$i]->customer->DocumentType."</td><td class=data>".$buyers[$i]->customer->DocumentNumber."</td><td class=data>".$buyertype."</td><td class=data>".$buyers[$i]->Share."</td></tr>";
		else
			echo "<tr><td class=data>".$buyers[$i]->customer->CustomerNameArabic."</td><td class=data>".$buyers[$i]->customer->Nationality."</td><td class=data>".$buyers[$i]->customer->DocumentType."</td><td class=data>".$buyers[$i]->customer->DocumentNumber."</td><td class=data>".$buyertype."</td><td class=data>".$buyers[$i]->Share."%</td></tr>";
               
            }
            
            else 
            {
                $countnb=1;
                $pagecounter++;
                ?>

</table>
<br>
<font color="#876532" style="float:right;margin:10px 0px 220px 0px;">Page :<?php echo $pagecounter ?>, contract id : <?php echo $cm->ContractsID; ?></font>    
<table width="780" style="text-align:center">

<tr><td colspan="6"  style='background:rgb(150,150,150);font-weight:bold;'>الطرف الثاني:</td></tr>
<th>الإسم</th><th>الجنسية</th><th>الإثبات</th><th>رقم الإثبات</th><th>الصفة</th><th>النسبة</th>
<?php

if ($buyers[$i]->Share=="كامل الحصص")
			echo "<tr><td class=data>".$buyers[$i]->customer->CustomerNameArabic."</td><td class=data>".$buyers[$i]->customer->Nationality."</td><td class=data>".$buyers[$i]->customer->DocumentType."</td><td class=data>".$buyers[$i]->customer->DocumentNumber."</td><td class=data>".$buyertype."</td><td class=data>".$buyers[$i]->Share."</td></tr>";
else
			echo "<tr><td class=data>".$buyers[$i]->customer->CustomerNameArabic."</td><td class=data>".$buyers[$i]->customer->Nationality."</td><td class=data>".$buyers[$i]->customer->DocumentType."</td><td class=data>".$buyers[$i]->customer->DocumentNumber."</td><td class=data>".$buyertype."</td><td class=data>".$buyers[$i]->Share."%</td></tr>";
               
$header++; 

            }
            
            
	}
        
        
?>



</table>
<!--
</table>
</div>	

<div id="landinfo" style="margin:0.5cm;">
<table  width="650">-->

<?      
$w=0;
$breakpage=$countnb;        
if($countnb<34&&$countnb>12)
{
    $pagecounter++;
    $w=1;
    while($breakpage<47)
    {
        
        $breakpage++;
        ?>
<br>
<?php
    }
}
?>



<?php
if($w==1)
{
?>
<font color="#876532" style="float:left;">Page :<?php echo $pagecounter ?>, contract id : <?php echo $cm->ContractsID; ?></font>
<?
}
?>

<table width="780" style="text-align:center">
<tr><td colspan="6" align="right"  style='background:rgb(150,150,150);font-weight:bold'>بيانات العقار</td></tr>
<tr><td>رقم السند:</td><td><?php echo $cm->land->LandID; ?></td><td>تاريخ السند</td><td><?php echo $cm->deed->DateCreated; ?></td><td>نوع العقار</td><td><?php echo $cm->land->Land_Type; ?></td></tr>
<tr><td>القطاع</td><td><?php echo $cm->land->Plot_No; ?></td><td>الحي</td><td><?php echo $cm->land->location; ?></td><td>رقم القطعة</td><td><?php echo $cm->land->Piece; ?></td></tr>
<tr><td>شمالا</td><td><?php echo $cm->land->North." متر"; ?></td><td>شرقا</td><td><?php echo $cm->land->East." متر"; ?></td><td>اجمالي المساحة</td><td><?php echo $cm->land->TotalArea." م<sup>2</sup>"; ?></td></tr>
<tr><td>جنوبا</td><td><?php echo $cm->land->South." متر"; ?></td><td>غربا</td><td><?php echo $cm->land->West." متر"; ?></td><td>سعر العقار</td><td><?php echo number_format($cm->AmountCorrected); ?></td></tr>
<tr><td>السعر باﻷحرف</td><td colspan="5"><?php $obj = new I18N_Arabic('Numbers');
 
     $obj->setFeminine(2);
     $obj->setFormat(1);
 
     $integer = $cm->AmountCorrected;
 
     $text = $obj->int2str($integer);
     $text.=' &nbsp; درهم إماراتي';
 
     echo $text; ?></td></tr>
<tr><td>الملاحظات</td><td colspan="5"><?php echo $cm->Remarks; ?></td></tr>






</table>
</div>



<div id="stuff" style="margin:0.5cm;font-size:13px;"><p style="first-child:10px;">
أولاَ: يقر الطرف اﻷول أن العقار المذكور أعلاه خال من أي رهونات أو التزمات مالية أو حجز ﻷمر قضائي أو من سائر الحقوق للغير أيا كان نوعها و كما يقر لاستلامه كامل المبلغ المذكور أعلاه.
</p>

<p style="first-line:10px;">
ثانياَ: أكد الطرف الثاني على أنه عاين العقار المذكور أعلاه و قبوله بحالته الراهنه علما ينافي الجهاله وأنه ملتزم بكافة القوانين و اللوائح الخاصة بالشأن العقاري أو تغير اتها وقت ﻷخر.
</p>
<br>
<span align="right">توقيع الطرف اﻷول</span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;توقيع الطرف الثاني
<br><br><br><br>
رقم الايصال: <?php echo $cm->InvoiceNo; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;اجمالي الرسوم: &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $cm->Fee; ?><br><br>
اسم الموظف: &nbsp;&nbsp;<?php echo $cm->UserID; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;التوقيع<br><br>
تدقيق المالية:<br>

<p align="left" style='font-size:1.7em;'><b>مدير دائرة اﻷراضي و اﻷملاك</b></p>


</div>


 </div>
        

</body>
<link type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.8.1.min.js"></script> 
<script type='text/javascript'>
	$("body").keyup(function(event) {
		if (event.keyCode==39)
		{
			var id = <?php echo $cm->ContractsID; ?>;
			id = id +1;
			location.href = '<?php echo $this->createUrl("contractsMaster/Print")?>/' + id;
		}
		if (event.keyCode==37)
		{
			var id = <?php echo $cm->ContractsID; ?>;
			id = id -1;
			location.href = '<?php echo $this->createUrl("contractsMaster/Print")?>/' + id;
		}
			
	});

</script>
</html>
