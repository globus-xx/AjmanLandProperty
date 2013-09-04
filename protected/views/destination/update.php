<?php
/* @var $this DestinationController */
/* @var $model Destination */

$this->breadcrumbs=array(
	'الوجهات'=>array('index'),
	$model->DestinationID=>array('view','id'=>$model->DestinationID),
	'Update',
);

$this->menu=array(
	array('label'=>'عرض الوجهات', 'url'=>array('index')),
	array('label'=>'اضافة وجهة', 'url'=>array('create')),
	array('label'=>'عرض وجهة', 'url'=>array('view', 'id'=>$model->DestinationID)),
	array('label'=>'ادارة وجهة', 'url'=>array('admin')),
);
?>

<h1>     تعديل وجهة<?php echo $model->DestinationID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>