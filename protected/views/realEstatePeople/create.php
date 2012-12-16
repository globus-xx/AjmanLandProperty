<?php
/* @var $this RealEstatePeopleController */
/* @var $model RealEstatePeople */

$this->breadcrumbs=array(
	'Real Estate Peoples'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RealEstatePeople', 'url'=>array('index')),
	array('label'=>'Manage RealEstatePeople', 'url'=>array('admin')),
);
?>

<h1>Create RealEstatePeople</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>