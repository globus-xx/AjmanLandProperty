<?php
/* @var $this WebserviceLogsController */
/* @var $model WebserviceLogs */

$this->breadcrumbs=array(
	'Webservice Logs'=>array('index'),
	$model->Id=>array('view','id'=>$model->Id),
	'Update',
);

$this->menu=array(
	array('label'=>'List WebserviceLogs', 'url'=>array('index')),
	array('label'=>'Create WebserviceLogs', 'url'=>array('create')),
	array('label'=>'View WebserviceLogs', 'url'=>array('view', 'id'=>$model->Id)),
	array('label'=>'Manage WebserviceLogs', 'url'=>array('admin')),
);
?>

<h1>Update WebserviceLogs <?php echo $model->Id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>