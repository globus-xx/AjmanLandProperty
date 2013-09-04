<?php
/* @var $this ExportedlettersController */
/* @var $model Exportedletters */

$this->breadcrumbs=array(
	'الرسائل الصادرة'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'قائمة الرسائل الصادرة', 'url'=>array('index')),
	array('label'=>'ادارة الرسائل الصادرة', 'url'=>array('admin')),
);
?>

<h1>انشاء رسالة صادرة</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>