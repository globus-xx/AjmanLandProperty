<?php
/* @var $this ContractsMasterController */
/* @var $data ContractsMaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('viewReportable', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />
	<?php echo CHtml::link(CHtml::encode('Generate Report'), array('generateReportable', 'id'=>$data->id)); ?>

</div>
