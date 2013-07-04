<?php
$this->breadcrumbs=array(
	'Document Types'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DocumentTypes', 'url'=>array('index')),
	array('label'=>'Create DocumentTypes', 'url'=>array('create')),
	array('label'=>'View DocumentTypes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DocumentTypes', 'url'=>array('admin')),
);
?>

<h1>Update DocumentTypes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, '_model_document_type_meta'=>$_model_document_type_meta, '_model_document_type_metas'=>$_model_document_type_metas)); ?>