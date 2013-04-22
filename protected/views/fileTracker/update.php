<?php
/* @var $this FileTrackerController */
/* @var $model FileTracker */

$this->breadcrumbs=array(
	'File Trackers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FileTracker', 'url'=>array('index')),
	array('label'=>'Create FileTracker', 'url'=>array('create')),
	array('label'=>'View FileTracker', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage FileTracker', 'url'=>array('admin')),
);
?>

<h1>Update FileTracker <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>