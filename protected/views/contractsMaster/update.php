<?php
/* @var $this ContractsMasterController */
/* @var $model ContractsMaster */



$this->menu=array(
	//array('label'=>'List ContractsMaster', 'url'=>array('index')),
	array('label'=>'إنشاء عقد جديد', 'url'=>array('create')),
	array('label'=>'عرض العقد', 'url'=>array('view', 'id'=>$model->ContractsID)),
	array('label'=>'إدارة العقود', 'url'=>array('admin')),
);
?>

<h1>تحديث بيانات العقد <?php echo $model->ContractsID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
