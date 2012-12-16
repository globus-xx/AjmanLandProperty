<?php
/* @var $this LandSchemeController */
/* @var $model LandScheme */

$this->breadcrumbs=array(
	'Land Schemes'=>array('index'),
	$model->SchemeID,
);

$this->menu=array(
	array('label'=>'List LandScheme', 'url'=>array('index')),
	array('label'=>'Create LandScheme', 'url'=>array('create')),
	array('label'=>'Update LandScheme', 'url'=>array('update', 'id'=>$model->SchemeID)),
	array('label'=>'Delete LandScheme', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->SchemeID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LandScheme', 'url'=>array('admin')),
);
?>

<h1>View LandScheme #<?php echo $model->SchemeID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'SchemeID',
		'LandID',
		'SchemeDrawing',
		'MunicipalityID',
		'DateInserted',
	),
)); ?>
