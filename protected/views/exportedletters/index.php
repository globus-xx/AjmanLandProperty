<?php
/* @var $this ExportedlettersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'الرسائل الصادرة',
);

$this->menu=array(	
	array('label'=>'ادارة الرسائل الصادرة', 'url'=>array('admin')),
);
?>

<h1>الرسائل الصادرة</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
