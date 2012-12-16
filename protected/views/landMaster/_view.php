<?php
/* @var $this LandMasterController */
/* @var $data LandMaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('LandID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->LandID), array('view', 'id'=>$data->LandID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LocationID')); ?>:</b>
	<?php echo CHtml::encode($data->LocationID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Plot_No')); ?>:</b>
	<?php echo CHtml::encode($data->Plot_No); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Piece')); ?>:</b>
	<?php echo CHtml::encode($data->Plot_No); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('location')); ?>:</b>
	<?php echo CHtml::encode($data->location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Land_Type')); ?>:</b>
	<?php echo CHtml::encode($data->Land_Type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TotalArea')); ?>:</b>
	<?php echo CHtml::encode($data->TotalArea); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('length')); ?>:</b>
	<?php echo CHtml::encode($data->length); ?>
	<br />

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('width')); ?>:</b>
	<?php echo CHtml::encode($data->width); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AreaUnit')); ?>:</b>
	<?php echo CHtml::encode($data->AreaUnit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Remarks')); ?>:</b>
	<?php echo CHtml::encode($data->Remarks); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('North')); ?>:</b>
	<?php echo CHtml::encode($data->North); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('South')); ?>:</b>
	<?php echo CHtml::encode($data->South); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('East')); ?>:</b>
	<?php echo CHtml::encode($data->East); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('West')); ?>:</b>
	<?php echo CHtml::encode($data->West); ?>
	<br />

	

</div>
