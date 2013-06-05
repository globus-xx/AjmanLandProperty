<?php

class DocumentController extends Controller
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
			'accessControl', // perform access control for CRUD operations
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
				'actions'=>array('create','update','search', 'download', 'formDocumentType'),
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

	public function actionDownload($id){
		$model = $this->loadModel($id);
    $path =  $model->downloadPath();//Yii::app()->basePath.'/../assets/files/'.$model->id;
    $file =  urldecode($path);

    if (file_exists($file)) {
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename=' . $model->attributes['fileName']);
      header('Content-Length: ' . filesize($file));
    	echo file_get_contents($path);
      exit;

    }else{
      echo "file not exist: ".$model->attributes['title'];            
    }
    exit;
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new Document();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Document']))
		{
			$attributes = $_POST['Document'];
      $attributes['documentTypeId'] = $_POST['Document']['documentTypeId'];

      $file = CUploadedFile::getInstance($model,'file');
      $attributes['fileName']= $file->name;
      $attributes['mimeType']= $file->type;
      $attributes['fileSize']= $file->size;
      $model->attributes = $attributes;
      $model->file = CUploadedFile::getInstance($model,'file');

      

			if($model->save()){
        $model->file->saveAs(Yii::app()->basePath.'/../assets/files/'.$model->id);        
			  // save all the meta details as well
			  // create the document metas
        foreach($_POST['Document']['documentMetas'] as $one_meta){
          $_document_meta = new DocumentMeta;
          $one_meta['documentId'] = $model->id;
          $_document_meta->attributes = $one_meta;
          if($_document_meta->save(false)){
          }
        }
  			$this->redirect(array('view','id'=>$model->id));
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
		$model = $this->loadModel($id);
    $_model_document_metas = DocumentMeta::model()->findAllByAttributes(array('documentId'=>$id));


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Document']))
		{
			$model->attributes = $_POST['Document'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
    
    if(isset($_POST['Document']))
    {
      $attributes = $_POST['Document'];
      $attributes['documentTypeId'] = $_POST['Document']['documentTypeId'];

      $file = CUploadedFile::getInstance($model,'file');
      if($file):
        $attributes['fileName']= $file->name;
        $attributes['mimeType']= $file->type;
        $attributes['fileSize']= $file->size;
        $model->attributes = $attributes;
        $model->file = CUploadedFile::getInstance($model,'file');
      else:
          $model->attributes = $attributes;
      endif;
      

      if($model->save()){
        if($file):
          $model->file->saveAs(Yii::app()->basePath.'/../assets/files/'.$model->id);        
        endif;
        // save all the meta details as well
        // create the document metas
        foreach($_POST['Document']['documentMetas'] as $one_meta){
          if(isset($one_meta['id'])):
            $_document_meta = DocumentMeta::model()->find($one_meta['id']);
            if(isset($one_meta['delete'])):
              $_document_meta->delete();
              continue;
            endif;
          else:
            $_document_meta = new DocumentMeta;
          endif;
          $one_meta['documentId'] = $model->id;
          $_document_meta->attributes = $one_meta;
          if($_document_meta->save(false)){
          }
        }
        $this->redirect(array('view','id'=>$model->id));
      }
    }



		$this->render('update',array(
			'model'=>$model,
      '_model_document_metas' => $_model_document_metas,
       '_documentType' => DocumentTypes::model()->findByPk($model->documentTypeId),
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Document');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionSearch(){
		$term = $_GET['term'];

		$sql = 'select documents.* from documents where documents.title like "'.$term.'%"';

	$connection=Yii::app()->db;
	$command=$connection->createCommand($sql);
	$models=$command->queryAll(); 

    $this->layout = false;
    echo CJSON::encode($models);

	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Document('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Document']))
			$model->attributes=$_GET['Document'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
  
  /*
   * Returns the subform based upon the documentType chosen
   * */
  public function actionFormDocumentType(){
    $documentTypeId = $_GET['documentTypeId'];
    $_documentType = DocumentTypes::model()->findByPk($documentTypeId);
    
    
    $this->layout = false;
    $this->render('form-document-type', array('documentType'=>$_documentType));
  }
 

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Document::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='document-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
