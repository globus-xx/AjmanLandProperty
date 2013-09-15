<?php
$this->breadcrumbs=array(
	'انواع الوثائق'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'عرض انواع الوثائق', 'url'=>array('index'))
	//array('label'=>'ادارة انواع الوثائق', 'url'=>array('admin')),
);
?>

<h1>اضافة نوع وثيقة</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, '_model_document_type_meta'=>$_model_document_type_meta , 'tables' => $tables)); ?>