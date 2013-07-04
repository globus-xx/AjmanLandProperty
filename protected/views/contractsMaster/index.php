<?php
/* @var $this ContractsMasterController */
/* @var $dataProvider CActiveDataProvider */



$this->menu=array(
	array('label'=>'Create ContractsMaster', 'url'=>array('create')),
	array('label'=>'Custom Reports', 'url'=>array('reportables')),
	array('label'=>'Manage ContractsMaster', 'url'=>array('admin')),
);
?>

<h1>Contracts Masters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
