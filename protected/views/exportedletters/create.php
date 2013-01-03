<?php
/* @var $this ExportedlettersController */
/* @var $model Exportedletters */

$this->breadcrumbs=array(
	'Exportedletters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Exportedletters', 'url'=>array('index')),
	array('label'=>'Manage Exportedletters', 'url'=>array('admin')),
);
?>

<h1>Create Exportedletters</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>