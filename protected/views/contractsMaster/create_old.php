<?php
/* @var $this ContractsMasterController */
/* @var $model ContractsMaster */

$this->breadcrumbs=array(
	'Contracts Masters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'عرض العقود', 'url'=>array('index')),
	array('label'=>'ادارة العقود', 'url'=>array('admin')),
);
?>

<h1>انشاء عقد</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>