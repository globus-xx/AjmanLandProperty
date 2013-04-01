<?php

class FileTrackerController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('create','update','checkfile','send','receive',),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
		$model=new FileTracker;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FileTracker']))
		{
			$model->attributes=$_POST['FileTracker'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actioncheckfile()
	{
		if(isset($_POST['data']))
		{
            
            $qtxt = 'SELECT LandID from FileTracker WHERE LandID LIKE '.$_POST['data'].' AND Status LIKE "out"';
            $command = Yii::app()->db->createCommand($qtxt);
            $res = $command->queryColumn();
			
			if (!$res)
			{
				print CJSON::encode('none');
			}
			else
			{
				$qtxt = 'SELECT id, LandID, UserIDgiver, UserIDreceiver, Department, DateTime from FileTracker WHERE LandID LIKE '.$_POST['data'].' AND Status LIKE "out"';
                $command = Yii::app()->db->createCommand($qtxt);
                $res = $command->queryAll();
                               
				print CJSON::encode($res);
			}
		}
	}
    
    public function actionsend()
    {
        if(isset($_POST["data"]))
        {
            $data= json_decode($_POST["data"]);
            
            $file = new FileTracker;
            $file->LandID = $data->landid;
            $file->UserIDgiver = Yii::app()->User->ID;
            $file->UserIDreceiver = $data->receiver;
            $file->Department = $data->department;
            $file->DateTime = date('d-m-y G:i');
            $file->Status = "out";
            $file->save();
        }
        
    }
    
    public function actionreceive()
    {
        if(isset($_POST["data"]))
        {
            $data= json_decode($_POST["data"]);
            $file = FileTracker::model()->findByPk($data->id);
            $file->Status = "in";
            $file->save();
        }          
                    
        
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

		if(isset($_POST['FileTracker']))
		{
			$model->attributes=$_POST['FileTracker'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$dataProvider=new CActiveDataProvider('FileTracker');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new FileTracker('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FileTracker']))
			$model->attributes=$_GET['FileTracker'];

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
		$model=FileTracker::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='file-tracker-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
