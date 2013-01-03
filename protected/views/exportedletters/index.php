<?php
/* @var $this ExportedlettersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Exportedletters',
);

$this->menu=array(	
	array('label'=>'Manage Exportedletters', 'url'=>array('admin')),
);
?>

<h1>Exportedletters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
