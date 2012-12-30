<!--            
        <input type="submit" value="generate .docx file">   
-->





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


<form action="choose" method="post" >

<table>
<tr><td>من فضلك اختر نوع الرسالة </td></tr>
<tr><td> نوع الرسالة</td><td>:</td>
    
    <td>
        <select name="mtype" >  
                   
           <?php 
            foreach($item as $row)
           { 
             ?>  
                     <option value="<?php echo $row->LetterID ?>"><?php echo $row->Title ?></option>           
           <?php
            }
           ?>
            
        </select> 
    </td>
</tr>
<tr><td colspan="3"><input type="submit" name="stype" value="التالي"></td></tr>
</table>

</form>



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



