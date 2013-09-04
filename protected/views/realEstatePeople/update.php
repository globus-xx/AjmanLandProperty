<?php
/* @var $this RealEstatePeopleController */
/* @var $model RealEstatePeople */

$this->breadcrumbs=array(
	'الوسطاء العقاريون'=>array('index'),
	$model->Name=>array('view','id'=>$model->CardID),
	'Update',
);

$this->menu=array(
	array('label'=>'عرض الوسطاء العقاريون', 'url'=>array('index')),
	array('label'=>'اضافة وسيط عقاري', 'url'=>array('create')),
	array('label'=>'عرض الوسيط', 'url'=>array('view', 'id'=>$model->CardID)),
	array('label'=>'ادارة الوسيط العقاري', 'url'=>array('admin')),
);
?>

<h1>تعديل الوسيط <?php echo $model->CardID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>