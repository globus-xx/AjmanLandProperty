<?php

class CustomerServiceController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			//'accessControl', // perform access control for CRUD operations
			'rights',
//			'accessControl', // perform access control for CRUD operations
//			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','Search','CustomerSearch'),
				'users'=>array('@'),
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
		if(isset($_POST["action"]) and $_POST["action"]=="search") //check that this action is only called using POST.. not get, not regular.
                {
                    
                    
                    
                       // emad code update
                                // receive the webservice post variables
                                if (!isset($_POST['returnType']))
                                {
                                    $postreturn="";
                                }
                                else
                                    $postreturn=$_POST['returnType'];
                                
                                
                                 if (!isset($_POST['retured']))
                                {
                                    $returntype="";
                                }
                                else
                                    $returntype=$_POST['retured'];
                                
                                
                               
                     //  =====================================================    
                                
                                
                                

                                if($stringToexplode = explode("<-->",$_POST["string"]))
                                $searchstring = $stringToexplode[0];
                                else
                                    $searchstring=$_POST["string"];
//                               //$stringvarify=explode("<-->",$searchstring);
//                               //print $stringvarify[0];
////                               if($stringvarify)
                               $keyword = $_POST["string"];

                               $searchCriteria=new CDbCriteria;
//                             $searchCriteria->condition = 'CustomerNameArabic LIKE :searchstring OR CustomerID LIKE :searchstring OR MobilePhone LIKE :searchstring OR Nationality LIKE :searchstring AND CustomerNameArabic <> "" AND CustomerNameArabic IS NOT NULL ';
                             
                               

                               // the new library                                                                                                                    
                               if (isset($_POST['string'])) 
                               if ($keyword != '') {
                                    $keyword = @$_POST['string'];
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
                               {// search for lands and its current and previous owners plus all fines 
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
                                       $searchCriteria=new CDbCriteria;
                                       $searchCriteria->addInCondition("customerID", $_cids);
                                       $landDetails["current"]["customers"] = CustomerMaster::model()->findAll($searchCriteria);
                                       $landDetails["current"]["share"] = $_share;
                                       

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
                                           print CJSON::encode(   array_merge($landDetails["landws"],$landDetails["current"]["customers"])    );                                            
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
                    	if(isset($_POST["action"]) and $_POST["action"]=="propertySearch") //check that this action is only called using POST.. not get, not regular.
                         {  $lands["landDetails"]["current"] ="";
                            $lands["landDetails"]["previous"] ="";
			 $searchstring = json_decode($_POST["string"]); 
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
