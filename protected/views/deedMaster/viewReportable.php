<div class="form">
  <small> التقرير المولد للتقرير المحفوظ</small>
  <h1><?php echo $model->title; ?></h1>
  <?php
  
  $grph = array();
  if (isset($results['RESULTS'])):
    $results = $results['RESULTS'];

    $COUNT = 0;
    ?>
    <?php
    if (count($results) == 0):
      ?>
      <p>لا توجد نتائج</p>
      
          <table>

            <tr>
              <td dir="ltr" >
                0
              </td>
              <td>Count</td>
            </tr>
          </table>

          <?php
    else:

      $columns = array_keys($results[0]);
      ?>
      <table>
        <thead>
          <tr>
            <?php foreach ($columns as $column): ?>
              <th><?php echo $column; ?></th>
            <?php endforeach; ?>
          </tr>
        </thead>
        <?php foreach ($results as $row): ?>
          <tr>
            <?php foreach ($columns as $column): ?>
              <td><?php
                echo $row[$column];
                $COUNT++;
                ?></td>
          <?php endforeach; ?>
          </tr>

            <?php endforeach; ?>

        <tr>
          <td dir="ltr"  colspan="<?php echo count($columns) - 1; ?>">
    <?php echo $COUNT; ?>
          </td>
          <td>Count</td>
        </tr>
      </table>

    <?php
    endif;

  elseif (isset($results['GROUPED'])):
    $results = $results['GROUPED'];
    foreach ($results as $index => $rows):
      echo '<h2>' . $index . '</h2>';
      if (count($rows) == 0):
        ?>
        <p>لا توجد نتائج</p>
        <table>

            <tr>
              <td dir="ltr" >
                0
              </td>
              <td>Count</td>
            </tr>
          </table>

        <?php
      else:

        $columns = array_keys($rows[0]);
        if ($columns[0] == '0'):
          continue;
          
        endif;
        $columns_to_show = $columns;

        $COUNT = 0;
        ?>
        <table>
          <thead>
            <tr>
      <?php foreach ($columns_to_show as $column): ?>
                <th><?php echo $column; ?></th>
          <?php endforeach; ?>
            </tr>
          </thead>
          <?php
          foreach ($rows as $row):
            ?>
            <tr> 
              <?php foreach ($columns_to_show as $column): ?>
                <td><?php echo $row[$column]; ?></td>
                <?php
                $COUNT++;
              endforeach;
              ?>
            </tr>

              <?php endforeach; ?>
          
          <tr>
            <td dir="ltr"  colspan="<?php echo count($columns_to_show) - 1; ?>">
      <?php echo $COUNT; 
      $grph[$index] = $COUNT;
      
      ?>
            </td>
            <td>Count</td>
          </tr>
        </table>

      <?php
      endif;
    endforeach;
  endif;

//echo CHtml::link(CHtml::encode('Generate Report'), array('generateReportable', 'id'=>$model->id)); 
  ?>


<?php echo CHtml::link(CHtml::encode('EDIT'), array('editReportable', 'id' => $model->id)); ?>


</div><!-- form -->
<?php 

if(count($grph)>0):
$this->widget('application.extensions.rgraph.RGraphBar', array(
    'data' => array_values($grph),
    'options' => array(
        'chart' => array(
            'gutter' => array(
                'left' => 135,
            ),
            'labels' => array_keys($grph),

        )
    )
));
endif;
?>
  <?php return;?>
<div class="form">


	<small>  التقرير المولد الخاص بالتقرير المحفوظ</small>
	<h1><?php echo $model->title;?></h1>

	<?php 

	if (count($results)==0):
	?>
	<p>لا توجد نتائج</p>
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
      <tr>
        <td colspan="<?php echo count($columns); ?>">
          <?php echo $counter['Count']; ?>
        </td>
        <td>Count</td>
      </tr> 
	</table>

	<?php
	endif;


	 //echo CHtml::link(CHtml::encode('Generate Report'), array('generateReportable', 'id'=>$model->id)); ?>

	
	<?php echo CHtml::link(CHtml::encode('EDIT'), array('editReportable', 'id'=>$model->id)); ?>


</div><!-- form -->
