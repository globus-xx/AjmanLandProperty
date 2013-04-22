<?php
/* @var $this DeedCertificateController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Deed Certificates',
);

$this->menu=array(
	array('label'=>'Create DeedCertificate', 'url'=>array('create')),
	array('label'=>'Manage DeedCertificate', 'url'=>array('admin')),
);
?>

<h1>Deed Certificates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
