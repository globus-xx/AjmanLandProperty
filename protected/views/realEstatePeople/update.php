<?php
/* @var $this RealEstatePeopleController */
/* @var $model RealEstatePeople */

$this->breadcrumbs=array(
	'Real Estate Peoples'=>array('index'),
	$model->Name=>array('view','id'=>$model->CardID),
	'Update',
);

$this->menu=array(
	array('label'=>'List RealEstatePeople', 'url'=>array('index')),
	array('label'=>'Create RealEstatePeople', 'url'=>array('create')),
	array('label'=>'View RealEstatePeople', 'url'=>array('view', 'id'=>$model->CardID)),
	array('label'=>'Manage RealEstatePeople', 'url'=>array('admin')),
);
?>

<h1>Update RealEstatePeople <?php echo $model->CardID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>