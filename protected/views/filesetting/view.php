<?php


$this->menu=array(		
	array('label'=>'تعديل', 'url'=>array('update', 'id'=>$model->id)),
		
);
?>

<h1> الاعدادات</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'file_types',
		'file_size',
	),
)); ?>
