<?php
/* @var $this LandMasterController */
/* @var $model LandMaster */

$this->breadcrumbs=array(
	'Land Masters'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'قائمة الاراضي', 'url'=>array('index')),
	array('label'=>'إنشاء ارض جديد', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('land-master-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>إدارة الاراضي</h1>


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
	'id'=>'land-master-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'LandID',
		'LocationID',
		'Plot_No',
		'Piece',
		'location',
		'Land_Type',
		'TotalArea',
		/*
		'length',
		'width',
		'AreaUnit',
		'Remarks',
		'North',
		'South',
		'East',
		'West',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
