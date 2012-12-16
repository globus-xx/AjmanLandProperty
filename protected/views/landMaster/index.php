<?php
/* @var $this LandMasterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Land Masters',
);

$this->menu=array(
	array('label'=>'إنشاء ارض جديد', 'url'=>array('create')),
	array('label'=>'إدارة الاراضي', 'url'=>array('admin')),
);
?>

<h1>بيانات الاراضي</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
