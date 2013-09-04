<?php
/* @var $this ExportedlettersController */
/* @var $model Exportedletters */

$this->breadcrumbs=array(
	'الرسائل الصادرة'=>array('index'),
	$model->ExportedletterID=>array('view','id'=>$model->ExportedletterID),
	'Update',
);

$this->menu=array(
	array('label'=>'قائمة الرسائل الصادرة', 'url'=>array('index')),	
	array('label'=>'عرض الرسائل الصادرة', 'url'=>array('view', 'id'=>$model->ExportedletterID)),
	array('label'=>'ادارة الرسائل الصادرة', 'url'=>array('admin')),
);
?>

<h1>تعديل الرسائل الصادرة <?php echo $model->ExportedletterID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>