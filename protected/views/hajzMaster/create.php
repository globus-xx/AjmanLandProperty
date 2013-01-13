<?php
/* @var $this HajzMasterController */
/* @var $model HajzMaster */

$this->menu=array(
	array('label'=>'قائمة الحوزات و الرهون', 'url'=>array('index')),
	array('label'=>'إدارة الحجوزات و الرهون', 'url'=>array('admin')),
);
?>

<h1>اضافة حجز او رهن جديد</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'LandIDs'=>$LandIDs)); ?>
