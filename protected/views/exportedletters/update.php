<?php
/* @var $this ExportedlettersController */
/* @var $model Exportedletters */

$this->breadcrumbs=array(
	'Exportedletters'=>array('index'),
	$model->ExportedletterID=>array('view','id'=>$model->ExportedletterID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Exportedletters', 'url'=>array('index')),	
	array('label'=>'View Exportedletters', 'url'=>array('view', 'id'=>$model->ExportedletterID)),
	array('label'=>'Manage Exportedletters', 'url'=>array('admin')),
);
?>

<h1>Update Exportedletters <?php echo $model->ExportedletterID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>