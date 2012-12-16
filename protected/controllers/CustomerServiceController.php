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
		
		$countriesT = array();
		$countries = array();
		$lines = file('/var/www/AjmanLandProperty/protected/data/countries.csv', FILE_IGNORE_NEW_LINES);

		foreach ($lines as $key => $value)
		{
			$countriesT[] = str_getcsv($value);
			
		}
		foreach($countriesT as $key=>$value)
		{
			$countries[] = $value[0];

		}
		
		$customerList = CustomerMaster::model()->FindAll();
		$landList = LandMaster::model()->FindAll();
		
		$landArray = array();
		$customerArray = array();

		foreach($customerList as $customer)
		{   
			$customerArray[] = $customer->CustomerNameArabic;
//			$customerArray[] = $customer->MobilePhone;
		}
		
		foreach($landList as $land)
		{
			$landArray[] = $land->LandID;
		}
		$autocomplete = array_merge($countries, $landArray, $customerArray);
		
		$this->render('search', array(
				'autocomplete'=>$autocomplete,
				));
		
	}
	
	public function actionSearch()
	{
		if(isset($_POST["data"])) //check that this action is only called using POST.. not get, not regular.
        {
			$searchstring = json_decode($_POST["data"]); 
			//$searchstring = "%".$searchstring . "%"; 
			
			$searchCriteria=new CDbCriteria;
			$searchCriteria->condition = 'CustomerNameArabic LIKE :searchstring OR MobilePhone LIKE :searchstring OR Nationality LIKE :searchstring';
			$searchCriteria->params = array(':searchstring'=> $searchstring);
			$searchCriteria->order = 'CustomerID';
		
			if (CustomerMaster::model()->count($searchCriteria)>0)
	        {
				$customerResult = CustomerMaster::model()->findAll($searchCriteria);
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
		
		}	
		
	}
}
?>
