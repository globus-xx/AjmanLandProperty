<?php
/* @var $this DeedTrackerController */
/* @var $data DeedTracker */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TrackID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TrackID), array('view', 'id'=>$data->TrackID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DeedID')); ?>:</b>
	<?php echo CHtml::encode($data->DeedID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LandID')); ?>:</b>
	<?php echo CHtml::encode($data->LandID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserID')); ?>:</b>
	<?php echo CHtml::encode($data->UserID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateTime')); ?>:</b>
	<?php echo CHtml::encode($data->DateTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Status')); ?>:</b>
	<?php echo CHtml::encode($data->Status); ?>
	<br />


</div>
