

<?php

class CustomerServiceController extends Controller
{
    
    
    public $sAction;
    public $sString;
    public $returnType;
    public $retured;
    
                              
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
        
    
    public function filters()
    {
        return array( 'accessControl' ); // perform access control for CRUD operations
    }
    
    
        public function accessRules() {
        return array(
            array('allow',
                'actions' => array('ws'),
                'ips' => array('::1'),// here we should put the ip of the other miniplicity
            ),
            array('deny',
                'actions' => array('ws'),
                'ips' => array('*'),
            ),
                        
            
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','Search','CustomerSearch'),
				'users'=>array('@'),
			),
                        
                       array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('Search'),
				'ips'=>array('127.0.0.1'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
        );
    }
        

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionIndex()
	{

                 $criteria = new CDbCriteria;            		
                $items = Letters::model()->findAll($criteria);
            
                $this->render('search', array(
				'docs'=>$items,));
		
	}
        
        
        
         public function actionNationalitySearch(){
        if (isset($_GET['term'])) { // first search that 
                // if user arabic name 
                // or english name 
                // or miobile number match
                    
                               
                                $keyword = $_GET["term"];

                               $searchCriteria=new CDbCriteria;
//                             $searchCriteria->condition = 'CustomerNameArabic LIKE :searchstring OR CustomerID LIKE :searchstring OR MobilePhone LIKE :searchstring OR Nationality LIKE :searchstring AND CustomerNameArabic <> "" AND CustomerNameArabic IS NOT NULL ';
                             
                               

                               // the new library                                                                                                                    
                               if (isset($_GET['term'])) 
                               if ($keyword != '') {
                                    $keyword = @$keyword;
                                    $keyword = str_replace('\"', '"', $keyword);

                                    $obj = new ArQuery();
                                    $obj->setStrFields('CustomerNameArabic');
                                    $obj->setMode(1);

                                    $strCondition = $obj->getWhereCondition($keyword);
                                } 
                               //die($strCondition);

//			$qtxt = 'SELECT CustomerID, Nationality, CustomerNameArabic from CustomerMaster WHERE '.$strCondition.' OR CustomerNameEnglish LIKE :name OR MobilePhone Like :name limit 25';
//			$command = Yii::app()->db->createCommand($qtxt);
//			$command->bindValue(':name','%'.$_GET['term'].'%',PDO::PARAM_STR);
//			$res = $command->queryAll();
//                           if( count($res)<1){//run if no customer found 
                           //search DB if Land ID matches

                                    $qtxt = 'SELECT distinct Nationality nat from CustomerMaster WHERE Nationality Like :name';
                                    $command = Yii::app()->db->createCommand($qtxt);
                                    $command->bindValue(':name','%'.$_GET['term'].'%',PDO::PARAM_STR);
                                    $res = $command->queryColumn();

//                            }
		}
		print CJSON::encode($res);
        }       
        public function actionCustomerSearch()
	{// for autocomplete will do DB search for Customers and Lands
		
		if (isset($_GET['term'])) { // first search that 
                // if user arabic name 
                // or english name 
                // or miobile number match
                    
                               
                                $keyword = $_GET["term"];

                               $searchCriteria=new CDbCriteria;
//                             $searchCriteria->condition = 'CustomerNameArabic LIKE :searchstring OR CustomerID LIKE :searchstring OR MobilePhone LIKE :searchstring OR Nationality LIKE :searchstring AND CustomerNameArabic <> "" AND CustomerNameArabic IS NOT NULL ';
                             
                               

                               // the new library                                                                                                                    
                               if (isset($_GET['term'])) 
                               if ($keyword != '') {
                                    $keyword = @$keyword;
                                    $keyword = str_replace('\"', '"', $keyword);

                                    $obj = new ArQuery();
                                    $obj->setStrFields('CustomerNameArabic');
                                    $obj->setMode(1);

                                    $strCondition = $obj->getWhereCondition($keyword);
                                } 
                               //die($strCondition);

			$qtxt = 'SELECT CustomerNameArabic cus from CustomerMaster WHERE '.$strCondition.' OR CustomerNameEnglish LIKE :name OR MobilePhone Like :name';
			$command = Yii::app()->db->createCommand($qtxt);
			$command->bindValue(':name','%'.$_GET['term'].'%',PDO::PARAM_STR);
			$res = $command->queryColumn();
                           if( count($res)<1){//run if no customer found 
                           //search DB if Land ID matches

                                    $qtxt = 'SELECT LandID lnd from LandMaster WHERE LandID Like :name ';
                                    $command = Yii::app()->db->createCommand($qtxt);
                                    $command->bindValue(':name','%'.$_GET['term'].'%',PDO::PARAM_STR);                                    
                                    $res = $command->queryColumn();
                                    
                                     if( count($res)<1){
                                        
                                            $qtxt = 'SELECT CONCAT(LandID,"<-->",Remarks)  lnd from LandMaster WHERE  Remarks LIKE :rmark';
                                            $command = Yii::app()->db->createCommand($qtxt);                                            
                                            $command->bindValue(':rmark','%'.$_GET['term'].'%',PDO::PARAM_STR);
                                            $res = $command->queryColumn();
                                        
                                     }  

                            }
                            
                          
                            
                            
		}
		print CJSON::encode($res);
                
            // die ($strCondition);
	}
	

    
    
	public function actionSearch() 
	{   
            
      
            
       if(!isset($_POST["action"])){
        $_REQUEST["action"] =  $this->sAction;
        $_REQUEST["string"] =  $this->sString;
        $_REQUEST["returnType"] =  $this->returnType;
        $_REQUEST["retured"] =     $this->retured;        
        }
        
         
        
		if(isset($_REQUEST["action"]) and $_REQUEST["action"]=="search") //check that this action is only called using POST.. not get, not regular.
                {
                    
                    
                    
                       // emad code update
                                // receive the webservice post variables
                                if (!isset($_REQUEST['returnType']))
                                {
                                    $postreturn="";
                                }
                                else
                                    $postreturn=$_REQUEST['returnType'];
                                
                                
                                 if (!isset($_REQUEST['retured']))
                                {
                                    $returntype="";
                                }
                                else
                                    $returntype=$_REQUEST['retured'];
                                
                                
                               
                     //  =====================================================    
                                
                                
                                

                                if($stringToexplode = explode("<-->",$_REQUEST["string"]))
                                $searchstring = $stringToexplode[0];
                                else
                                    $searchstring=$_REQUEST["string"];
//                               //$stringvarify=explode("<-->",$searchstring);
//                               //print $stringvarify[0];
////                               if($stringvarify)
                               $keyword = $_REQUEST["string"];

                               $searchCriteria=new CDbCriteria;
//                             $searchCriteria->condition = 'CustomerNameArabic LIKE :searchstring OR CustomerID LIKE :searchstring OR MobilePhone LIKE :searchstring OR Nationality LIKE :searchstring AND CustomerNameArabic <> "" AND CustomerNameArabic IS NOT NULL ';
                             
                               

                               // the new library                                                                                                                    
                               if (isset($_REQUEST['string'])) 
                               if ($keyword != '') {
                                    $keyword = @$_REQUEST['string'];
                                    $keyword = str_replace('\"', '"', $keyword);

                                    $obj = new ArQuery();
                                    $obj->setStrFields('CustomerNameArabic');
                                    $obj->setMode(1);

                                    $strCondition = $obj->getWhereCondition($keyword);
                                } 
                              
                                
                               $searchCriteria->condition = $strCondition.' OR CustomerID LIKE :searchstring OR MobilePhone LIKE :searchstring OR Nationality LIKE :searchstring AND CustomerNameArabic <> "" AND CustomerNameArabic IS NOT NULL';
                               
                               $searchCriteria->params = array(':searchstring'=> $searchstring);
                               $searchCriteria->order = 'CustomerNameArabic';
                               $searchCriteria->limit = '25';
                               if (CustomerMaster::model()->count($searchCriteria)>0)
                                {
                                       $customerResult = CustomerMaster::model()->findAll($searchCriteria);
                                       
                                       
                                       
                                        // return nothing when you search for a customer name in web service call only
                                       if($postreturn=='ws')
                                       {
                                             print CJSON::encode("no result found");                                          
                                       }else                                           
                                       print CJSON::encode($customerResult);	
                                       
                                       
                                }
                               else
                               {       // search for lands and its current and previous owners plus all fines 
                                       //land details
                                       $lands = LandMaster::model()->findAllByAttributes(array("LandID"=>$searchstring));
                                                                                                                                                                                                                                                                                                                            
//                                       print count($lands)."aa";
                                       if(count($lands)<=0) { print CJSON::encode("no result found");return;}
                                       $landDetails["landInfo"] = $lands[0];
                                       $landDetails["landws"]= $lands;
                                                                              
                                       $deeds = DeedMaster::model()->findAllByAttributes(array("LandID"=>$searchstring), 'Remarks <> "cancelled"');
                                       $deedDetails = DeedDetails::model()->findAllByAttributes(array("DeedID"=>$deeds[0]->DeedID));
                                       $deedFiles = FileMaster::model()->findAllByAttributes(array("DeedID"=>$deeds[0]->DeedID));
                                       // current owners
                                       foreach ($deeds as $did) 
                                       {$landDetails["current"]["deed"] = $did->DeedID;
                                       $landDetails["current"]["Remarks"] = $did->Remarks;
                                       $landDetails["current"]["ArchiveUpdate"] = $did->ArchiveUpdate;
                                       $landDetails["current"]["DateCreated"] = $did->DateCreated;
                                       $landDetails["current"]["files"] = $deedFiles;
                                       }
                                         if(count($deedDetails)>0){

                                    foreach ($deedDetails as $key=>$cid) {
                                         $_cids[] = $cid->CustomerID;
                                         $_share[$cid->CustomerID]["sharePercentage"] = $cid->Share;
                                         $_share[$cid->CustomerID]["shareDeedDetaisID"] = $cid->DeedDetailsID;
                                         
                                         }
                                       
                                       if($postreturn!="ws")
                                       {
                                       $searchCriteria=new CDbCriteria;
                                       $searchCriteria->addInCondition("customerID", $_cids);
                                       $landDetails["current"]["customers"] = CustomerMaster::model()->findAll($searchCriteria);
                                       $landDetails["current"]["share"] = $_share;
                                       }
                                       else
                                       {
                                       $searchCriteria=new CDbCriteria;
                                       $searchCriteria->select="CustomerNameArabic,CustomerType";
                                       $searchCriteria->addInCondition("customerID", $_cids);
                                       $landDetails["current"]["wscustomers"] = CustomerMaster::model()->findAll($searchCriteria); 
                                       $landDetails["current"]["share"] = $_share;
                                       }
                                       
                                         }
                                       //previous owners
                                       $deeds = DeedMaster::model()->findAllByAttributes(array("LandID"=>$searchstring, "Remarks"=>"cancelled"),array('order'=>'DeedID DESC'));
                                        $_sharePreviousCustomer = null;
                                        $_cidsPrevious = null;
                                        $deedDetails = null;

                                        foreach ($deeds as $key=>$did) { 
                                         $deedDetails = DeedDetails::model()->findAllByAttributes(array("DeedID"=>$did->DeedID));
                                         $landDetails["previous"]["deed"][$key]["deed"]= $did->DeedID;
                                         
                                         /* Deed Details*/ 
                                       $landDetails["previous"]["deed"][$key]["id"] = $did->DeedID;
                                       $landDetails["previous"]["deed"][$key]["Remarks"] = $did->Remarks;
                                       $landDetails["previous"]["deed"][$key]["DateCreated"] = $did->DateCreated;
                                       /* Deed Details end*/
                                            if(count($deedDetails)>0){
                                                $_cidsPrevious = null;
                                                $_sharePreviousCustomer = null;
                                                    foreach ($deedDetails as $cid) {
                                                         $_cidsPrevious[] = $cid->CustomerID;
                                                          $_sharePreviousCustomer[$cid->CustomerID]["sharePercentage"] = $cid->Share;
                                                          $_sharePreviousCustomer[$cid->CustomerID]["shareDeedDetaisID"] = $cid->DeedDetailsID;
                                                    }
                                            $searchCriteria=new CDbCriteria;
                                            $searchCriteria->addInCondition("customerID", $_cidsPrevious);
                                            $landDetails["previous"]["deed"][$key]["customers"] = CustomerMaster::model()->findAll($searchCriteria);
                                            $landDetails["previous"]["deed"][$key]["share"] = $_sharePreviousCustomer;
                                            
                                            }
                                   }
                                   // fines related to land
                                      $fines = HajzMaster::model()->findAllByAttributes(array("LandID"=>$searchstring, "IsActive"=>"1"));
                                      $landDetails["fines"] = $fines;
                                      
                                      
                                      
                                      
                                       // emad code update
                                      
                                      // return the results as the type required
                                      
                                      if($postreturn=='ws'&&$returntype=='1')
                                       {                                                                                                                                      
                                           return CJSON::encode(   array_merge($landDetails["landws"],$landDetails["current"]["wscustomers"])    );                                            
                                          //print_r( array_merge($landDetails["landws"],$landDetails["current"]["wscustomers"]));
                                       }                                                                           
                                       else if($postreturn=='ws'&&$returntype=='2')
                                       {                                        
                                          print CJSON::encode(   array_merge($landDetails["landws"],$landDetails["fines"])    ); 
                                       }
                                       else if($postreturn=='ws'&&$returntype=='3')
                                       {                                         
                                           print CJSON::encode(   array_merge($landDetails["landws"],$landDetails["current"]["share"])    );
                                       }                                          
                                       else
                                           //  =====================================================  
                                       print CJSON::encode($landDetails);
                                       
                                       
                                       
                               }
		
		}else{// this will find land of cutomerID provided in $_POST["string"]
                    	if(isset($_REQUEST["action"]) and $_REQUEST["action"]=="propertySearch") //check that this action is only called using POST.. not get, not regular.
                         {  $lands["landDetails"]["current"] ="";
                            $lands["landDetails"]["previous"] ="";
			 $searchstring = json_decode($_REQUEST["string"]); 
//                        will get deed data feom customer ID
				$deedDetails = DeedDetails::model()->findAllByAttributes(array("CustomerID"=>$searchstring));
                                $_dids= null;

                                  foreach ($deedDetails as $key=>$did) {
                                         $_dids[] = $did->DeedID;
                                         
                                   }
//                                   print_r($_dids);
                                   // get lands related to cutomer from the DeedMaster using deed IDs where deed remarks are  cancelled
                                   
                                   //previous lands of customer
                                       $searchCriteria=new CDbCriteria;
                                       $searchCriteria->condition = '`Remarks` = "cancelled"';
                                       $searchCriteria->addInCondition("DeedID", $_dids);
                                       $LandIDs = DeedMaster::model()->findAll($searchCriteria);

                                       IF(COUNT($LandIDs)>0){
                                            foreach ($LandIDs as $key=>$landId) {
                                              $_landids[] = $landId->LandID;

                                              }
//                                              print_r($_landids);
                                            $searchCriteria=new CDbCriteria;
                                            $searchCriteria->addInCondition("LandID", $_landids);
                                               $lands["landDetails"]["previous"]=$LandInfo = LandMaster::model()->findAll($searchCriteria);
//                                               print  $lands["landDetails"]["previous"][0]->LandID;
                                        }
                                     // get lands related to cutomer from the DeedMaster using deed IDs where deed remarks are not cancelled  

                                       $searchCriteria = null;
                                       $searchCriteria=new CDbCriteria;
                                       $searchCriteria->condition = "Remarks <> 'cancelled'";
//                                       $searchCriteria->compare('Remarks', '<>cancelled', true);
                                       
                                       $searchCriteria->addInCondition("DeedID", $_dids);
                                       $LandIDs = DeedMaster::model()->findAll($searchCriteria);
//                                       print "cont ".COUNT($LandIDs);
                         IF(COUNT($LandIDs)>0){$_landids= null;
                                                foreach ($LandIDs as $key=>$landId) {
//                                                    if($landId->Remarks !="cancelled")
                                                  $_landids[] = $landId->LandID;
                                                  }
//                                                  print "lanids";
//                                                  print_r($_landids);

                                                 $searchCriteria=new CDbCriteria;
                                                 $searchCriteria->addInCondition("LandID", $_landids);
                                                 $lands["landDetails"]["current"]=$LandInfo = LandMaster::model()->findAll($searchCriteria);  
                                                 foreach ($_landids as $lKey=>$lId) {
//                                                     print $lId;
                                                       $searchCriteria=new CDbCriteria;
                                                        $searchCriteria->condition = '`LandID`= "'.$lId.'" AND Remarks <> "cancelled"';
                                                        $LandDeedInfo = DeedMaster::model()->findAll($searchCriteria);   
//                                                        print "deedid";
                                                        $LandDeedInfo[0]->DeedID;
//                                                        print_r($LandDeedInfo);  

                                                        $searchCriteria=new CDbCriteria;
                                                        $searchCriteria->condition = '`DeedID`= '.$LandDeedInfo[0]["DeedID"];
                                                        $DeedCustomerInfo = DeedDetails::model()->findAll($searchCriteria); 
                                                        $_cids = null;
                                                        foreach ($DeedCustomerInfo as $key=>$cId) {
                                                             $_cids[] = $cId->CustomerID;
                                                         }
//                                                         print_r($_cids);

                                                       $searchCriteria=new CDbCriteria;
                                                       $searchCriteria->addInCondition("CustomerID", $_cids);
                                                       $lands["currentOwners"][$lKey]=$CustomerInfo = CustomerMaster::model()->findAll($searchCriteria);   
                                                  }
                         }else{
                              $searchstring = $_POST["string"];

                               $searchCriteria=new CDbCriteria;
                               $searchCriteria->condition = 'CustomerNameArabic LIKE :searchstring OR CustomerID LIKE :searchstring OR MobilePhone LIKE :searchstring OR Nationality LIKE :searchstring AND CustomerNameArabic <> "" AND CustomerNameArabic IS NOT NULL ';
                               $searchCriteria->params = array(':searchstring'=> $searchstring);
                               $searchCriteria->order = 'CustomerNameArabic';
                               $searchCriteria->limit = '25';
                               if (CustomerMaster::model()->count($searchCriteria)>0)
                                {
                                       $lands["currentOwners"]=$customerResult = CustomerMaster::model()->findAll($searchCriteria);
                                }
                         }

                                
                                print CJSON::encode($lands);
                       }
                }	
	}

        
        
         public function actionWS()
	 {     
             // This action will receive the encrypted code and after that decrypt this code and get the land id from it 
             // now we use this land id for searching in the other Search action  and print the result in the landResults view                           
             $ky = '!GIS_LaPD@2013!&&!GIS_LaPD@2013!'; // 32 * 8 = 256 bit key
             $iv = '!LaPD_GIS@2013!&&!LaPD_GIS@2013!'; // 32 * 8 = 256 bit iv             
             $this->sAction = "search";            
             $this->returnType="ws";
             $this->retured="1";                                                   
             if(isset($_POST['string'])) {
                 
                 $codetodecrypt=$_POST['string'];
                 $resultstring = $this->decryptRJ256($ky,$iv,$codetodecrypt);  
                   // print_r($codetodecrypt);DIE;
                    $resultstring = explode("|",$resultstring);                                                
                    $this->sString=$resultstring[2];
                   
                   // die();
                    $wsarray=$this->actionSearch();

                    $this->renderPartial('landResults', array(
                                       'customerws'=>$wsarray
                                       ));     

             }else    
                  $this->renderPartial('landResults', array(
                                       'customerws'=>"Pl Provide Land id in string parameter"
                                       ));   
         }    
         public function decryptRJ256($key,$iv,$string_to_decrypt)
        {
            $string_to_decrypt = base64_decode($string_to_decrypt);
            $rtn = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $string_to_decrypt, MCRYPT_MODE_CBC, $iv);
            $rtn = rtrim($rtn, "\0\4");
            return($rtn);
        }


        protected  function encryptRJ256($key,$iv,$string_to_encrypt)
        {
            $rtn = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $string_to_encrypt, MCRYPT_MODE_CBC, $iv);
            $rtn = base64_encode($rtn);
            return($rtn);
        }
        
        public function actionpSearchProperty()
	{// method not in use 
            // this is a test commit// j comiited
		if(isset($_POST["data"])) //check that this action is only called using POST.. not get, not regular.
        {
			$searchstring = json_decode($_POST["data"]); 
			$searchCriteria=new CDbCriteria;
			$searchCriteria->condition = 'CustomerNameArabic LIKE :searchstring OR MobilePhone LIKE :searchstring OR Nationality LIKE :searchstring';
			$searchCriteria->params = array(':searchstring'=> $searchstring);
			$searchCriteria->order = 'CustomerNameArabic';
//                        $searchCriteria->limit = '0,300';
		
			if (CustomerMaster::model()->count($searchCriteria)>0)
	        {
				$customerResult = CustomerMaster::model()->findAll($searchCriteria);
                                $customerPropertyResult = "123";LandMaster::model()->findAllByAttributes(array("LandID"=>$customerResult[0]["CustomerID"]));
                                    $customerResult[0]["customerResultProperty"] = $customerPropertyResult;
			}

			else
			{
				$lands = LandMaster::model()->findAllByAttributes(array("LandID"=>$searchstring));
				$deed = DeedMaster::model()->findAllByAttributes(array("LandID"=>$searchstring));
				print CJSON::encode($lands);
				
			}
		
		}	
		
	}
}
?>
