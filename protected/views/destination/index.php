<?php
/* @var $this DestinationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'الوجهات',
);

$this->menu=array(
	array('label'=>'اضافة وجهة', 'url'=>array('create')),
	array('label'=>'ادارة وجهة', 'url'=>array('admin')),
);
?>

<h1>الوجهات</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
