

<div class="form">

  <?php
  $form = $this->beginWidget('CActiveForm', array(
      'id' => 'reportable-reportable-form',
      'enableAjaxValidation' => false
  ));
  ?>

  <p class="note">الحقول المميزة بالعلامة  <span class="required">*</span> مطلوبة.</p>

<?php echo $form->errorSummary($model); ?>

  <div class="row">
  </div>

  <div class="row">
    <?php echo $form->labelEx($model, 'title'); ?>
<?php echo $form->textField($model, 'title'); ?>
<?php echo $form->error($model, 'title'); ?>
  </div>

  <div class="row">
  <?php echo $form->hiddenField($model, 'reportable_type'); ?>
  </div>

  <?php $data = $model->attributes; ?>

<?php $display = Reportable::model()->objectToArray(json_decode($data['display'])); ?>

  <h2>قم بتضمين الحقول في التقرير</h2>
  <p>قم بالتأكد من كل الحقول التي تريد تضمينها في هذا التقرير</p>
  <?php
  $models = array('DeedMaster', 'ContractsMaster', 'LandMaster', 'HajzMaster');
  
  
  $models = array('DeedMaster' => 'DeedMaster',
        'DeedDetails' => 'CustomerMaster',
        'LandMaster' => 'LandMaster');
  
      $condition = Reportable::model()->objectToArray(json_decode($data['conditions']));

  foreach ($models as $model_name):
        // get the columns for the current models table
        $c = new $model_name();
        $columns = $c->getTableSchema()->columns;
        // loop through all the attributes for the ContractsMaster
        ?>
        <b> <?php echo $model_name; ?> حقول</b>

        <?php $attribs = $model_name::model()->attributeLabels(); ?>
        <?php $attribs = $model_name::model()->getAllowedReportableFields();//reportableFields(); ?>
        <?php
        if (!isset($edit)) {
            echo $this->renderPartial('_reportableFields', array('attribs' => $attribs, 'condition' => $condition,
                'defaults' => $defaults, 'display'=>$display, 'model' => $condition, 'the_model' => $model_name, 'columns' => $columns));
        }else{
            echo $this->renderPartial('_reportableFields', array('attribs' => $attribs, 'condition' => $condition,
                'defaults' => $defaults, 'display'=>$display, 'model' => $condition, 'the_model' => $model_name, 'columns' => $columns, 'edit' => "yes"));
        }
    endforeach;
  ?>
    <div>
      <table width="auto">
        <tr>
          <td><b>Group By (Choose up to three)</b></td>
          <td>
            <?php
              $variables = array(0=>'None selected');
              foreach($models as $model_name){
                $attribs = $model_name::model()->reportableFields();
                foreach($attribs as $ii=>$vv):
                  $variables[$model_name.'.'.$ii] = $model_name.'.'.$ii; 
                endforeach;
                
              }
              for($i=0;$i<3;$i++):
                echo CHtml::dropDownList("Reportable[grouped][".$i."][value]", (isset($model['grouped'])?$model['grouped'][$i]:''), $variables, array('multiple' => false, 'style' => 'width:200px'));
                echo '<br/>';
              endfor;
            ?>
          </td>
        </tr>
      </table> 
    </div>
  
  <div class="row buttons">
  <?php echo CHtml::submitButton('Submit'); ?>
  </div>

  <?php $this->endWidget(); ?>

</div><!-- form -->