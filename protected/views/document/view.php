<?php
$this->breadcrumbs=array(
	'الملفات'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'قائمة الملفات', 'url'=>array('index')),
	array('label'=>'اضافة ملف', 'url'=>array('create')),
	array('label'=>'تعديل ملف', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'تحميل ملف', 'url'=>array('download', 'id'=>$model->id)),
	array('label'=>'حذف ملف', 'url'=>'delete/'.$model->id, 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item ?')),
	array('label'=>'ادارة ملف', 'url'=>array('admin')),
);
?>

<h1>عرض ملف #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'fileName',
		'mimeType',
		'fileSize',
	),
)); ?>
