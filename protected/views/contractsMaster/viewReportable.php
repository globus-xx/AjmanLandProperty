<div class="form">
  <small> التقرير المولد للتقرير المحفوظ</small>
  <h1><?php echo $model->title; ?></h1>
  <?php
  if (isset($results['RESULTS'])):
    $results = $results['RESULTS'];

    $AC = 0;
    $COUNT = 0;
    $FF = 0;
    ?>
    <?php
    if (count($results) == 0):
      ?>
      <p>لا توجد نتائج</p>
      
          <table>
            <tr>
              <td dir="ltr"  >
                0
              </td>
              <td>Amount Corrected</td>
            </tr>
            <tr>
              <td dir="ltr" >
                0
              </td>
              <td>Fee</td>
            </tr>
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
                $AC+= $row['AC'];
                $FF+= $row['FF'];
                $COUNT++;
                ?></td>
          <?php endforeach; ?>
          </tr>

            <?php endforeach; ?>
        <tr>
          <td dir="ltr" colspan="<?php echo count($columns) - 1; ?>">
    <?php echo $AC; ?>
          </td>
          <td>Amount Corrected</td>
        </tr>
        <tr>
          <td dir="ltr"  colspan="<?php echo count($columns) - 1; ?>">
    <?php echo $FF; ?>
          </td>
          <td>Fee</td>
        </tr>
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
      $indx = explode(' IS ', $index);
      echo '<p></p><table dir="rtl " align="right" style=" width:30%" border="1"><tr><td style="text-align:right"><b><i>' . $indx[0] .'</i><b></td><td><i>'.$indx[1] . '</i></td></tr></table><p></p>';
      if (count($rows) == 0):
        ?>
        <p>لا توجد نتائج</p>
        <table>
            <tr>
              <td dir="ltr" >
                0
              </td>
              <td>Amount Corrected</td>
            </tr>
            <tr>
              <td dir="ltr" >
                0
              </td>
              <td>Fee</td>
            </tr>
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
        unset($columns_to_show['FF']);
        unset($columns_to_show['AC']);

        $AC = 0;
        $COUNT = 0;
        $FF = 0;
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
                $AC+= $row['AC'];
                $FF+= $row['FF'];
                $COUNT++;
              endforeach;
              ?>
            </tr>

              <?php endforeach; ?>
          <tr>
            <td dir="ltr" colspan="<?php echo count($columns_to_show) - 1; ?>">
      <?php echo $AC; ?>
            </td>
            <td>Amount Corrected</td>
          </tr>
          <tr>
            <td dir="ltr"  colspan="<?php echo count($columns_to_show) - 1; ?>">
      <?php echo $FF; ?>
            </td>
            <td>Fee</td>
          </tr>
          <tr>
            <td dir="ltr"  colspan="<?php echo count($columns_to_show) - 1; ?>">
      <?php echo $COUNT; ?>
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
