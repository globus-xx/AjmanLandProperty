<?php
$this->breadcrumbs=array(
	'Document Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DocumentTypes', 'url'=>array('index')),
	array('label'=>'Manage DocumentTypes', 'url'=>array('admin')),
);
?>

<h1>Create DocumentTypes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, '_model_document_type_meta'=>$_model_document_type_meta)); ?>