<?php
/* @var $this TransactionTrackerController */
/* @var $model TransactionTracker */

$this->breadcrumbs=array(
	'Transaction Trackers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TransactionTracker', 'url'=>array('index')),
	array('label'=>'Manage TransactionTracker', 'url'=>array('admin')),
);
?>

<h1>Create TransactionTracker</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>