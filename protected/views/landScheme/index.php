<?php
/* @var $this LandSchemeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Land Schemes',
);

$this->menu=array(
	array('label'=>'Create LandScheme', 'url'=>array('create')),
	array('label'=>'Manage LandScheme', 'url'=>array('admin')),
);
?>

<h1>Land Schemes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
