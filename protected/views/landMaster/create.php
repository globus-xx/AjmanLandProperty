<?php
/* @var $this LandMasterController */
/* @var $model LandMaster */

$this->breadcrumbs=array(
	'Land Masters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'قائمة الاراضي', 'url'=>array('index')),
	array('label'=>'إدارة الاراضي', 'url'=>array('admin')),
);
?>

<h1>إنشاء ارض جديد</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
