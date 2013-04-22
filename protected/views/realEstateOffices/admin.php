<?php
/* @var $this RealEstateOfficesController */
/* @var $model RealEstateOffices */



$this->menu=array(
	array('label'=>'قائمة المكاتب العقارية', 'url'=>array('index')),
	array('label'=>'اضافة مكتب عقاري', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('real-estate-offices-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>ادارة المكاتب العقارية</h1>

<p style="display:none;">
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('خيارات أخرى للبحث','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'real-estate-offices-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'RealEstateID',
		'CommercialName',
		'OwnerName',
		'RegisteredDate',
		'ExpiryDate',
		'Address',
		/*
		'MobilePhone',
		'Email',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
