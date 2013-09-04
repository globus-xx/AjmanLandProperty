<?php
/* @var $this DeedMasterController */
/* @var $model DeedMaster */



$this->menu=array(
	array('label'=>'قائمة ملكيات', 'url'=>array('index')),
	array('label'=>'اضافة ملكية جديدة', 'url'=>array('create')),
	array('label'=>'عرض الملكية', 'url'=>array('view', 'id'=>$model->DeedID)),
	array('label'=>'إدارة الملكيات', 'url'=>array('admin')),
);
?>

<h1>تعديل عقد <?php echo $model->DeedID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
