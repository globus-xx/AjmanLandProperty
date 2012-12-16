<?php
/* @var $this TransactionTrackerController */
/* @var $model TransactionTracker */

$this->breadcrumbs=array(
	'Transaction Trackers'=>array('index'),
	$model->TransactionID=>array('view','id'=>$model->TransactionID),
	'Update',
);

$this->menu=array(
	array('label'=>'List TransactionTracker', 'url'=>array('index')),
	array('label'=>'Create TransactionTracker', 'url'=>array('create')),
	array('label'=>'View TransactionTracker', 'url'=>array('view', 'id'=>$model->TransactionID)),
	array('label'=>'Manage TransactionTracker', 'url'=>array('admin')),
);
?>

<h1>Update TransactionTracker <?php echo $model->TransactionID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>