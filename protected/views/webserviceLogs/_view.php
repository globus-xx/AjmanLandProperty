<?php
/* @var $this WebserviceLogsController */
/* @var $data WebserviceLogs */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('File_Name')); ?>:</b>
	<?php echo CHtml::encode($data->File_Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Time_Added')); ?>:</b>
	<?php echo CHtml::encode($data->Time_Added); ?>
	<br />


</div>