<?php
/* @var $this DestinationController */
/* @var $model Destination */

$this->breadcrumbs=array(
	'الوجهات'=>array('index'),
	$model->DestinationID,
);

$this->menu=array(
	array('label'=>'عرض الوجهات', 'url'=>array('index')),
	array('label'=>'اضافة وجهة', 'url'=>array('create')),
	array('label'=>'تعديل وجهة', 'url'=>array('update', 'id'=>$model->DestinationID)),
	array('label'=>'حذف وجهة', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->DestinationID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'ادارة وجهة', 'url'=>array('admin')),
);
?>

<h1>عرض الوجهة   #<?php echo $model->DestinationID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'DestinationID',
		'DestinationName',
	),
)); ?>
