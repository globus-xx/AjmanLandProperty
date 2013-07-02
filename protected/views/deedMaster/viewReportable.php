<div class="form">


	<small>Report Generated for Saved Report</small>
	<h1><?php echo $model->title;?></h1>

	<?php 

	if (count($results)==0):
	?>
	<p>No Results</p>
	<?php
	else:

		$columns = array_keys($results[0]);


	?>
	<table>
		<thead>
			<tr>
				<?php foreach($columns as $column): ?>
				<th><?php echo $column;?></th>
				<?php endforeach;?>
			</tr>
		</thead>
		<?php foreach($results as $row):?>
		<tr>
			<?php foreach($columns as $column): ?>
				<td><?php echo $row[$column];?></td>
			<?php endforeach;?>
		</tr>

		<?php endforeach;?>

	</table>

	<?php
	endif;


	 //echo CHtml::link(CHtml::encode('Generate Report'), array('generateReportable', 'id'=>$model->id)); ?>

	
	<?php echo CHtml::link(CHtml::encode('EDIT'), array('editReportable', 'id'=>$model->id)); ?>


</div><!-- form -->
