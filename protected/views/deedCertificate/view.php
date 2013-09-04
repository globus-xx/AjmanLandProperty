<?php
/* @var $this DeedCertificateController */
/* @var $model DeedCertificate */

$this->breadcrumbs=array(
	'Deed Certificates'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DeedCertificate', 'url'=>array('index')),
	array('label'=>'Create DeedCertificate', 'url'=>array('create')),
	array('label'=>'Update DeedCertificate', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DeedCertificate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DeedCertificate', 'url'=>array('admin')),
);
?>

<h1>View DeedCertificate #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'sha1',
		'LandID',
		'DeedID',
		'ContractsID',
		'UserID',
		'DateTime',
	),
)); ?>
