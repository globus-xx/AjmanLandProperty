<?php 
foreach($attribs as $ii=>$vv):
			$index = $the_model.'.'.$ii;
			$column = $columns[$ii];
                   
                   if(isset($edit))
                   {
                       
                       if(!is_null($model))
                           
                        if(array_key_exists($index,$model))
                        {
                           
                        
                        ?>
			<div class="row">

			<?php echo CHtml::label($vv, "Reportable[conditions][".$index."][field]");?>
			<?php echo CHtml::hiddenField("Reportable[conditions][".$index."][field]", $the_model.'.'.$ii);

			if(($the_model == 'ContractsDetail') && ($ii=='Type')):
				echo CHtml::hiddenField("Reportable[conditions][".$index."][attrib]", 'IN');
				echo 'IN';
				echo CHtml::dropDownList("Reportable[conditions][".$index."][value]", $model[$index]['value'], $defaults['ContractTypes'], 
																		array('multiple'=>true, 'style'=> 'width:200px'));
			elseif(($the_model == 'CustomerMaster') && ($ii=='Nationality')):
				echo CHtml::hiddenField("Reportable[conditions][".$index."][attrib]", 'IN');
				echo 'IN';
				echo CHtml::dropDownList("Reportable[conditions][".$index."][value]", $model[$index]['value'], $defaults['CustomerNationalities'], 
																		array('multiple'=>true, 'style'=> 'width:200px'));
			else:
				switch($column->type):
					case 'integer':
						echo CHtml::dropDownList("Reportable[conditions][".$index."][attrib]", $model[$index]['attrib'], array('lt'=>'Less Than', 'gt'=>'Greater Than', 'eq'=>'Equals'));
						echo CHtml::textField("Reportable[conditions][".$index."][value]", $model[$index]['value']);

						echo CHtml::checkBox("Reportable[conditions][".$index."][show_sum]",$model[$index]['show_value']);echo 'Show Sum at End';						
					break;
					case 'date':
					case 'datetime':
						echo CHtml::dropDownList("Reportable[conditions][".$index."][attrib]", $model[$index]['attrib'], array('before'=>'Before', 'after'=>'After', 'on'=>'On'));
						echo CHtml::textField("Reportable[conditions][".$index."][value]", $model[$index]['value'], array('class'=>'datebox'));
					break;
					case 'string':
					default:
						echo CHtml::hiddenField("Reportable[conditions][".$index."][attrib]", 'IN');
						echo 'IN/EQUAL TO';
						echo CHtml::textField("Reportable[conditions][".$index."][value]", $model[$index]['value']);?> 
 													<?php
					break;
				endswitch;
			endif;

			echo CHtml::checkBox("Reportable[conditions][".$index."][enabled]", $model[$index]['enabled']);?> Enable
		</div>

                   <?php }}
                   
                   else
                   {
//                      if(!is_null($model)){
                       ?>
			<div class="row">

			<?php echo CHtml::label($vv, "Reportable[conditions][".$index."][field]");?>
			<?php echo CHtml::hiddenField("Reportable[conditions][".$index."][field]", $the_model.'.'.$ii);

			if(($the_model == 'ContractsDetail') && ($ii=='Type')):
				echo CHtml::hiddenField("Reportable[conditions][".$index."][attrib]", 'IN');
				echo 'IN';
				echo CHtml::dropDownList("Reportable[conditions][".$index."][value]", $model[$index]['value'], $defaults['ContractTypes'], 
																		array('multiple'=>true, 'style'=> 'width:200px'));
			elseif(($the_model == 'CustomerMaster') && ($ii=='Nationality')):
				echo CHtml::hiddenField("Reportable[conditions][".$index."][attrib]", 'IN');
				echo 'IN';
				echo CHtml::dropDownList("Reportable[conditions][".$index."][value]", $model[$index]['value'], $defaults['CustomerNationalities'], 
																		array('multiple'=>true, 'style'=> 'width:200px'));
			else:
				switch($column->type):
					case 'integer':
						echo CHtml::dropDownList("Reportable[conditions][".$index."][attrib]", $model[$index]['attrib'], array('lt'=>'Less Than', 'gt'=>'Greater Than', 'eq'=>'Equals'));
						echo CHtml::textField("Reportable[conditions][".$index."][value]", $model[$index]['value']);

						echo CHtml::checkBox("Reportable[conditions][".$index."][show_sum]",$model[$index]['show_value']);echo 'Show Sum at End';						
					break;
					case 'date':
					case 'datetime':
						echo CHtml::dropDownList("Reportable[conditions][".$index."][attrib]", $model[$index]['attrib'], array('before'=>'Before', 'after'=>'After', 'on'=>'On'));
						echo CHtml::textField("Reportable[conditions][".$index."][value]", $model[$index]['value'], array('class'=>'datebox'));
					break;
					case 'string':
					default:
						echo CHtml::hiddenField("Reportable[conditions][".$index."][attrib]", 'IN');
						echo 'IN/EQUAL TO';
						echo CHtml::textField("Reportable[conditions][".$index."][value]", $model[$index]['value']);?> 
 													<?php
					break;
				endswitch;
			endif;

			echo CHtml::checkBox("Reportable[conditions][".$index."][enabled]", $model[$index]['enabled']);?> Enable
		</div>

                   <?php
//                      }
                   }
                   
                   
                   endforeach;?>