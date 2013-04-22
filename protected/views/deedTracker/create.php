<?php
/* @var $this DeedTrackerController */
/* @var $model DeedTracker */

$this->breadcrumbs=array(
	'Deed Trackers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DeedTracker', 'url'=>array('index')),
	array('label'=>'Manage DeedTracker', 'url'=>array('admin')),
);
?>

<h1>Create DeedTracker</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>