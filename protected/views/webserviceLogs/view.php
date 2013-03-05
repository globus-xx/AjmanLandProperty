<?php
/* @var $this WebserviceLogsController */
/* @var $model WebserviceLogs */

$this->breadcrumbs=array(
	'Webservice Logs'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List WebserviceLogs', 'url'=>array('index')),
	array('label'=>'Create WebserviceLogs', 'url'=>array('create')),
	array('label'=>'Update WebserviceLogs', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete WebserviceLogs', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage WebserviceLogs', 'url'=>array('admin')),
);
?>

<h1>View WebserviceLogs #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'File_Name',
		'Time_Added',
	),
)); ?>
