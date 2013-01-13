<?php
/* @var $this DeedMasterController */
/* @var $data DeedMaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('DeedID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->DeedID), array('view', 'id'=>$data->DeedID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LandID')); ?>:</b>
	<?php echo CHtml::encode($data->LandID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SchemeID')); ?>:</b>
	<?php echo CHtml::encode($data->SchemeID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateCreated')); ?>:</b>
	<?php echo CHtml::encode($data->DateCreated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserID')); ?>:</b>
	<?php echo CHtml::encode($data->UserID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ContractID')); ?>:</b>
	<?php echo CHtml::encode($data->ContractID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('InvoiceNo')); ?>:</b>
	<?php echo CHtml::encode($data->InvoiceNo); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('Remarks')); ?>:</b>
	<?php echo CHtml::encode($data->Remarks); ?>
	<br />



</div>
