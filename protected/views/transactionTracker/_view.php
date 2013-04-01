<?php
/* @var $this TransactionTrackerController */
/* @var $data TransactionTracker */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TransactionID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TransactionID), array('view', 'id'=>$data->TransactionID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TransactionType')); ?>:</b>
	<?php echo CHtml::encode($data->TransactionType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RecordID')); ?>:</b>
	<?php echo CHtml::encode($data->RecordID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserID')); ?>:</b>
	<?php echo CHtml::encode($data->UserID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CpuID')); ?>:</b>
	<?php echo CHtml::encode($data->CpuID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateTimeStart')); ?>:</b>
	<?php echo CHtml::encode($data->DateTimeStart); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateTimeFinish')); ?>:</b>
	<?php echo CHtml::encode($data->DateTimeFinish); ?>
	<br />


</div>