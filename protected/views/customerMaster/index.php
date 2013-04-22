<?php
/* @var $this CustomerMasterController */
/* @var $dataProvider CActiveDataProvider */



$this->menu=array(
	array('label'=>'اضافة متعامل جديد', 'url'=>array('create')),
	array('label'=>'إدارة المتعاملين', 'url'=>array('admin')),
);
?>

<h1>المتعاملين</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
