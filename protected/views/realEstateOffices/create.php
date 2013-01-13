<?php
/* @var $this RealEstateOfficesController */
/* @var $model RealEstateOffices */



$this->menu=array(
	array('label'=>'قائمة المكاتب العقارية', 'url'=>array('index')),
	array('label'=>'ادارة المكاتب العقارية', 'url'=>array('admin')),
);
?>

<h1>اضافة مكتب عقاري</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
