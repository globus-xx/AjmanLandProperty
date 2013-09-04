<?php
/* @var $this RealEstatePeopleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'الوسطاء العقاريون',
);

$this->menu=array(
	array('label'=>'اضافة وسيط عقاري', 'url'=>array('create')),
	array('label'=>'ادارة الوسيط العقاري', 'url'=>array('admin')),
);
?>

<h1>الوسطاء العقاريون</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
