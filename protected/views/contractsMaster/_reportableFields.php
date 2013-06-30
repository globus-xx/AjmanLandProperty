<?php foreach($attribs as $ii=>$vv):
			$index = microtime();

			$column = $columns[$ii];?>
			<div class="row">

			<?php echo CHtml::label($vv, "Reportable[conditions][".$index."][field]");?>
			<?php echo CHtml::hiddenField("Reportable[conditions][".$index."][field]", $model.'.'.$ii);

			if(($model == 'ContractsDetail') && ($ii=='Type')):
				echo CHtml::hiddenField("Reportable[conditions][".$index."][attrib]", 'IN');
				echo 'IN';
				echo CHtml::dropDownList("Reportable[conditions][".$index."][value]", '', $defaults['ContractTypes'], 
																		array('multiple'=>true, 'style'=> 'width:200px'));
			elseif(($model == 'CustomerMaster') && ($ii=='Nationality')):
				echo CHtml::hiddenField("Reportable[conditions][".$index."][attrib]", 'IN');
				echo 'IN';
				echo CHtml::dropDownList("Reportable[conditions][1][value]", '', $defaults['CustomerNationalities'], 
																		array('multiple'=>true, 'style'=> 'width:200px'));
			else:
				switch($column->type):
					case 'integer':
						echo CHtml::dropDownList("Reportable[conditions][".$index."][attrib]", '', array('lt'=>'Less Than', 'gt'=>'Greater Than', 'eq'=>'Equals'));
						echo CHtml::textField("Reportable[conditions][".$index."][value]", '');
					break;
					case 'date':
					case 'datetime':
						echo CHtml::dropDownList("Reportable[conditions][".$index."][attrib]", '', array('before'=>'Before', 'after'=>'After', 'on'=>'On'));
						echo CHtml::textField("Reportable[conditions][".$index."][value]", '', array('class'=>'datebox'));
					break;
					case 'string':
					default:
						echo CHtml::hiddenField("Reportable[conditions][".$index."][attrib]", 'IN');
						echo 'IN/EQUAL TO';
						echo CHtml::textField("Reportable[conditions][".$index."][value]", '');
						echo CHtml::checkBox("Reportable[conditions][".$index."][show_sum]");?> Show Sum at End
						<?php
					break;
				endswitch;
			endif;

			echo CHtml::checkBox("Reportable[conditions][".$index."][enabled]");?> Enable
		</div>
	<?php endforeach;?>