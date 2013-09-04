<?php
/* @var $this LandFinesController */
/* @var $data LandFines */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('LandFinesID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->LandFinesID), array('view', 'id'=>$data->LandFinesID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LandID')); ?>:</b>
	<?php echo CHtml::encode($data->LandID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FineType')); ?>:</b>
	<?php echo CHtml::encode($data->FineType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FineDescription')); ?>:</b>
	<?php echo CHtml::encode($data->FineDescription); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateInserted')); ?>:</b>
	<?php echo CHtml::encode($data->DateInserted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DocsCreated')); ?>:</b>
	<?php echo CHtml::encode($data->DocsCreated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Closed')); ?>:</b>
	<?php echo CHtml::encode($data->Closed); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('DateClosed')); ?>:</b>
	<?php echo CHtml::encode($data->DateClosed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserIDclosed')); ?>:</b>
	<?php echo CHtml::encode($data->UserIDclosed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DocsClosed')); ?>:</b>
	<?php echo CHtml::encode($data->DocsClosed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Remarks')); ?>:</b>
	<?php echo CHtml::encode($data->Remarks); ?>
	<br />

	*/ ?>

</div>