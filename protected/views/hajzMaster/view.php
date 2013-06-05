<?php
/* @var $this HajzMasterController */
/* @var $model HajzMaster */



$this->menu=array(
	array('label'=>'قائمة الحوز و الرهون', 'url'=>array('index')),
	array('label'=>'إنشاء حجز او رهن جديد', 'url'=>array('create')),
	//	array('label'=>'Delete HajzMaster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->HajzID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'حدث المعلومات', 'url'=>array('update', 'id'=>$model->HajzID)),
	array('label'=>'إدارة الحجوز و الرهون', 'url'=>array('admin')),
);
?>

<h1>الحجز رقم #<?php echo $model->HajzID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'HajzID',
		'LandID',
		'DeedID',
		'SchemeID',
		'Type',
		'TypeDetail',
		'DocsCreated',
		'UserIDcreated',
		'DateCreated',
		'AmountMortgaged',
		'PeriodofTime',
		'UserIDended',
		'DateEnded',
		'DocsEnded',
		'IsActive',
	),
)); ?><?php 
// code for attach a document thingamabob
echo $this->renderPartial('/documentable/_attachinary', array('documentableType'=>'hajz', 
							'documentableId'=>$model->HajzID));
?>

