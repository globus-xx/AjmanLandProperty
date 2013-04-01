<?php
/* @var $this HajzMasterController */
/* @var $data HajzMaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('HajzID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->HajzID), array('view', 'id'=>$data->HajzID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LandID')); ?>:</b>
	<?php echo CHtml::encode($data->LandID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DeedID')); ?>:</b>
	<?php echo CHtml::encode($data->DeedID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SchemeID')); ?>:</b>
	<?php echo CHtml::encode($data->SchemeID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Type')); ?>:</b>
	<?php echo CHtml::encode($data->Type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TypeDetail')); ?>:</b>
	<?php echo CHtml::encode($data->TypeDetail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DocsCreated')); ?>:</b>
	<?php echo CHtml::encode($data->DocsCreated); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('UserIDcreated')); ?>:</b>
	<?php echo CHtml::encode($data->UserIDcreated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateCreated')); ?>:</b>
	<?php echo CHtml::encode($data->DateCreated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AmountMortgaged')); ?>:</b>
	<?php echo CHtml::encode($data->AmountMortgaged); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PeriodofTime')); ?>:</b>
	<?php echo CHtml::encode($data->PeriodofTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserIDended')); ?>:</b>
	<?php echo CHtml::encode($data->UserIDended); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateEnded')); ?>:</b>
	<?php echo CHtml::encode($data->DateEnded); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DocsEnded')); ?>:</b>
	<?php echo CHtml::encode($data->DocsEnded); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IsActive')); ?>:</b>
	<?php echo CHtml::encode($data->IsActive); ?>
	<br />

	*/ ?>

</div>