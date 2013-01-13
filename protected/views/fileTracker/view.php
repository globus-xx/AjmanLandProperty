<?php
/* @var $this FileTrackerController */
/* @var $model FileTracker */

$this->breadcrumbs=array(
	'File Trackers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List FileTracker', 'url'=>array('index')),
	array('label'=>'Create FileTracker', 'url'=>array('create')),
	array('label'=>'Update FileTracker', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FileTracker', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FileTracker', 'url'=>array('admin')),
);
?>

<h1>View FileTracker #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'LandID',
		'UserIDgiver',
		'UserIDreceiver',
		'Department',
		'DateTime',
		'Status',
	),
)); ?>
