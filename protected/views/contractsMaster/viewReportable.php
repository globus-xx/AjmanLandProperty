<div class="form">


  <small> التقرير المولد للتقرير المحفوظ</small>
  <h1><?php echo $model->title; ?></h1>

  <?php
  if (count($results) == 0):
    ?>
    <p>لا توجد نتائج</p>
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
            <td><?php echo $row[$column]; ?></td>
          <?php endforeach; ?>
        </tr>

      <?php endforeach; ?>
      <tr>
        <td dir="ltr" colspan="<?php echo count($columns)-1; ?>">
          <?php echo $counter['AmountCorrected']; ?>
        </td>
        <td>Amount Corrected</td>
      </tr>
      <tr>
        <td dir="ltr"  colspan="<?php echo count($columns)-1; ?>">
          <?php echo $counter['Fee']; ?>
        </td>
        <td>Fee</td>
      </tr>
      <tr>
        <td dir="ltr"  colspan="<?php echo count($columns)-1; ?>">
          <?php echo $counter['Count']; ?>
        </td>
        <td>Count</td>
      </tr>
    </table>

  <?php
  endif;


//echo CHtml::link(CHtml::encode('Generate Report'), array('generateReportable', 'id'=>$model->id)); 
  ?>


  <?php echo CHtml::link(CHtml::encode('EDIT'), array('editReportable', 'id' => $model->id)); ?>


</div><!-- form -->
