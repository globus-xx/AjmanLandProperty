<?php
/* @var $this DestinationController */
/* @var $model Destination */

$this->breadcrumbs=array(
	'Destinations'=>array('index'),
	$model->DestinationID=>array('view','id'=>$model->DestinationID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Destination', 'url'=>array('index')),
	array('label'=>'Create Destination', 'url'=>array('create')),
	array('label'=>'View Destination', 'url'=>array('view', 'id'=>$model->DestinationID)),
	array('label'=>'Manage Destination', 'url'=>array('admin')),
);
?>

<h1>Update Destination <?php echo $model->DestinationID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>