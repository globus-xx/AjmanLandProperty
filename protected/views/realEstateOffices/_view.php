<?php
/* @var $this RealEstateOfficesController */
/* @var $data RealEstateOffices */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('RealEstateID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->RealEstateID), array('view', 'id'=>$data->RealEstateID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CommercialName')); ?>:</b>
	<?php echo CHtml::encode($data->CommercialName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OwnerName')); ?>:</b>
	<?php echo CHtml::encode($data->OwnerName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RegisteredDate')); ?>:</b>
	<?php echo CHtml::encode($data->RegisteredDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ExpiryDate')); ?>:</b>
	<?php echo CHtml::encode($data->ExpiryDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Address')); ?>:</b>
	<?php echo CHtml::encode($data->Address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MobilePhone')); ?>:</b>
	<?php echo CHtml::encode($data->MobilePhone); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Email')); ?>:</b>
	<?php echo CHtml::encode($data->Email); ?>
	<br />

	*/ ?>

</div>