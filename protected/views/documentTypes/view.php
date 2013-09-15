<?php
$this->breadcrumbs=array(
	'انواع الوثائق'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'عرض انواع الوثائق', 'url'=>array('index')),
	array('label'=>'اضافة نوع', 'url'=>array('create')),
	//array('label'=>'تعديل نوع', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'حذف نوع', 'url'=>'delete/'.$model->id, 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'ادارة نوع', 'url'=>array('admin')),
);
?>

<h1>عرض انواع الوثائق #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'createdAt',
		'updatedAt',
	),
)); 
?>
<h2>متحولات خاصة</h2><?php
foreach($_model_document_type_metas as $one_meta):
  $this->widget('zii.widgets.CDetailView', array(
  'data'=>$one_meta,
  'attributes'=>array(
    'meta_option',
    'meta_type'
  ),
)); 
endforeach;
?>
