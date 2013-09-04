<?php
/* @var $this RealEstatePeopleController */
/* @var $model RealEstatePeople */

$this->breadcrumbs=array(
	'الوسطاء العقاريون'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'عرض الوسطاء العقاريون', 'url'=>array('index')),
	array('label'=>'ادارة الوسيط العقاري', 'url'=>array('admin')),
);
?>

<h1>اضافة وسيط عقاري</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>