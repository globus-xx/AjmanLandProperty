<?php
/* @var $this ExportedlettersController */
/* @var $data Exportedletters */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ExportedletterID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ExportedletterID), array('view', 'id'=>$data->ExportedletterID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Exportedlettertext')); ?>:</b>
	<?php echo CHtml::encode($data->Exportedlettertext); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserName')); ?>:</b>
	<?php echo CHtml::encode($data->UserName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ExportedDate')); ?>:</b>
	<?php echo CHtml::encode($data->ExportedDate); ?>
	<br />


</div>