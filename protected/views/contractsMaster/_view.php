<?php
/* @var $this ContractsMasterController */
/* @var $data ContractsMaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ContractsID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ContractsID), array('view', 'id'=>$data->ContractsID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LandID')); ?>:</b>
	<?php echo CHtml::encode($data->LandID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateCreated')); ?>:</b>
	<?php echo CHtml::encode($data->DateCreated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserID')); ?>:</b>
	<?php echo CHtml::encode($data->UserID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ContractType')); ?>:</b>
	<?php echo CHtml::encode($data->ContractType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DeedID')); ?>:</b>
	<?php echo CHtml::encode($data->DeedID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SchemeID')); ?>:</b>
	<?php echo CHtml::encode($data->SchemeID); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('AmountEntered')); ?>:</b>
	<?php echo CHtml::encode($data->AmountEntered); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AmountCorrected')); ?>:</b>
	<?php echo CHtml::encode($data->AmountCorrected); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserIDcorrected')); ?>:</b>
	<?php echo CHtml::encode($data->UserIDcorrected); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserIDApproved')); ?>:</b>
	<?php echo CHtml::encode($data->UserIDApproved); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fee')); ?>:</b>
	<?php echo CHtml::encode($data->Fee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('InvoiceNo')); ?>:</b>
	<?php echo CHtml::encode($data->InvoiceNo); ?>
	<br />



</div>
