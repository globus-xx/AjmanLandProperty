<?php
/* @var $this ExportedlettersController */
/* @var $model Exportedletters */

$this->breadcrumbs=array(
	'Exportedletters'=>array('index'),
	$model->ExportedletterID,
);

$this->menu=array(
	array('label'=>'List Exportedletters', 'url'=>array('index')),		
	array('label'=>'Manage Exportedletters', 'url'=>array('admin')),
);
?>

<h1>View Exportedletters #<?php echo $model->ExportedletterID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ExportedletterID',
		'Exportedlettertext',
		'UserName',
		'ExportedDate',
	),
)); ?>
