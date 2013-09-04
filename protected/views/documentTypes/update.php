<?php
$this->breadcrumbs=array(
	'انواع الوثائق'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'عرض انواع الوثائق', 'url'=>array('index')),
	array('label'=>'اضافة نوع', 'url'=>array('create')),
	array('label'=>'عرض نوع', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'ادارة نوع', 'url'=>array('admin')),
);
?>

<h1>تعديل نوع <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, '_model_document_type_meta'=>$_model_document_type_meta, '_model_document_type_metas'=>$_model_document_type_metas)); ?>