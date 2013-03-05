<?php
/* @var $this WebserviceLogsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Webservice Logs',
);

$this->menu=array(
	array('label'=>'Create WebserviceLogs', 'url'=>array('create')),
	array('label'=>'Manage WebserviceLogs', 'url'=>array('admin')),
);
?>

<h1>Webservice Logs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
