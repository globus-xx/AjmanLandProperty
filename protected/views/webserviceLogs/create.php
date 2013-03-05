<?php
/* @var $this WebserviceLogsController */
/* @var $model WebserviceLogs */

$this->breadcrumbs=array(
	'Webservice Logs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List WebserviceLogs', 'url'=>array('index')),
	array('label'=>'Manage WebserviceLogs', 'url'=>array('admin')),
);
?>

<h1>Create WebserviceLogs</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>