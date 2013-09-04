<?php

class LandMasterController extends Controller
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
				'actions'=>array('create','update','getland','saveland'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin','omar'),
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
	public function actiongetland()
	{
		if(isset($_POST["data"]))
		{
			 $landid = json_decode($_POST["data"]); 
			 $land = LandMaster::model()->findByPk($landid);

			print CJSON::encode($land);
		}
	}

	public function actionsaveland()
	{
		if(isset($_POST["data"]))
		{

			$landinfo = json_decode($_POST["data"]);
			$land = LandMaster::model()->findByPk($landinfo->landid);
			$land->LocationID = $landinfo->LocationID;
			$land->location = $landinfo->location;
			$land->Plot_No = $landinfo->Plot_No;
			$land->Piece = $landinfo->Piece;
			$land->length = $landinfo->len;
			$land->width = $landinfo->width;
			$land->TotalArea = $landinfo->TotalArea;
			$land->AreaUnit = $landinfo->AreaUnit;
			$land->North = $landinfo->North;
			$land->South = $landinfo->South;
			$land->East = $landinfo->East;
			$land->West = $landinfo->West;
			$land->save();
		
			print CJSON::encode("saved");
		}
	}
			
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
		$model=new LandMaster;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['LandMaster']))
		{
			$model->attributes=$_POST['LandMaster'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->LandID));
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
	public function actionUpdate()
	{
		//$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['LandMaster']))
		{
			$model->attributes=$_POST['LandMaster'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->LandID));
		}

		$this->render('update',array(
		//	'model'=>$model,
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
		$dataProvider=new CActiveDataProvider('LandMaster');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new LandMaster('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['LandMaster']))
			$model->attributes=$_GET['LandMaster'];

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
		$model=LandMaster::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='land-master-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
