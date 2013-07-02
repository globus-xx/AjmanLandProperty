<?php
/* @var $this ContractsMasterController */
/* @var $dataProvider CActiveDataProvider */



$this->menu=array(
	array('label'=>'Create Custom Report', 'url'=>array('newReportable')),
	array('label'=>'Custom Reports', 'url'=>array('reportables')),
	array('label'=>'Manage ContractsMaster', 'url'=>array('admin')),
);
?>

<h1>Custom Reports - Contracts</h1>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewReportable',
)); ?>
