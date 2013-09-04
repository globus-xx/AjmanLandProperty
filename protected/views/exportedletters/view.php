<?php
/* @var $this ExportedlettersController */
/* @var $model Exportedletters */

$this->breadcrumbs=array(
	'الرسائل الصادرة'=>array('index'),
	$model->ExportedletterID,
);

$this->menu=array(
	array('label'=>'قائمة الرسائل الصادرة', 'url'=>array('index')),		
	array('label'=>'ادارة الرسائل الصادرة', 'url'=>array('admin')),
);
?>

<h1>عرض الرسائل الصادرة #<?php echo $model->ExportedletterID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ExportedletterID',
		'Exportedlettertext',
		'UserName',
		'ExportedDate',
	),
)); ?>
