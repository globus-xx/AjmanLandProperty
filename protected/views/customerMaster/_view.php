<?php
/* @var $this CustomerMasterController */
/* @var $data CustomerMaster */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CustomerID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CustomerID), array('view', 'id'=>$data->CustomerID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CustomerNameArabic')); ?>:</b>
	<?php echo CHtml::encode($data->CustomerNameArabic); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CustomerNameEnglish')); ?>:</b>
	<?php echo CHtml::encode($data->CustomerNameEnglish); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HomeAddress')); ?>:</b>
	<?php echo CHtml::encode($data->HomeAddress); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HomePhone')); ?>:</b>
	<?php echo CHtml::encode($data->HomePhone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MobilePhone')); ?>:</b>
	<?php echo CHtml::encode($data->MobilePhone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateofBirth')); ?>:</b>
	<?php echo CHtml::encode($data->DateofBirth); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Nationality')); ?>:</b>
	<?php echo CHtml::encode($data->Nationality); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Signature')); ?>:</b>
	<?php echo CHtml::encode($data->Signature); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DocumentType')); ?>:</b>
	<?php echo CHtml::encode($data->DocumentType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DocumentNumber')); ?>:</b>
	<?php echo CHtml::encode($data->DocumentNumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IssuedOn')); ?>:</b>
	<?php echo CHtml::encode($data->IssuedOn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ExpiresOn')); ?>:</b>
	<?php echo CHtml::encode($data->ExpiresOn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EmailAddress')); ?>:</b>
	<?php echo CHtml::encode($data->EmailAddress); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Document')); ?>:</b>
	<?php echo CHtml::encode($data->Document); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Photo')); ?>:</b>
	<?php echo CHtml::encode($data->Photo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CustomerType')); ?>:</b>
	<?php echo CHtml::encode($data->CustomerType); ?>
	<br />

	*/ ?>

</div>