<?php
/* @var $this DeedCertificateController */
/* @var $model DeedCertificate */

$this->breadcrumbs=array(
	'Deed Certificates'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DeedCertificate', 'url'=>array('index')),
	array('label'=>'Create DeedCertificate', 'url'=>array('create')),
	array('label'=>'View DeedCertificate', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DeedCertificate', 'url'=>array('admin')),
);
?>

<h1>Update DeedCertificate <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>