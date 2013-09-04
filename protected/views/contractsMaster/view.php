<?php
/* @var $this ContractsMasterController */
/* @var $model ContractsMaster */



$this->menu=array(
//	array('label'=>'List ContractsMaster', 'url'=>array('index')),
	array('label'=>'إنشاء عقد جديد', 'url'=>array('create')),
	array('label'=>'حدث العقد', 'url'=>array('update', 'id'=>$model->ContractsID)),
//	array('label'=>'Delete ContractsMaster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ContractsID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'إدارة العقود', 'url'=>array('admin')),
);
?>

<h1>العقد رقم #<?php echo $model->ContractsID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ContractsID',
		'LandID',
		'DateCreated',
		'UserID',
		'ContractType',
		'DeedID',
		'SchemeID',
		'AmountEntered',
		'AmountCorrected',
		'UserIDcorrected',
		'UserIDApproved',
		'Fee',
		'InvoiceNo',
	),
)); ?>
