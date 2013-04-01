<?php
/* @var $this RealEstatePeopleController */
/* @var $data RealEstatePeople */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CardID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CardID), array('view', 'id'=>$data->CardID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CardNo')); ?>:</b>
	<?php echo CHtml::encode($data->CardNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Nationality')); ?>:</b>
	<?php echo CHtml::encode($data->Nationality); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Role')); ?>:</b>
	<?php echo CHtml::encode($data->Role); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IssueDate')); ?>:</b>
	<?php echo CHtml::encode($data->IssueDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EndDate')); ?>:</b>
	<?php echo CHtml::encode($data->EndDate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('EntryDate')); ?>:</b>
	<?php echo CHtml::encode($data->EntryDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RealEstateID')); ?>:</b>
	<?php echo CHtml::encode($data->RealEstateID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CardEndDate')); ?>:</b>
	<?php echo CHtml::encode($data->CardEndDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserID')); ?>:</b>
	<?php echo CHtml::encode($data->UserID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OperationType')); ?>:</b>
	<?php echo CHtml::encode($data->OperationType); ?>
	<br />

	*/ ?>

</div>