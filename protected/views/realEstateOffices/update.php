<?php
/* @var $this RealEstateOfficesController */
/* @var $model RealEstateOffices */



$this->menu=array(
	array('label'=>'قائمة المكاتب العقارية', 'url'=>array('index')),
	array('label'=>'اضافة مكتب عقاري', 'url'=>array('create')),
	array('label'=>'عرض بيانات المكتب العقاري', 'url'=>array('view', 'id'=>$model->RealEstateID)),
	array('label'=>'ادارة المكاتب العقارية', 'url'=>array('admin')),
);
?>

<h1>تحديث بيانات المكتب العقاري<?php echo $model->RealEstateID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
