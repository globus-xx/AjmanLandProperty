<?php
/* @var $this LandSchemeController */
/* @var $data LandScheme */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('SchemeID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->SchemeID), array('view', 'id'=>$data->SchemeID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LandID')); ?>:</b>
	<?php echo CHtml::encode($data->LandID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SchemeDrawing')); ?>:</b>
	<?php echo CHtml::encode($data->SchemeDrawing); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MunicipalityID')); ?>:</b>
	<?php echo CHtml::encode($data->MunicipalityID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateInserted')); ?>:</b>
	<?php echo CHtml::encode($data->DateInserted); ?>
	<br />


</div>