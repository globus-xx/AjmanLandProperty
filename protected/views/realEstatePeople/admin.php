<?php
/* @var $this RealEstatePeopleController */
/* @var $model RealEstatePeople */

$this->breadcrumbs=array(
	'الوسطاء العقاريون'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'عرض الوسطاء العقاريون', 'url'=>array('index')),
	array('label'=>'اضافة وسيط عقاري', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('real-estate-people-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>ادارة الوسطاء العقاريون</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('البحث المتقدم','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'real-estate-people-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'CardID',
		'CardNo',
		'Name',
		'Nationality',
		'Role',
		'IssueDate',
		/*
		'EndDate',
		'EntryDate',
		'RealEstateID',
		'CardEndDate',
		'UserID',
		'OperationType',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
