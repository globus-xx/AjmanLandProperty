<?php
/* @var $this DeedMasterController */
/* @var $model DeedMaster */



$this->menu=array(
	array('label'=>'قائمة ملكيات', 'url'=>array('index')),
	array('label'=>'اضافة ملكية جديدة', 'url'=>array('create')),
	array('label'=>'حدث بيانات', 'url'=>array('update', 'id'=>$model->DeedID)),
//	array('label'=>'Delete DeedMaster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->DeedID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'إدارة الملكيات', 'url'=>array('admin')),
);
?>

<h1>View DeedMaster #<?php echo $model->DeedID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'DeedID',
		'LandID',
		'SchemeID',
		'DateCreated',
		'UserID',
		'ContractID',
		'InvoiceNo',
		'Docs',
		'Remarks',
	),
)); ?>
