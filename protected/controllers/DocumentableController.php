<?php

class DocumentableController extends Controller
{
	public function actionCreate()
	{
		$model = new Documentable();
		$attributes = $_POST['Documentable'];
		$model->attributes = $attributes;
		die($model->save());
		$this->layout = false;
		$documentableType = $_POST['Documentable']['documentable_type'];
		$documentableId = $_POST['Documentable']['documentable_id'];
		$model = new Documentable();
		$model->attributes = array(	'documentable_type'=>$documentableType,'documentable_id'=>$documentableId    );
		$documentables = Documentable::model()->with('document')->findAllByAttributes(array('documentable_type'=>$documentableType, 'documentable_id'=>$documentableId));

		$this->render('_view', array('model'=>$model, 'documentables'=>$documentables));

		//$this->render('create');
	}

	public function actionView()
	{
		// get the params documentable_type & id
		$model = new Documentable();
		$documentableType = $_GET['documentableType'];
		$documentableId = $_GET['documentableId'];
                
		$documentables = Documentable::model()->with('document')->findAllByAttributes(array('documentable_type'=>$documentableType, 'documentable_id'=>$documentableId));
		$model->attributes = array('documentable_type'=>$documentableType, 'documentable_id'=>$documentableId);
		$this->layout = false;
                
                
                $sql = 'select * from filesetting;';
                $connection=Yii::app()->db;
                $command=$connection->createCommand($sql);
                $result=$command->queryAll();
                
                $filetypes =  $result[0]['file_types'];
                $filesize =  $result[0]['file_size'];
                
                $model2 = new Document();    
		$this->render('_view', array('model'=>$model, 'documentables'=>$documentables , 'model2' => $model2, 'types' => $filetypes, 'size' => $filesize ));                
	}

	public function actionDelete()
	{
		Documentable::model()->deleteByPk($_POST['id']);
		$this->layout = false;
		echo true;
	}
        
        
        
        public function actionCheck_doc_type()
	{
		$documentableType = $_POST['Documentable']['documentable_type'];
		$documentableId = $_POST['Documentable']['documentable_id'];
                                
                                                
		$sql = 'select documenttypes.* from documenttypes where documenttypes.table_name like "'.$documentableType.'%"';
                $connection=Yii::app()->db;
                $command=$connection->createCommand($sql);
                $result=$command->queryAll(); 

                if($result)
                {
                    return  $result[0]["id"] ;
                }
                else
                {                    
                    $model = new DocumentTypes();

                    $newtype["title"] = $documentableType;
                    $newtype["table_name"] = $documentableType;
                    $newtype["primary_id"] = $documentableType;
                    $newtype["createdAt"] = date("Y-m-d H:i:s");
                    $newtype["updatedAt"] = date("Y-m-d H:i:s");      
                     
                    $model->attributes = $newtype;                    
                    $model->save();		
                    return $model->id;
                }
                    
	}
        
        
        public function actionCheck_doc_type_meta($doctypeid)
	{
		$documentableType = $_POST['Documentable']['documentable_type'];
		$documentableId = $_POST['Documentable']['documentable_id'];
                                
                                                
		$sql = 'select documenttypemetas.* from documenttypemetas  where documenttypemetas.documentTypeId = '.$doctypeid;
                $connection=Yii::app()->db;
                $command=$connection->createCommand($sql);
                $result=$command->queryAll(); 

                if(!$result)
                {               
                   // get the metas from any table                                       
                    $sql = 'DESCRIBE '.$documentableType.' ;';
                    
                    $connection=Yii::app()->db;
                    $command=$connection->createCommand($sql);
                    $result=$command->queryAll(); 
                
                    if($result)
                    {                       
                        foreach($result as $meta)
                        {
                            $model = new DocumentTypeMeta();

                            
                            

                            if(preg_match('/int/',$meta["Type"]))
                            $type = "integer";                            
                            elseif(preg_match('/varchar/',$meta["Type"]))
                            $type = "string";    
                            else
                            $type  = $meta["Type"];
                            
                             
                            $newtype["title"] = $documentableType;
                            $newtype["documentTypeId"] = $doctypeid;
                            $newtype["meta_option"] = $meta["Field"];   
                            $newtype["meta_type"] = $type;
                            $newtype["createdAt"] = date("Y-m-d H:i:s");
                            $newtype["updatedAt"] = date("Y-m-d H:i:s");   

                            $model->attributes = $newtype;                    
                            $model->save();                                                       
                        }                                                                    
                    }                                        		                                      
                }
                    
	}
        
        
        
        public function actionUpload_file($doctypeid)
	{
                $model2 = new Document();
                                              
		if(isset($_POST['Document']))
		{                   
			$attributes = $_POST['Document'];

                        $file = CUploadedFile::getInstance($model2,'file');
                        $attributes['fileName']= $file->name;
                        $attributes['mimeType']= $file->type;
                        $attributes['fileSize']= $file->size;
                        $attributes['documentTypeId']= $doctypeid;
                        $model2->attributes = $attributes;
                        $model2->file = CUploadedFile::getInstance($model2,'file');

       
			if($model2->save()){
                        $model2->file->saveAs(Yii::app()->basePath.'/../dms/'.$model2->id);   
                        return $model2->id;
			}                                                
		}            
        }
        
        
        
        
        public function actionSave_doc_meta($docid,$doctypeid)
	{
		$documentableType = $_POST['Documentable']['documentable_type'];
		$documentableId = $_POST['Documentable']['documentable_id'];
                                
                                                
		$sql = 'select documenttypemetas.* from documenttypemetas  where documenttypemetas.documentTypeId = '.$doctypeid;
                $connection=Yii::app()->db;
                $command=$connection->createCommand($sql);
                $result=$command->queryAll(); 

                if($result)
                {                                   
                           
                        foreach($result as $meta)
                        {
                            
                            // get the meta values
                            $sql = 'select * from  '.$documentableType.'  where '.$result[0]['meta_option'].' = '.$documentableId;
                            $connection=Yii::app()->db;
                            $command=$connection->createCommand($sql);
                            $result2=$command->queryAll(); 
                            
                            
                            
                            $model = new DocumentMeta();

                            $newtype["documentId"] = $docid;
                            $newtype["documentTypeMetaId"] = $meta['id'];
                            $newtype["meta_value"] = $result2[0][$meta['meta_option']];                              
                            $newtype["createdAt"] = date("Y-m-d H:i:s");
                            $newtype["updatedAt"] = date("Y-m-d H:i:s");   

                            $model->attributes = $newtype;                    
                            $model->save();                                                       
                        }                                                                    
                                                            		                                      
                }
                    
	}
        
        
        
       public function actionUpload()
        {                 
                      
                $documentableType = $_POST['Documentable']['documentable_type'];
		$documentableId = $_POST['Documentable']['documentable_id'];
                
           //   =========================  check document type
                $doctypeid = $this->actionCheck_doc_type();                                         
           //   ===================================
                
           //   =========================  check document type meta
                $this->actionCheck_doc_type_meta($doctypeid);                                         
           //   ===================================
           
           //   =========================  upload file and get the id           
                $docid = $this->actionUpload_file($doctypeid);                                         
           //   ===================================

           //   =========================  save document metas
                $this->actionSave_doc_meta($docid,$doctypeid);                                         
           //   ===================================
                
                
                
           //  ========================   join document with the documentable
               $model = new Documentable();
               
               $newtype["documentId"] = $docid;
               $newtype["documentable_type"] = $documentableType;
               $newtype["documentable_id"] = $documentableId;                              
               $newtype["createdAt"] = date("Y-m-d H:i:s");
               $newtype["updatedAt"] = date("Y-m-d H:i:s");   

               $model->attributes = $newtype;                    
               $model->save();  

               $this->redirect(Yii::app()->request->baseUrl."/index.php/".$documentableType.'/'.$documentableId);                                           
        }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}