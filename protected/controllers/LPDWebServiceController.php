<?php

class LPDWebServiceController extends Controller
{
    
       
        
	public function actionIndex()
	{                        
             $ky = '!GIS_LaPD@2013!&&!GIS_LaPD@2013!'; // 32 * 8 = 256 bit key
             $iv = '!LaPD_GIS@2013!&&!LaPD_GIS@2013!'; // 32 * 8 = 256 bit iv
        
           
                                       
            $codetodecrypt=$_GET['token'];
            $resultstring = $this->decryptRJ256($ky,$iv,$codetodecrypt);  
            
            
            $resultstring = explode("|",$resultstring);                                                
            $landid=$resultstring[2];
             
                                                    
             // 1- retured data is land details + CURRENT OWNERS
             // 2- retured data is land details + FINES                     
             // 3- shares data is  land details + SHARES
             
             $retureddata=1;
             
             
             // for fast test uncomment the following two lines  and uncommit all the previous files
             // $landid="your working land id";
             // $retureddata=1;
            
             
             $this->renderPartial('getdata', array(
				'landid'=>$landid,'returneddata'=>$retureddata
				));                              
}


       public  function decryptRJ256($key,$iv,$string_to_decrypt)
        {
        $string_to_decrypt = base64_decode($string_to_decrypt);
        $rtn = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $string_to_decrypt, MCRYPT_MODE_CBC, $iv);
        $rtn = rtrim($rtn, "\0\4");
        return($rtn);
        }


       public function encryptRJ256($key,$iv,$string_to_encrypt)
        {
        $rtn = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $string_to_encrypt, MCRYPT_MODE_CBC, $iv);
        $rtn = base64_encode($rtn);
        return($rtn);
        }
        
        
        
        
        // Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}