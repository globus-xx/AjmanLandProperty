<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('userID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->userID), array('view', 'id'=>$data->userID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Password')); ?>:</b>
	<?php echo CHtml::encode($data->Password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EmployeeID')); ?>:</b>
	<?php echo CHtml::encode($data->EmployeeID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ManagerID')); ?>:</b>
	<?php echo CHtml::encode($data->ManagerID); ?>
	<br />


</div>