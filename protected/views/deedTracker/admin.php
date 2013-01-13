<?php
/* @var $this DeedTrackerController */
/* @var $model DeedTracker */


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('deed-tracker-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>ادارة تاريخ طباعة الملكيات</h1>

<!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'deed-tracker-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'TrackID',
		'DeedID',
		'LandID',
		'UserID',
		'DateTime',
		'Status',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
