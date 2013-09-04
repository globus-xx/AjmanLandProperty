<?php
/* @var $this LandMasterController */
/* @var $model LandMaster */

$this->breadcrumbs=array(
	'Land Masters'=>array('index'),
	$model->LandID,
);

$this->menu=array(
	array('label'=>'قائمة الاراضي', 'url'=>array('index')),
	array('label'=>'إنشاء ارض جديد', 'url'=>array('create')),
	array('label'=>'حدث بيانات', 'url'=>array('update', 'id'=>$model->LandID)),
//	array('label'=>'Delete LandMaster', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->LandID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'إدارة الاراضي', 'url'=>array('admin')),
);
?>

<h1>بيانات الارض رقم  <?php echo $model->LandID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'LandID',
		'LocationID',
		'Plot_No',
		'Piece',
		'location',
		'Land_Type',
		'TotalArea',
		'length',
		'width',
		'AreaUnit',
		'Remarks',
		'North',
		'South',
		'East',
		'West',
	),
)); ?>
