<?php
/* @var $this RealEstatePeopleController */
/* @var $model RealEstatePeople */

$this->breadcrumbs=array(
	'الوسطاء العقاريون'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'عرض الوسطاء العقاريون', 'url'=>array('index')),
	array('label'=>'اضافة وسيط عقاري', 'url'=>array('create')),
	array('label'=>'تعديل الوسيط العقاري', 'url'=>array('update', 'id'=>$model->CardID)),
	array('label'=>'حذف الوسيط العقاري', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CardID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'ادارة الوسيط العقاري', 'url'=>array('admin')),
);
?>

<h1>عرض الوسيط  #<?php echo $model->CardID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CardID',
		'CardNo',
		'Name',
		'Nationality',
		'Role',
		'IssueDate',
		'EndDate',
		'EntryDate',
		'RealEstateID',
		'CardEndDate',
		'UserID',
		'OperationType',
	),
)); ?>
<?php 
// code for attach a document thingamabob
echo $this->renderPartial('/documentable/_attachinary', array('documentableType'=>'real_estate_people', 
							'documentableId'=>$model->CardID));
?>

