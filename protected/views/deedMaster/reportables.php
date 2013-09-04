<h1>التقارير الخاصة - الوثائق</h1><?php
/* @var $this ContractsMasterController */
/* @var $dataProvider CActiveDataProvider */



$this->menu = array(
	array('label'=>'انشاء تقرير خاص', 'url'=>array('newReportable')),
	array('label'=>'تقارير خاصة', 'url'=>array('reportables')),
	array('label'=>'ادارة العقود', 'url'=>array('admin')),
);
?>


<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewReportable',
)); ?>
