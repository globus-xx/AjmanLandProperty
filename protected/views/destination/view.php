<?php
/* @var $this DestinationController */
/* @var $model Destination */

$this->breadcrumbs=array(
	'Destinations'=>array('index'),
	$model->DestinationID,
);

$this->menu=array(
	array('label'=>'List Destination', 'url'=>array('index')),
	array('label'=>'Create Destination', 'url'=>array('create')),
	array('label'=>'Update Destination', 'url'=>array('update', 'id'=>$model->DestinationID)),
	array('label'=>'Delete Destination', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->DestinationID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Destination', 'url'=>array('admin')),
);
?>

<h1>View Destination #<?php echo $model->DestinationID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'DestinationID',
		'DestinationName',
	),
)); ?>
