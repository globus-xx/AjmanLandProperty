<?php
/* @var $this DeedTrackerController */
/* @var $model DeedTracker */

$this->breadcrumbs=array(
	'Deed Trackers'=>array('index'),
	$model->TrackID=>array('view','id'=>$model->TrackID),
	'Update',
);

$this->menu=array(
	array('label'=>'List DeedTracker', 'url'=>array('index')),
	array('label'=>'Create DeedTracker', 'url'=>array('create')),
	array('label'=>'View DeedTracker', 'url'=>array('view', 'id'=>$model->TrackID)),
	array('label'=>'Manage DeedTracker', 'url'=>array('admin')),
);
?>

<h1>Update DeedTracker <?php echo $model->TrackID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>