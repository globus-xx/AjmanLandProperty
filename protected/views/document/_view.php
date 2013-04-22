<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fileName')); ?>:</b>
	<?php echo CHtml::encode($data->fileName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mimeType')); ?>:</b>
	<?php echo CHtml::encode($data->mimeType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fileSize')); ?>:</b>
	<?php echo CHtml::encode($data->fileSize); ?>
	<br />


</div>