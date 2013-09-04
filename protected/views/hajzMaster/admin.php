<?php
/* @var $this HajzMasterController */
/* @var $model HajzMaster */


$this->menu=array(
	array('label'=>'قائمة الحجوزات و الرهون', 'url'=>array('index')),
	array('label'=>'اضافة حجز او رهن جديد', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('hajz-master-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>إدارة الحجوز و الرهون</h1>

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
	'id'=>'hajz-master-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'HajzID',
		'LandID',
		'DeedID',
		'SchemeID',
		'Type',
		'TypeDetail',
		'IsActive',
		/*
		'DocsCreated',
		'UserIDcreated',
		'DateCreated',
		'AmountMortgaged',
		'PeriodofTime',
		'UserIDended',
		'DateEnded',
		'DocsEnded',
		'IsActive',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
