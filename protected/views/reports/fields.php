
  
  
  
<?php
/* @var $this ReportsController */
?>

<h1>اختر الحقل من فضلك</h1>
<ul>
<?
foreach($fields as $row)
{
?>
    
<li>
    
<?php echo CHtml::link($row["Field"],array('reports/CalculateChart','field'=>$row["Field"],'table'=>$table)); ?>      
    
    <!--<a href="report/CalculateChart/<?=$row["Field"]?>"><?=$row["Field"]?></a>-->

</li>

<?   
}
?>

</ul>

<br>












