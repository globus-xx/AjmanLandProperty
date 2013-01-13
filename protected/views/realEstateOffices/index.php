<?php
/* @var $this RealEstateOfficesController */
/* @var $dataProvider CActiveDataProvider */


$this->menu=array(
	array('label'=>'اضافة مكتب عقاري', 'url'=>array('create')),
	array('label'=>'ادارة المكاتب العقارية', 'url'=>array('admin')),
);
?>

<h1>المكاتب العقارية</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
