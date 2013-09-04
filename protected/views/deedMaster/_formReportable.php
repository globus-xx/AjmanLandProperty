

<div class="form">

<?php  $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reportable-reportable-form',
	'enableAjaxValidation'=>false
)); ?>

	<p class="note">الحقول المميزة بالعلامة  <span class="required">*</span> مطلوبة.</p>

	<?php  echo $form->errorSummary($model); ?>

	<div class="row">
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title'); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'reportable_type'); ?>
	</div>

	<?php $data = $model->attributes;  ?>
        
	<?php   $display = Reportable::model()->objectToArray(json_decode($data['display']));  ?>

	<h2>قم بتضمين الحقول في التقرير</h2>
	<p>قم بالتأكد من كل الحقول التي تريد تضمينها في هذا التقرير</p>
	<?php 		
	$models = array('DeedMaster', 'ContractsMaster','LandMaster',  'HajzMaster');    
?>
	<?php foreach($models as $vv):?>
		<b><?php echo $vv; ?> حقول</b>                    
                    <?php $attribs = $vv::model()->attributeLabels();?>
		<div class="row">
			<?php foreach($attribs as $ii=>$vx):?>
				<?php 
                                
                           if(isset($edit))
                           { 
                              
                           if(!is_null($display))
                             if(array_key_exists($vv,$display))
                                if(array_key_exists($ii,$display[$vv]))
                                {                                      
                                        echo CHtml::checkBox("Reportable[display][".$vv."][".$ii."]", $display[$vv][$ii] );
                                        echo $vx;
                                }
                           }
                           else
                           {
                             echo CHtml::checkBox("Reportable[display][".$vv."][".$ii."]", $display[$vv][$ii] );
                             echo $vx;                               
                                                               
//                             if(!is_null($display))
//                             if(array_key_exists($vv,$display))
//                                if(array_key_exists($ii,$display[$vv]))
//                                {                                 
//                                    
//                               
//                                }
//                                
                           }
                           ?>
			<?php endforeach;?>
		</div>

	<?php endforeach;?>


	<h2>  ما هي الحالات التي يجب ان يكون فيها التقرير معتمدا عليها</h2>
	<p>  تأكد و عدل كل حالات الحقول التي تريد تضمينها عند توليد التقرير</p>

	<?php 	
        $models = array('DeedMaster', 'ContractsMaster','LandMaster',  'HajzMaster');    
	$condition = Reportable::model()->objectToArray(json_decode($data['conditions'])); 

	foreach($models as $vv):
		// get the columns for the current models table
		$c = new $vv();
		$columns = $c->getTableSchema()->columns;
                      
		// loop through all the attributes for the ContractsMaster
		?>
		<b><?php echo $vv;?> حقول</b>
		<?php $attribs = $vv::model()->attributeLabels();?>
		<?php 
                
                 if(!isset($edit))
                           {                                          
                                echo $this->renderPartial('_reportableFields', array('attribs'=>$attribs, 'condition'=>$condition,
                                 'defaults'=>$defaults, 'model'=> $condition, 'the_model'=>$vv, 'columns'=>$columns));                                  
                           }
                else{ 
                        
                echo $this->renderPartial('_reportableFields', array('attribs'=>$attribs, 'condition'=>$condition,
		 'defaults'=>$defaults, 'model'=> $condition, 'the_model'=>$vv, 'columns'=>$columns,'edit'=>"yes"));  
                }                           
                endforeach;
	?>	
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->