<?php
/* @var $this DeedTrackerController */
/* @var $model DeedTracker */

$this->breadcrumbs=array(
	'Deed Trackers'=>array('index'),
	$model->TrackID,
);

$this->menu=array(
	array('label'=>'List DeedTracker', 'url'=>array('index')),
	array('label'=>'Create DeedTracker', 'url'=>array('create')),
	array('label'=>'Update DeedTracker', 'url'=>array('update', 'id'=>$model->TrackID)),
	array('label'=>'Delete DeedTracker', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->TrackID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DeedTracker', 'url'=>array('admin')),
);
?>

<h1>View DeedTracker #<?php echo $model->TrackID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'TrackID',
		'DeedID',
		'UserID',
		'DateTime',
		'Status',
	),
)); ?>
