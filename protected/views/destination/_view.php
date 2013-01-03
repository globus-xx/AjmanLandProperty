<?php
/* @var $this DestinationController */
/* @var $data Destination */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('DestinationID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->DestinationID), array('view', 'id'=>$data->DestinationID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DestinationName')); ?>:</b>
	<?php echo CHtml::encode($data->DestinationName); ?>
	<br />


</div>