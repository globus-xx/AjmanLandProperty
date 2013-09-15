<?php

$this->menu=array(		
	array('label'=>'عرض', 'url'=>array('view', 'id'=>$model->id)),	
);
?>

<h1>تعديل الاعدادات </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>