<?php
/* @var $this RealEstatePeopleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Real Estate Peoples',
);

$this->menu=array(
	array('label'=>'Create RealEstatePeople', 'url'=>array('create')),
	array('label'=>'Manage RealEstatePeople', 'url'=>array('admin')),
);
?>

<h1>Real Estate Peoples</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
