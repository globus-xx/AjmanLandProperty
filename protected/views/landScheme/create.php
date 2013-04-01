<?php
/* @var $this LandSchemeController */
/* @var $model LandScheme */

$this->breadcrumbs=array(
	'Land Schemes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List LandScheme', 'url'=>array('index')),
	array('label'=>'Manage LandScheme', 'url'=>array('admin')),
);
?>

<h1>Create LandScheme</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>