<?php
/* @var $this FileTrackerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'File Trackers',
);

$this->menu=array(
	array('label'=>'Create FileTracker', 'url'=>array('create')),
	array('label'=>'Manage FileTracker', 'url'=>array('admin')),
);
?>

<h1>File Trackers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
