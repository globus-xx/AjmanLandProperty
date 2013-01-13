<?php
/* @var $this DeedCertificateController */
/* @var $model DeedCertificate */

$this->breadcrumbs=array(
	'Deed Certificates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DeedCertificate', 'url'=>array('index')),
	array('label'=>'Manage DeedCertificate', 'url'=>array('admin')),
);
?>

<h1>Create DeedCertificate</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>