<?php
/* @var $this LandSchemeController */
/* @var $model LandScheme */

$this->breadcrumbs=array(
	'Land Schemes'=>array('index'),
	$model->SchemeID=>array('view','id'=>$model->SchemeID),
	'Update',
);

$this->menu=array(
	array('label'=>'List LandScheme', 'url'=>array('index')),
	array('label'=>'Create LandScheme', 'url'=>array('create')),
	array('label'=>'View LandScheme', 'url'=>array('view', 'id'=>$model->SchemeID)),
	array('label'=>'Manage LandScheme', 'url'=>array('admin')),
);
?>

<h1>Update LandScheme <?php echo $model->SchemeID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>