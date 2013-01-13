<?php
/* @var $this CustomerMasterController */
/* @var $model CustomerMaster */



$this->menu=array(
	array('label'=>'قائمة المتعاملين', 'url'=>array('index')),
	array('label'=>'اضافة متعامل جديد', 'url'=>array('create')),
	//array('label'=>'عرض بيانات العميل', 'url'=>array('view', 'id'=>$model->CustomerID)),
	array('label'=>'إدارة المتعاملين', 'url'=>array('admin')),
);
?>

<h1>تحديث بيانات المتعامل رقم:  <?php echo $model->CustomerID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
