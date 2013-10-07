<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
	<b>
	<?php 
  if ($data->reportable_type == 'ContractsMaster'):
    echo CHtml::link(CHtml::encode($data->title), array('/ContractsMaster/viewReportable', 'id'=>$data->id)); 
  else:
    echo CHtml::link(CHtml::encode($data->title), array('/DeedMaster/viewReportable', 'id'=>$data->id)); 
  endif;
  ?></b>
	<br />
