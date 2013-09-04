<?php
$this->breadcrumbs=array(
	'الملفات',
);

$this->menu=array(
	array('label'=>'اضافة ملف', 'url'=>array('create')),
	array('label'=>'ادارة ملف', 'url'=>array('admin')),
);
?>

<h1>الملفات</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
