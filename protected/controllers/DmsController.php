<?php

class DmsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        public $relations =array();

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
				'actions'=>array('create','update','search', 'download', 'formDocumentType','get_lands','check_land','scan','upload','process','multipleupload','upload_files','process_docs','get_deeds','add_relation','end_process','get_contracts'),
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

         public function get_db_name()
        {
              $curdb  = explode('=', Yii::app()->db->connectionString);
              return $curdb[2];
        }
        
	

	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{		            
		$this->render('index',array(			
		));
	}

        
        public function actionGet_lands() {

        $term = $_GET['term'];
        $sql = 'select LandID from landmaster where LandID like "'.$term.'%"';

	$connection=Yii::app()->db;
	$command=$connection->createCommand($sql);
	$models=$command->queryAll(); 

        $this->layout = false;
        echo CJSON::encode($models);
        
        }
        
        public function actionCheck_land() {

        $term = $_POST['landid'];
        $sql = 'select LandID from landmaster where LandID = "'.$term.'"';

	$connection=Yii::app()->db;
	$command=$connection->createCommand($sql);
	$models=$command->queryAll(); 

        $this->layout = false;
        
        
        if(!empty($models))
        {
        Yii::app()->session['landid'] = $term;        
        // $sleep = Yii::app()->session['sleep'];
        // unset(Yii::app()->session['sleep']);
        
        echo "true";        
        }
        else
        echo "false";
                             
        }
        
        
        public function actionGet_deeds()
        {
            $deedid =$_POST['landid'];
            $doctype =$_POST['doctype'];
            
            
            $sql = 'select * from deedmaster where LandID = '.$deedid;

                $connection=Yii::app()->db;
                $command=$connection->createCommand($sql);
                $model=$command->queryAll(); 
                            
                $table='deedMaster';     
                $result = "<tr><th></th><th>رقم الملكية</th> <th>تاريخ الملكية</th></tr>";
                
                $i=0;
                foreach($model as $row)
                {                              
                   $result .= "<tr><td><input type='radio' name='deed' onclick='choose_deed(".$row['DeedID'].",\"".$table."\",\"".$doctype."\")' /></td><td>".$row['DeedID']."</td><td>".$row['DateCreated']."</td></tr>";    
                   $i++;
                }

            if($i==0)
            $result = "<tr><th>لا توجد ملكيات متوفرة</th></tr>";
            
            print $result;
        }
        
        
        
        public function actionGet_contracts()
        {
            $landid =$_POST['landid'];
            $doctype =$_POST['doctype'];
            
            
                $sql = 'select * from contractsmaster where LandID = '.$landid;

                $connection=Yii::app()->db;
                $command=$connection->createCommand($sql);
                $model=$command->queryAll(); 
                            
                $table='contractsMaster';     
                $result = "<tr><th></th><th>رقم العقد</th> <th>تاريخ العقد</th></tr>";
                $i=0;
                foreach($model as $row)
                {                              
                   $result .= "<tr><td><input type='radio' name='deed' onclick='choose_deed(".$row['ContractsID'].",\"".$table."\",\"".$doctype."\")' /></td><td>".$row['ContractsID']."</td><td>".$row['DateCreated']."</td></tr>";    
                   $i++;
                }

            if($i==0)
                $result = "<tr><th>لا يوجد عقود متوفرة</th></tr>";
            print $result;
        }
        
        
        public function actionAdd_relation()
        {
            $tablename  = $_POST['table_name'];
            $id         = $_POST['id'];
            $file_name  = $_POST['file_name'];
            $doc_type   = $_POST['doc_type'];
                        
            $relation = Yii::app()->session['relation'];            
            $relations = $relation;            
            $relations[$tablename][$file_name] = $id ."-".$doc_type ;            
            Yii::app()->session['relation'] = $relations;            
            
            
            print_r($relations);
        }
        
            
        private function actionmime_content_type($filename) {

           
        $mime_types = array(

            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',

            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

       // $ext = strtolower(array_pop(explode('.',$filename)));      
        $arr = explode('.',strtolower($filename));
        $ext =    $arr[1];    
                    
                    
        if (array_key_exists($ext, $mime_types)) {            
            return $mime_types[$ext];            
        }        
        else {
            return 'application/octet-stream';
        }
    }
    
    
        public function actionEnd_process() {
            
            $relation = Yii::app()->session['relation'];  
            $landid   = Yii::app()->session['landid'];
            $table_name = "";
            
            if(!file_exists("dms/".$landid))
            mkdir("dms/".$landid);
            
                                          
            foreach($relation as $table => $value)                
                foreach($value as $image => $doctype_id)
                    {
                
                 
                    $arr = explode('-', $doctype_id);                    
                    $id      =    $arr[0];             
                    $doctype =    $arr[1];     
                    
                // ===========  get the table name                   
                    $doctype_title = "";
                    $sql = 'select * from documenttypes where id = '.$doctype;
                    $connection=Yii::app()->db;
                    $command=$connection->createCommand($sql);
                    $doc_type_table=$command->queryAll();
                    foreach($doc_type_table as $row)
                    {                                               
                        $doctype_title = $row['title'];
                        $table_name = $row['table_name'];
                    }
                    
                // =========== get primary id 
                    $primary_table_id= "";
                    $database = $this->get_db_name();
                    $sql = 'SELECT k.column_name
                            FROM information_schema.table_constraints t
                            JOIN information_schema.key_column_usage k
                            USING(constraint_name,table_schema,table_name)
                            WHERE t.constraint_type=\'PRIMARY KEY\'
                            AND t.table_schema=\''.$database.'\'
                            AND t.table_name=\''.$table_name.'\';';
                            
                    $connection=Yii::app()->db;
                    $command=$connection->createCommand($sql);
                    $primary_id=$command->queryAll();
                    
                    foreach($primary_id as $row)
                    {
                        $primary_table_id = $row['column_name'];
                    }
                    
                    
                // ===========  get document meta type records            
                    $sql = 'select * from documenttypemetas where documentTypeId = '.$doctype;
                    $connection=Yii::app()->db;
                    $command=$connection->createCommand($sql);
                    $doctypemeta=$command->queryAll(); 
                
                // =========== save new record in document table
                    $newdoc = new Document;    
                                             
                    $attributes['title']= $image;
                    $attributes['documentTypeId']= $doctype;
                    $attributes['fileName']= $landid.'/'.$image;                    
                    $attributes['mimeType']= $this->actionmime_content_type($image);                  
                    $attributes['fileSize']= filesize( "dms/".Yii::app()->user->ID."/".$image );                     
                    $newdoc->attributes=$attributes;                                        
                    
                    if($newdoc->insert()){                        
                        // move from the folder name of user to the new folder 
                        if (copy("dms/".Yii::app()->user->ID."/".$image,"dms/".$landid."/".$image)) {                            
                            unlink("dms/".Yii::app()->user->ID."/".$image);
                        }                                                
                    }
                   
                   
               // =========== get the information of the table record that document should connect with                    
                    $sql = 'select * from '.$table.' where '.$primary_table_id.' = '.$id;
                    $connection=Yii::app()->db;
                    $command=$connection->createCommand($sql);
                    $table_info=$command->queryAll(); 
                   
              // ============ save in document meta 
                    foreach($doctypemeta as $roww)
                    {
                        $docmeta = new DocumentMeta();
                        $attributes2['documentId']= $newdoc->id;
                        $attributes2['documentTypeMetaId']= $roww['id'];
                        $attributes2['meta_value']= $table_info[0][$roww['meta_option']];
                        $attributes2['createdAt']= date("Y-m-d H:i:s");
                        $attributes2['updatedAt']= date("Y-m-d H:i:s");   
                        $docmeta->attributes=$attributes2;
                        $docmeta->insert();
                    }
                      
                // =========== save in documentable table 
                        $documentable = new Documentable();
                        $attributes3['documentId']= $newdoc->id;
                        $attributes3['documentable_type']= $doctype_title;
                        $attributes3['documentable_id']= $id;
                        $attributes3['createdAt']= date("Y-m-d H:i:s");
                        $attributes3['updatedAt']= date("Y-m-d H:i:s");  
                        $documentable->attributes=$attributes3;
                        $documentable->insert();
                                                               
                    }
            
            unset(Yii::app()->session['relation']);
            $this->actionIndex();
             
        }
        
        public function actionScan() {
            $this->render('scan_docs',array());
        }
        
        
        public function actionUpload() {                               
                $sql = 'select * from filesetting;';
                $connection=Yii::app()->db;
                $command=$connection->createCommand($sql);
                $result=$command->queryAll();
                
                $filetypes =  $result[0]['file_types'];
                $filesize =  $result[0]['file_size'];
                
                $this->render('upload_docs',array('filetypes'=>$filetypes,'filesize'=>$filesize));            
        }
        
    
        public function actionProcess_docs() {                                     
            $this->render('proc_docs',array());            
        }
                
        public function actionProcess($id=0) {                        
            $sql = 'select * from documenttypes;';

            $connection=Yii::app()->db;
            $command=$connection->createCommand($sql);
            $model=$command->queryAll(); 
                               
            
            $this->renderPartial('process_docs',array('id'=>$id , 'filetypes' =>$model));            
        }
        
        
        
        public function actionMultipleupload($id=0) {       
                                               
            if(!file_exists("dms/".Yii::app()->user->ID))
            mkdir("dms/".Yii::app()->user->ID);
            
            
            foreach ($_FILES["files"]["error"] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {                    
                    move_uploaded_file(
                      $_FILES["files"]["tmp_name"][$key], 
                      "dms/".Yii::app()->user->ID.'/'.$_FILES["files"]["name"][$key] 
                    ) or die("Problems with upload");
                }
             }
                                                
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
