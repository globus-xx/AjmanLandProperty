<?php
/* @var $this TransactionTrackerController */
/* @var $model TransactionTracker */

$this->breadcrumbs=array(
	'Transaction Trackers'=>array('index'),
	$model->TransactionID,
);

$this->menu=array(
	array('label'=>'List TransactionTracker', 'url'=>array('index')),
	array('label'=>'Create TransactionTracker', 'url'=>array('create')),
	array('label'=>'Update TransactionTracker', 'url'=>array('update', 'id'=>$model->TransactionID)),
	array('label'=>'Delete TransactionTracker', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->TransactionID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TransactionTracker', 'url'=>array('admin')),
);
?>

<h1>View TransactionTracker #<?php echo $model->TransactionID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'TransactionID',
		'TransactionType',
		'RecordID',
		'UserID',
		'CpuID',
		'DateTimeStart',
		'DateTimeFinish',
	),
)); ?>
