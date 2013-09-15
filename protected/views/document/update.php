<?php
$this->breadcrumbs=array(
	'الملفات'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'قائمة الملفات', 'url'=>array('index')),
	array('label'=>'اضافة ملف', 'url'=>array('create')),
	array('label'=>'عرض ملف', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'ادارة ملف', 'url'=>array('admin')),
);

?>

<h1>تعديل ملف<?php echo $model->id; ?></h1>
<?php echo $this->renderPartial('_form', array('model'=>$model, '_documentType'=>$_documentType, '_model_document_metas'=>$_model_document_metas,'types' => $types, 'size' => $size)); ?>