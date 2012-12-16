<?php
/* @var $this TransactionTrackerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Transaction Trackers',
);

$this->menu=array(
	array('label'=>'Create TransactionTracker', 'url'=>array('create')),
	array('label'=>'Manage TransactionTracker', 'url'=>array('admin')),
);
?>

<h1>Transaction Trackers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
