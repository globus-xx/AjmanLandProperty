<?php
/* @var $this CustomerMasterController */
/* @var $model CustomerMaster */



$this->menu=array(
	array('label'=>'قائمة المتعاملين', 'url'=>array('index')),
	array('label'=>'إدارة المتعاملين', 'url'=>array('admin')),
);
?>

<h1>اضافة متعامل جديد</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
