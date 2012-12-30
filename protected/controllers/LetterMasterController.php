<?php

class LetterMasterController extends Controller
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
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('index','Search'),
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
		
//		$countriesT = array();
//		$countries = array();
//		$lines = file('C:\xampp\htdocs\AjmanLandProperty\protected\data\countries.csv', FILE_IGNORE_NEW_LINES);
//
//		foreach ($lines as $key => $value)
//		{
//			$countriesT[] = str_getcsv($value);
//			
//		}
//		foreach($countriesT as $key=>$value)
//		{
//			$countries[] = $value[0];
//
//		}
//		
//		$customerList = CustomerMaster::model()->FindAll();
//		$landList = LandMaster::model()->FindAll();
//		
//		$landArray = array();
//		$customerArray = array();
//
//		foreach($customerList as $customer)
//		{   
//			$customerArray[] = $customer->CustomerNameArabic;
////			$customerArray[] = $customer->MobilePhone;
//		}
//		
//		foreach($landList as $land)
//		{
//			$landArray[] = $land->LandID;
//		}
//		$autocomplete = array_merge($countries, $landArray, $customerArray);
//		
//		$this->render('search', array(
//				'autocomplete'=>$autocomplete,
//				));
                
            print "I am here in letterMaster";
            $this->render('search');
		
	}
	public function actionpropertySearch() {
            {
		if(isset($_POST["data"])) //check that this action is only called using POST.. not get, not regular.
                        {
                                
                                $searchCriteria=new CDbCriteria;
                                $searchstring = json_decode($_POST["data"]); 	
                                $UserID = json_decode($_POST["data"]);
//                                 $lands = LandMaster::model()->findAllByAttributes(array("LandID"=>$searchstring));
                                 $deed = DeedMaster::model()->findAllByAttributes(array("UserID"=>$UserID));
                                        //$stuff = array_merge($lands,$deed);
                                        //$this->render('result',array('lands'=>$lands, 'deed'=>$deed,));
                                  print CJSON::encode($lands);

                          }
            }    
        }
	public function actionSearch()
	{   
		if(isset($_POST["action"]) and $_POST["action"]=="search") //check that this action is only called using POST.. not get, not regular.
        {
                       
                    
			 $searchstring = $_POST["string"];
//                        $searchstring = explode("&", $searchstring);
//                        print_r($searchstring);
//                        print "123".$searchstring["action"];
			//$searchstring = "%".$searchstring . "%"; 
			
			$searchCriteria=new CDbCriteria;
			$searchCriteria->condition = 'CustomerNameArabic LIKE :searchstring OR MobilePhone LIKE :searchstring OR Nationality LIKE :searchstring';
			$searchCriteria->params = array(':searchstring'=> $searchstring);
			$searchCriteria->order = 'CustomerNameArabic';
		
			if (CustomerMaster::model()->count($searchCriteria)>0)
	        {
				$customerResult = CustomerMaster::model()->findAll($searchCriteria);
                                
                                $customerPropertyResult = "123";//LandMaster::model()->findAllByAttributes(array("LandID"=>$customerResult[0]["CustomerID"]));
//                                $customerResult[0]->customerResultProperty = $customerPropertyResult;
//                                   $customerResult[0]["customerResultProperty"] = $customerPropertyResult;
//                                print_r($customerResult[0]);
				print CJSON::encode($customerResult);			
			}

			else
			{
				$lands = LandMaster::model()->findAllByAttributes(array("LandID"=>$searchstring));
				$deed = DeedMaster::model()->findAllByAttributes(array("LandID"=>$searchstring));
				//$stuff = array_merge($lands,$deed);
				//$this->render('result',array('lands'=>$lands, 'deed'=>$deed,));
				print CJSON::encode($lands);
				
			}
		
		}else{
                    	if(isset($_POST["action"]) and $_POST["action"]=="propertySearch") //check that this action is only called using POST.. not get, not regular.
        {
			 $searchstring = json_decode($_POST["string"]); 
				$deedDetails = DeedDetails::model()->findAllByAttributes(array("CustomerID"=>$searchstring));
//                                print_r($deed[0]);
//                                print "deed".$deed[0]->DeedID;
				$deed = DeedMaster::model()->findAllByAttributes(array("DeedID"=>$deedDetails[0]->DeedID));
				$lands = LandMaster::model()->findAllByAttributes(array("LandID"=>$deed[0]->LandID));

                                print CJSON::encode($lands);
				
//			}
		
		}
                }	
		
	}
        public function actionpSearch()
	{
		if(isset($_POST["data"])) //check that this action is only called using POST.. not get, not regular.
        {
			$searchstring = json_decode($_POST["data"]); 
			//$searchstring = "%".$searchstring . "%"; 
			
//			$searchCriteria=new CDbCriteria;
//			$searchCriteria->condition = 'CustomerNameArabic LIKE :searchstring OR MobilePhone LIKE :searchstring OR Nationality LIKE :searchstring';
//			$searchCriteria->params = array(':searchstring'=> $searchstring);
//			$searchCriteria->order = 'CustomerNameArabic';
		
//			if (CustomerMaster::model()->count($searchCriteria)>0)
//	        {
//				$customerResult = CustomerMaster::model()->findAll($searchCriteria);
//                                
//                                $customerPropertyResult = "123";//LandMaster::model()->findAllByAttributes(array("LandID"=>$customerResult[0]["CustomerID"]));
////                                $customerResult[0]->customerResultProperty = $customerPropertyResult;
////                                   $customerResult[0]["customerResultProperty"] = $customerPropertyResult;
////                                print_r($customerResult[0]);
//				print CJSON::encode($customerResult);			
//			}
//
//			else
//			{

				$deedDetails = DeedDetails::model()->findAllByAttributes(array("CustomerID"=>$searchstring));
//                                print_r($deed[0]);
//                                print "deed".$deed[0]->DeedID;
				$deed = DeedMaster::model()->findAllByAttributes(array("DeedID"=>$deedDetails[0]->DeedID));
				$lands = LandMaster::model()->findAllByAttributes(array("LandID"=>$deed[0]->LandID));

                                print CJSON::encode($lands);
				
//			}
		
		}	
		
	}
        public function actionpSearchProperty()
	{
		if(isset($_POST["data"])) //check that this action is only called using POST.. not get, not regular.
        {
			$searchstring = json_decode($_POST["data"]); 
			//$searchstring = "%".$searchstring . "%"; 
			
			$searchCriteria=new CDbCriteria;
			$searchCriteria->condition = 'CustomerNameArabic LIKE :searchstring OR MobilePhone LIKE :searchstring OR Nationality LIKE :searchstring';
			$searchCriteria->params = array(':searchstring'=> $searchstring);
			$searchCriteria->order = 'CustomerNameArabic';
//                        $searchCriteria->limit = '0,300';
		
			if (CustomerMaster::model()->count($searchCriteria)>0)
	        {
				$customerResult = CustomerMaster::model()->findAll($searchCriteria);
                                $customerPropertyResult = "123";LandMaster::model()->findAllByAttributes(array("LandID"=>$customerResult[0]["CustomerID"]));
//                                LandDetails::model()->findByPk($customerResult[0]["CustomerID"]);
//				if(count($customerResult)==1) 
                                    $customerResult[0]["customerResultProperty"] = $customerPropertyResult;
//print_r($customerResult);
                                //print CJSON::encode($customerResult);			
			}

			else
			{
				$lands = LandMaster::model()->findAllByAttributes(array("LandID"=>$searchstring));
				$deed = DeedMaster::model()->findAllByAttributes(array("LandID"=>$searchstring));
				//$stuff = array_merge($lands,$deed);
				//$this->render('result',array('lands'=>$lands, 'deed'=>$deed,));
				print CJSON::encode($lands);
				
			}
		
		}	
		
	}
}
?>
