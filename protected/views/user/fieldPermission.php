<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="form">

  <?php
  $form = $this->beginWidget('CActiveForm', array(
      'id' => 'reportable-reportable-form',
      'enableAjaxValidation' => false
  ));
  ?>

  <p class="note">Select which fields are accessible for reports generation by non-admin users.</p>

  <?php echo $form->errorSummary($model); ?>

  <?php
  $models = array('DeedMaster' => 'DeedMaster',
      'CustomerMaster' => 'CustomerMaster',
      'ContractMaster' => 'ContractsMaster',
      'RealEstatePeople' => 'RealEstatePeople',
      'LandMaster' => 'LandMaster',
      'CustomerMaster' => 'CustomerMaster',
      'Real Estate' => 'RealEstateOffices');
  
  foreach($models as $model_name=>$model_class):
    echo '<h3>'.$model_name.'</h3>';
    ?>
      <div class="row">
        <?php 
        $m = new $$model_class();
        $fields = $m->reportableFields();
        foreach($fields as $index=>$value):
          $ii = $model_name.'.'.$index;
          $displayed = $model['value'][$ii];
          echo CHtml::checkBox("Option[value][".$ii."]", $displayed);
          
          echo $value; 
          
        endforeach;?>
      </div>
    <?php
  endforeach;
  ?>
</div>