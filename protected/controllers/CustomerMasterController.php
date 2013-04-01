<?php

class CustomerMasterController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

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
				'actions'=>array('create','update','admin'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'actions'=>array('admin','index','view','create','update','delete'),
				'users'=>array('telkhateeb'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new CustomerMaster;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['CustomerMaster']))
		{
			$model->attributes= $_POST['CustomerMaster'];
			if($model->save())
			{
				$this->redirect(array('view','id'=>$model->CustomerID));
			}
			
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['CustomerMaster']))
		{
			$model->attributes=$_POST['CustomerMaster'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->CustomerID));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('CustomerMaster');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CustomerMaster('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CustomerMaster']))
			$model->attributes=$_GET['CustomerMaster'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=CustomerMaster::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function actionimportinfo()
	{
		
		if(isset($_GET["id"]))
		{
			$xml = @file_get_contents('http://192.168.5.61/'.$_GET["id"].'.xml');


			function out($xm,$tag)
 		    {
			   $tag1 = '<'.$tag.'>';
			   $tag2 = '</'.$tag.'>';
			   $s = strpos($xm,$tag1);
			   $j = strpos($xm,$tag2);
			   $out = substr($xm,$s+strlen($tag1),$j-$s-strlen($tag2)+1);
			   return $out;
			}
			
			$ar_name = out($xml,'ar_name'); $ar_name = str_replace(","," ",$ar_name);			
			$en_name = out($xml,'en_name'); $en_name = str_replace(","," ",$en_name);
			$id = out($xml,'IDN');
			$nationality = out($xml,'arNat');
			$issueDate = out($xml,'issueDate');
			$expiryDate = out($xml,'DoB');
			$mobile = out($xml, 'MobNo'); $mobile = str_replace("+","",$mobile);
			$dob = out($xml,'sex');
			
			if($_GET['existing']==0) //New Customer
			{
				$newcustomer = new CustomerMaster;
				$newcustomer->CustomerNameArabic = $ar_name;
				$newcustomer->CustomerNameEnglish = $en_name;
				$newcustomer->DocumentNumber = $id; 
				$newcustomer->DocumentType = 'الهوية الوطنية';
				$newcustomer->Nationality = $nationality;
				$newcustomer->IssuedOn = $issueDate;
				$newcustomer->ExpiresOn = $expiryDate;
				$newcustomer->MobilePhone = $mobile;
				$newcustomer->DateofBirth = $dob;
				$newcustomer->save();
			}
			else
			{
				$newcustomer = CustomerMaster::model()->findByPk($_GET['existing']);
				$newcustomer->CustomerNameArabic = $ar_name;
				$newcustomer->CustomerNameEnglish = $en_name;
				$newcustomer->DocumentNumber = $id; 
				$newcustomer->DocumentType = 'الهوية الوطنية';
				$newcustomer->Nationality = $nationality;
				$newcustomer->IssuedOn = $issueDate;
				$newcustomer->ExpiresOn = $expiryDate;
				$newcustomer->MobilePhone = $mobile;
				$newcustomer->DateofBirth = $dob;
				$newcustomer->save();
			}
			print CJSON::encode($newcustomer->CustomerID);		
		}
		
		
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='customer-master-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
