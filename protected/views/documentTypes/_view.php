<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createdAt')); ?>:</b>
	<?php echo CHtml::encode($data->createdAt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updatedAt')); ?>:</b>
	<?php echo CHtml::encode($data->updatedAt); ?>
	<br />


</div>