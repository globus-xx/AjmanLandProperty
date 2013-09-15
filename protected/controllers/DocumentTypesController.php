<?php

class DocumentTypesController extends Controller
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

        public function get_db_name()
        {
              $curdb  = explode('=', Yii::app()->db->connectionString);
              return $curdb[2];
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
				'actions'=>array('create','update'),
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
                        '_model_document_type_metas'=>DocumentTypeMeta::model()->findAllByAttributes(array('documentTypeId'=>$id))
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new DocumentTypes;
                $_model_document_type_meta = new DocumentTypeMeta();
                $database_name = $this->get_db_name();
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);              
		if(isset($_POST['Documenttypes']))
		{
                    
                    $table_name = $_POST['Documenttypes']['table_name'];
                                                
                    // =========== get primary id       
                        $primary_table_id = "";
                        $sql = 'SELECT k.column_name
                                FROM information_schema.table_constraints t
                                JOIN information_schema.key_column_usage k
                                USING(constraint_name,table_schema,table_name)
                                WHERE t.constraint_type=\'PRIMARY KEY\'
                                AND t.table_schema=\''.$database_name.'\'
                                AND t.table_name=\''.$table_name.'\';';

                        $connection=Yii::app()->db;
                        $command=$connection->createCommand($sql);
                        $primary_id=$command->queryAll();
                    
                        foreach($primary_id as $row)
                        {
                            $primary_table_id = $row['column_name'];
                        }
                                                
                        
                        
			$model->attributes = $_POST['Documenttypes'];                        
                        $model->primary_id = $primary_table_id;   
                        $model->createdAt= date("Y-m-d H:i:s");
                        $model->updatedAt= date("Y-m-d H:i:s");   
                    
                    if($model->save()){
                            
                    // ========== add new record in document type meta                                                                                              
                    // get the metas from any table                                       
                    $sql = 'DESCRIBE '.$table_name.' ;';
                    
                    $connection=Yii::app()->db;
                    $command=$connection->createCommand($sql);
                    $result=$command->queryAll(); 
                
                    if($result)
                    {                       
                        foreach($result as $meta)
                        {
                            $doctypemeta = new DocumentTypeMeta();
                                                       
                            if(preg_match('/int/',$meta["Type"]))
                            $type = "integer";                            
                            elseif(preg_match('/varchar/',$meta["Type"]))
                            $type = "string";    
                            else
                            $type  = $meta["Type"];
                                                        
                            $newtype["title"] = $_POST['Documenttypes']['title'];
                            $newtype["documentTypeId"] = $model->id;
                            $newtype["meta_option"] = $meta["Field"];   
                            $newtype["meta_type"] = $type;
                            $newtype["createdAt"] = date("Y-m-d H:i:s");
                            $newtype["updatedAt"] = date("Y-m-d H:i:s");   

                            $doctypemeta->attributes = $newtype;                    
                            $doctypemeta->insert();                                                       
                        }                                                                    
                    }
                    
                    
                            
//                                create the document metas
//                                foreach($_POST['DocumentTypeMeta'] as $one_meta){
//                                    $model_document_type_meta = new DocumentTypeMeta;
//                                    $one_meta['documentTypeId'] = $model->id;
//
//                                    $model_document_type_meta->attributes = $one_meta;
//                                    if($model_document_type_meta->save(false)){
//                                            
//                                    }
//                                }
                                                                                                                            
                                $this->redirect(array('view','id'=>$model->id));
			}
		}

                
                
                
                    $sql = 'SELECT DISTINCT TABLE_NAME As Tables
                            FROM information_schema.columns
                            WHERE table_schema = \''.$database_name.'\'
                            ';
                    
                    $connection=Yii::app()->db;
                    $command=$connection->createCommand($sql);
                    $tables = $command->queryAll();
                    
                   
                     
		$this->render('create',array(
			'model'=>$model,
			'_model_document_type_meta' => $_model_document_type_meta   ,
                        'tables' => $tables
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
                $_model_document_type_metas = new DocumentTypeMeta();             
                $_model_document_type_meta = DocumentTypeMeta::model()->findAllByAttributes(array('documentTypeId'=>$id));
                
   
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Documenttypes']))
		{
                 
			$model->attributes=$_POST['Documenttypes'];                                                
                                                          
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));                                                 
		}

                 
		$this->render('update',array(
                'model'=>$model,
                '_model_document_type_meta' => $_model_document_type_meta,
                '_model_document_type_metas' => $_model_document_type_metas                               
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
            $post = DocumentTypeMeta::model()->deleteAll("`documentTypeId` = :documentTypeId", array('documentTypeId' => $id)); 
            
            // we only allow deletion via POST request
			$this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            
            
//		if(Yii::app()->request->isPostRequest)
//		{
//      DocumentTypeMeta::model()->deleteAllByAttributes(array('documentTypeId'=>$id));
//  
//			// we only allow deletion via POST request
//			$this->loadModel($id)->delete();
//
//			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//			if(!isset($_GET['ajax']))
//				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
//		}
//		else
//			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('DocumentTypes');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new DocumentTypes('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DocumentTypes']))
			$model->attributes=$_GET['DocumentTypes'];

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
		$model=DocumentTypes::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='document-types-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
