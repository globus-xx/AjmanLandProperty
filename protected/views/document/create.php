<?php



$this->breadcrumbs=array(
	'الملفات'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'قائمة الملفات', 'url'=>array('index')),
	array('label'=>'ادارة ملف', 'url'=>array('admin')),
);


?>

<h1>اضافة ملف</h1>

<?php   echo $this->renderPartial('_form', array('model'=>$model)); ?>