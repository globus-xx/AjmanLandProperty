<?php

class LPDWebServiceController extends CController
{
    
    
    public function filters()
    {
        return array( 'accessControl' ); // perform access control for CRUD operations
    }
  
    
    
     public function accessRules() {
        return array(
            array('allow',
                'actions' => array('Index'),
                'ips' => array('127.0.0.1'),// here we should put the ip of the other miniplicity
            ),
            array('deny',
                'actions' => array('Index'),
                'ips' => array('*'),
            ),
        );
    }
    
   
    
    
    
    
	public function actionIndex()
	{                        
             $ky = '!GIS_LaPD@2013!&&!GIS_LaPD@2013!'; // 32 * 8 = 256 bit key
             $iv = '!LaPD_GIS@2013!&&!LaPD_GIS@2013!'; // 32 * 8 = 256 bit iv

             
                //        
                //           
                //                                       
                ////            $codetodecrypt=$_GET['token'];
                ////            $resultstring = $this->decryptRJ256($ky,$iv,$codetodecrypt);  
                ////            
                ////            
                ////            $resultstring = explode("|",$resultstring);                                                
                ////            $landid=$resultstring[2];
                //             
                //                                                    
                //             // 1- retured data is land details + CURRENT OWNERS
                //             // 2- retured data is land details + FINES                     
                //             // 3- shares data is  land details + SHARES
                //             

            

          // change the last part with a valid land id
           $codetodecrypt="omar|".date("Y")."|112233";
           $encryptcode=$this->encryptRJ256($ky,$iv,$codetodecrypt);  
             
         //  print $encryptcode;
            $this->renderPartial('demoform', array(
				'landid'=>$encryptcode,'returneddata'=>$retureddata
				));      

           }



public function actionTest()
	{                        
             $ky = '!GIS_LaPD@2013!&&!GIS_LaPD@2013!'; // 32 * 8 = 256 bit key
             $iv = '!LaPD_GIS@2013!&&!LaPD_GIS@2013!'; // 32 * 8 = 256 bit iv

             
                //        
                //           
                //                                       
                ////            $codetodecrypt=$_GET['token'];
                ////            $resultstring = $this->decryptRJ256($ky,$iv,$codetodecrypt);  
                ////            
                ////            
                ////            $resultstring = explode("|",$resultstring);                                                
                ////            $landid=$resultstring[2];
                //             
                //                                                    
                //             // 1- retured data is land details + CURRENT OWNERS
                //             // 2- retured data is land details + FINES                     
                //             // 3- shares data is  land details + SHARES
                //             

            

          // change the last part with a valid land id
           $codetodecrypt="omar|".date("Y")."|ف/269/11";
           $encryptcode=$this->encryptRJ256($ky,$iv,$codetodecrypt);  
             
         //  print $encryptcode;
            $this->renderPartial('demoform', array(
				'landid'=>$encryptcode,'returneddata'=>$retureddata
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
        
        
        
                                                               
        
}