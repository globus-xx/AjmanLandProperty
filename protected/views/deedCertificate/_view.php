<?php
/* @var $this DeedCertificateController */
/* @var $data DeedCertificate */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sha1')); ?>:</b>
	<?php echo CHtml::encode($data->sha1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LandID')); ?>:</b>
	<?php echo CHtml::encode($data->LandID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DeedID')); ?>:</b>
	<?php echo CHtml::encode($data->DeedID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ContractsID')); ?>:</b>
	<?php echo CHtml::encode($data->ContractsID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserID')); ?>:</b>
	<?php echo CHtml::encode($data->UserID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateTime')); ?>:</b>
	<?php echo CHtml::encode($data->DateTime); ?>
	<br />


</div>