<?php
/* @var $this DeedTrackerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Deed Trackers',
);

$this->menu=array(
	array('label'=>'Create DeedTracker', 'url'=>array('create')),
	array('label'=>'Manage DeedTracker', 'url'=>array('admin')),
);
?>

<h1>Deed Trackers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
