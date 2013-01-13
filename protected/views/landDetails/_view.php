<?php
/* @var $this LandDetailsController */
/* @var $data LandDetails */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('LandDetailID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->LandDetailID), array('view', 'id'=>$data->LandDetailID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LandID')); ?>:</b>
	<?php echo CHtml::encode($data->LandID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Direction')); ?>:</b>
	<?php echo CHtml::encode($data->Direction); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Dimension')); ?>:</b>
	<?php echo CHtml::encode($data->Dimension); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Description')); ?>:</b>
	<?php echo CHtml::encode($data->Description); ?>
	<br />


</div>