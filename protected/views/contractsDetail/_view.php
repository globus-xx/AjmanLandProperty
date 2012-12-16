<?php
/* @var $this ContractsDetailController */
/* @var $data ContractsDetail */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ContractsDetailID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ContractsDetailID), array('view', 'id'=>$data->ContractsDetailID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ContractID')); ?>:</b>
	<?php echo CHtml::encode($data->ContractID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Type')); ?>:</b>
	<?php echo CHtml::encode($data->Type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CustomerID')); ?>:</b>
	<?php echo CHtml::encode($data->CustomerID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Share')); ?>:</b>
	<?php echo CHtml::encode($data->Share); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CardID')); ?>:</b>
	<?php echo CHtml::encode($data->CardID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Side')); ?>:</b>
	<?php echo CHtml::encode($data->Side); ?>
	<br />


</div>
