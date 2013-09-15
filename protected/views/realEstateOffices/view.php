<?php
/* @var $this RealEstateOfficesController */
/* @var $model RealEstateOffices */

$this->menu=array(
	array('label'=>'قائمة المكاتب العقارية', 'url'=>array('index')),
	array('label'=>'اضافة مكتب عقاري', 'url'=>array('create')),
	array('label'=>'تحديث بيانات المكتب العقاري', 'url'=>array('update', 'id'=>$model->RealEstateID)),
//	array('label'=>'Delete RealEstateOffices', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->RealEstateID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'ادارة المكاتب العقارية', 'url'=>array('admin')),
);
?>

<h1>عرض بيانات المكتب العقاري #<?php echo $model->RealEstateID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'RealEstateID',
		'CommercialName',
		'OwnerName',
		'RegisteredDate',
		'ExpiryDate',
		'Address',
		'MobilePhone',
		'Email',
	),
)); ?>
<?php 
// code for attach a document thingamabob
echo $this->renderPartial('/documentable/_attachinary', array('documentableType'=>'realestateoffices', 
							'documentableId'=>$model->RealEstateID));
?>
