<?php
$this->breadcrumbs=array(
	'انواع الوثائق',
);

$this->menu=array(
	array('label'=>'اضافة نوع', 'url'=>array('create')),
	array('label'=>'ادارة الانواع', 'url'=>array('admin')),
);
?>

<h1>انواع الوثائق</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
