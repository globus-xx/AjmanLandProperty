<?php
/* @var $this RealEstatePeopleController */
/* @var $model RealEstatePeople */

$this->breadcrumbs=array(
	'Real Estate Peoples'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List RealEstatePeople', 'url'=>array('index')),
	array('label'=>'Create RealEstatePeople', 'url'=>array('create')),
	array('label'=>'Update RealEstatePeople', 'url'=>array('update', 'id'=>$model->CardID)),
	array('label'=>'Delete RealEstatePeople', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CardID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RealEstatePeople', 'url'=>array('admin')),
);
?>

<h1>View RealEstatePeople #<?php echo $model->CardID; ?></h1>

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

