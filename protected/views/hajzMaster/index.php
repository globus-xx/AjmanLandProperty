<?php
/* @var $this HajzMasterController */
/* @var $dataProvider CActiveDataProvider */



$this->menu=array(
	array('label'=>'اضافة حجز او رهن جديد', 'url'=>array('create')),
	array('label'=>'ادارة الحجوزات و الرهون', 'url'=>array('admin')),
);
?>

<h1> الحجوزات و الرهون</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
