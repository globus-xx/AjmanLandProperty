<?php
/* @var $this InvoicesController */
/* @var $data Invoices */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('InvoiceNo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->InvoiceNo), array('view', 'id'=>$data->InvoiceNo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('InvoiceDateTime')); ?>:</b>
	<?php echo CHtml::encode($data->InvoiceDateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserID')); ?>:</b>
	<?php echo CHtml::encode($data->UserID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Product')); ?>:</b>
	<?php echo CHtml::encode($data->Product); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TransactionID')); ?>:</b>
	<?php echo CHtml::encode($data->TransactionID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Amount')); ?>:</b>
	<?php echo CHtml::encode($data->Amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CustomerID')); ?>:</b>
	<?php echo CHtml::encode($data->CustomerID); ?>
	<br />


</div>