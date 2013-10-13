<?php
$contracts = ContractsMaster::model()->findAll();

foreach($contracts as $contract)
{
    $countries= array(
        'a','b','c','d','e','f');
    $offices= array(
        'offic1','off2','fdf3','sfddsf','sdfsdfsd','sfdsdf');
    
    $a = rand(0,4);
    $contract->Nationality = $countries[$a];
    $contract->RealEstateOffice =$offices[$a];
    $contract->save();
//	$cs = new CDbCriteria;
//	$cs->condition = 'ContractID LIKE :id AND Type LIKE :type';
//	$cs->params = array(':id'=>$contract->ContractsID,':type'=>'buyer');
//	$buyers = ContractsDetail::model()->findAll($cs);
//	$contract->Nationality =  $buyers[0]->customer->Nationality;
//	
//	
//	$css = new CDbCriteria;
//	$css->condition ='ContractID LIKE :id AND TYPE LIKE :type';
//	$css->params = array(':id'=>$contract->ContractsID,':type'=>'waseet');
//	$reo = ContractsDetail::model()->findAll($css);
//	$contract->RealEstateOffice = $reo[0]->realestatename->realEstate->CommercialName;
//	$contract->save();
	
	}
        echo "Done";
?>