<?php
/* @var $this DeedMasterController */
/* @var $dataProvider CActiveDataProvider */



$this->menu=array(
	array('label'=>'اضافة ملكية جديدة', 'url'=>array('create')),
	array('label'=>'إدارة الملكيات', 'url'=>array('admin')),
);
?>

<h1>الملكيات</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
