<table dir="ltr">
  <tr>
    <th>Display(Check to show in report)</th>
    <th>Field Name</th>
    <th>Conditions(Check to Apply Condition)</th>

  </tr>
  <?php
  foreach ($attribs as $ii => $vv):
    $index = $the_model . '.' . $ii;
    if(isset($columns[$ii]))
      $column = $columns[$ii];
    else
      $column = ' - ';
    
    if (isset($edit)) {


      //if (!is_null($model))
        //if (array_key_exists($index, $model)) 
        {
          ?>
          <tr class="row">
            <?php
              $displayed = false;
              if (!is_null($display))
                if (array_key_exists($the_model, $display))
                  if (array_key_exists($ii, $display[$the_model])) {
                    $displayed = true;
                  }
              echo '<td>' . CHtml::checkBox("Reportable[display][" . $the_model . "][" . $ii . "]", $displayed) . '</td>';                  
              echo '<td>' . $vv . '</td>';
              
              

            ?>
            <?php //echo CHtml::label($vv, "Reportable[conditions][" . $index . "][field]"); ?>
            <td>
              <?php
              echo CHtml::hiddenField("Reportable[conditions][" . $index . "][field]", $the_model . '.' . $ii);

              if (($the_model == 'ContractsDetail') && ($ii == 'Type')):
                echo CHtml::hiddenField("Reportable[conditions][" . $index . "][attrib]", 'IN');
                echo 'IN';
                echo CHtml::dropDownList("Reportable[conditions][" . $index . "][value]", (isset($model[$index])?$model[$index]['value']:''), $defaults['ContractTypes'], array('multiple' => true, 'style' => 'width:200px'));
              elseif (($the_model == 'CustomerMaster') && ($ii == 'Nationality')):                  
                echo CHtml::hiddenField("Reportable[conditions][" . $index . "][attrib]", 'IN');
                echo 'IN';
                echo CHtml::dropDownList("Reportable[conditions][" . $index . "][value][]", (isset($model[$index])?$model[$index]['value']:''), $defaults['CustomerNationalities'], array('multiple' => true, 'style' => 'width:200px'));
              else:

                switch ($column->type):
                  case 'integer':
                    echo CHtml::dropDownList("Reportable[conditions][" . $index . "][attrib]", (isset($model[$index])?$model[$index]['attrib']:''), array('lt' => 'Less Than', 'gt' => 'Greater Than', 'eq' => 'Equals'));
                    echo CHtml::textField("Reportable[conditions][" . $index . "][value]", (isset($model[$index])?$model[$index]['value']:'') );

                    //echo CHtml::checkBox("Reportable[conditions][" . $index . "][show_sum]", $model[$index]['show_value']);
                    //echo 'Show Sum at End';
                    break;
                  case 'date':
                  case 'datetime':
                    echo CHtml::hiddenField("Reportable[conditions][" . $index . "][attrib]", 'BETWEEN');
                    echo 'BETWEEN';
                    $result = isset($model[$index])?$model[$index]['value']:'';                    
                    echo CHtml::textField("Reportable[conditions][" . $index . "][value]", $result , array('class' => 'datebox'));
                    break;
                  case 'string':
                  default:
                    if (strstr(strtolower($index), 'date')):
                      echo CHtml::hiddenField("Reportable[conditions][" . $index . "][attrib]", 'BETWEEN');
                      echo 'BETWEEN';
                      $result = isset($model[$index])?$model[$index]['value']:'';                   
                      echo CHtml::textField("Reportable[conditions][" . $index . "][value]", $result , array('class' => 'datebox'));
                    else:
                      echo CHtml::hiddenField("Reportable[conditions][" . $index . "][attrib]", 'IN');
                      echo 'IN/EQUAL TO';
                      echo CHtml::textField("Reportable[conditions][" . $index . "][value]", (isset($model[$index])?$model[$index]['value']:''));
                    endif;
                    ?> 
                    <?php
                    break;
                endswitch;
              endif;

              echo CHtml::checkBox("Reportable[conditions][" . $index . "][enabled]", (isset($model[$index])?$model[$index]['enabled']:'') );
              ?> </td>
          </tr>

          <?php
        }
    }

    else {
//                      if(!is_null($model)){
      ?>
      <tr class="row">
        <?php
        /*if (isset($edit)) {
          if (!is_null($display))
            if (array_key_exists($vv, $display))
              if (array_key_exists($ii, $display[$vv])) {
                echo '<td>' . CHtml::checkBox("Reportable[display][" . $the_model . "][" . $ii . "]", $display[$the_model][$ii]) . '</td>';
                echo '<td>' . $vv . '</td>';
              }
        } else*/ {

          echo '<td>' . CHtml::checkBox("Reportable[display][" . $the_model . "][" . $ii . "]", $display[$the_model][$ii]) . '</td>';
          echo '<td>' . $vv . '</td>';
        }
        ?>
        <?php // echo CHtml::label($vv, "Reportable[conditions][" . $index . "][field]"); ?>
        <td>
          <?php
          echo CHtml::hiddenField("Reportable[conditions][" . $index . "][field]", $the_model . '.' . $ii);

          if (($the_model == 'ContractsDetail') && ($ii == 'Type')):
            echo CHtml::hiddenField("Reportable[conditions][" . $index . "][attrib]", 'IN');
            echo 'IN';
            echo CHtml::dropDownList("Reportable[conditions][" . $index . "][value]", $model[$index]['value'], $defaults['ContractTypes'], array('multiple' => true, 'style' => 'width:200px'));
          elseif (($the_model == 'CustomerMaster') && ($ii == 'Nationality')):
            echo CHtml::hiddenField("Reportable[conditions][" . $index . "][attrib]", 'IN');
            echo 'IN';
            echo CHtml::dropDownList("Reportable[conditions][" . $index . "][value][]", $model[$index]['value'], $defaults['CustomerNationalities'], array('multiple' => true, 'style' => 'width:200px'));
          else:
            switch ($column->type):
              case 'integer':
                echo CHtml::dropDownList("Reportable[conditions][" . $index . "][attrib]", $model[$index]['attrib'], array('lt' => 'Less Than', 'gt' => 'Greater Than', 'eq' => 'Equals'));
                echo CHtml::textField("Reportable[conditions][" . $index . "][value]", $model[$index]['value']);

                echo CHtml::checkBox("Reportable[conditions][" . $index . "][show_sum]", $model[$index]['show_value']);
                echo 'Show Sum at End';
                break;
              case 'date':
              case 'datetime':
                echo CHtml::dropDownList("Reportable[conditions][" . $index . "][attrib]", 'BETWEEN');
                echo 'BETWEEN';
                echo CHtml::textField("Reportable[conditions][" . $index . "][value]", $model[$index]['value'], array('class' => 'datebox'));
                break;
              case 'string':
              default:
                if (strstr(strtolower($index), 'date')):
                  echo CHtml::hiddenField("Reportable[conditions][" . $index . "][attrib]", 'BETWEEN');
                  echo 'BETWEEN';
                  echo CHtml::textField("Reportable[conditions][" . $index . "][value]", $model[$index]['value'], array('class' => 'datebox'));
                else:
                  echo CHtml::hiddenField("Reportable[conditions][" . $index . "][attrib]", 'IN');
                  echo 'IN/EQUAL TO';
                  echo CHtml::textField("Reportable[conditions][" . $index . "][value]", $model[$index]['value']);
                endif;
                ?> 
                <?php
                break;
            endswitch;
          endif;

          echo CHtml::checkBox("Reportable[conditions][" . $index . "][enabled]", $model[$index]['enabled']);
          ?> </td>
      </tr>

      <?php
//                      }
    }


  endforeach;
  ?>
</table>


