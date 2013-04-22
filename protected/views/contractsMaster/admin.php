<?php
/* @var $this ContractsMasterController */
/* @var $model ContractsMaster */


$this->menu=array(
	//array('label'=>'قائمة عقود', 'url'=>array('index')),
	array('label'=>'إنشاء عقد جديد', 'url'=>array('landsearch')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('contracts-master-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>إدارة العقود</h1>
<p style="display:none;">>
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
	'id'=>'contracts-master-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ContractsID',
		'LandID',
		'DateCreated',
		'UserID',
		'ContractType',
		'DeedID',
		//'SchemeID',
		'AmountEntered',
		'AmountCorrected',
		'UserIDcorrected',
		//'UserIDApproved',
		'Fee',
		//'InvoiceNo',
		'Remarks',
		'Status',
		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
