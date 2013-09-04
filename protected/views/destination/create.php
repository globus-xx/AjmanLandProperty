<?php
/* @var $this DestinationController */
/* @var $model Destination */

$this->breadcrumbs=array(
	'الوجهات'=>array('index'),
	'انشاء',
);

$this->menu=array(
	array('label'=>'عرض الوجهات', 'url'=>array('index')),
	array('label'=>'ادارة وجهة', 'url'=>array('admin')),
);
?>

<h1>اضافة وجهة </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>