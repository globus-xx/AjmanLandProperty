<?php
/* @var $this HajzMasterController */
/* @var $model HajzMaster */



$this->menu=array(
	array('label'=>'قائمة الحوزات و الرهون', 'url'=>array('index')),
	array('label'=>'إنشاء حجز او رهن جديد', 'url'=>array('create')),
	array('label'=>'عرض معلومات', 'url'=>array('view', 'id'=>$model->HajzID)),
	array('label'=>'إدارة الحجوز و الرهون', 'url'=>array('admin')),
);
?>

<h1>تحدث الحجز او الرهن <?php echo $model->HajzID; ?></h1>

<?php echo $this->renderPartial('_formupdate', array('model'=>$model,)); ?>
