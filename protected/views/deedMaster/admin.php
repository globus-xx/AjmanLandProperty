<?php
/* @var $this DeedMasterController */
/* @var $model DeedMaster */


$this->menu=array(
	array('label'=>'قائمة الملكيات', 'url'=>array('index')),
	array('label'=>'اضافة ملكية جديدة', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('deed-master-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>إدارة الملكيات</h1>

<p style="display:none;">
يمكنك إدخال عامل تشغيل مقارنة اختياريا ( (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
أو <b>=</b>)  في بداية كل القيم البحث لتحديد الكيفية التي ينبغي أن يتم المقارنة
</p>

<?php echo CHtml::link('خيارات أخرى للبحث','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'deed-master-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'DeedID',
		'LandID',
		'SchemeID',
		'DateCreated',
		'UserID',
		'ContractID',
		'Remarks',
		/*
		'InvoiceNo',
		'Docs',
		'Remarks',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
