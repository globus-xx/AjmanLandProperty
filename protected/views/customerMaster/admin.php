<?php
/* @var $this CustomerMasterController */
/* @var $model CustomerMaster */



$this->menu=array(
	array('label'=>'قائمة المتعاملين', 'url'=>array('index')),
	array('label'=>'اضافة متعامل جديد', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('customer-master-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>إدارة المتعاملين</h1>

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
	'id'=>'customer-master-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'CustomerID',
		'CustomerNameArabic',
		'CustomerNameEnglish',
		'HomeAddress',
		'HomePhone',
		'MobilePhone',
		/*
		'DateofBirth',
		'Nationality',
		'Signature',
		'DocumentType',
		'DocumentNumber',
		'IssuedOn',
		'ExpiresOn',
		'EmailAddress',
		'Document',
		'Photo',
		'CustomerType',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
