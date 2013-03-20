<?php

class DocumentMasterController extends  Controller
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
        public function allowedActions()
        { return 'index, uploadify'; }
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
 /**
 * Add the record of Owner to the Deeddetails and data row provided in request
 * if the Owner not exist in the customer table will add new customer first before creaing assosiation
 * @param JSON string $formdata Array of files records
 * @return Json formated string , contains status zero 
 */       
        public function actionAddOwner() 
        {
                extract($_POST);
            $res=0; $shareID=0;$customerID=0;
            
           $result = CustomerMaster::model()->findByAttributes(array('CustomerNameArabic'=>$ArabicName));

            
             if( count($result)<1){
                 $customerMaster = new CustomerMaster;
                $customerMaster->CustomerNameArabic = $ArabicName;
                $customerMaster->Nationality = $Nationality;
                $customerMaster->save();
                $customerID = $customerMaster->CustomerID;
             }else{ $customerID = $result->CustomerID;}

              $resultDeed = DeedDetails::model()->findByAttributes(array('CustomerID'=>$customerID, 'DeedID'=>$deedID));
                    if( count($resultDeed)<1){
                    $deedDtails = new DeedDetails;
                    $deedDtails->CustomerID=$customerID;
                    $deedDtails->DeedID=$deedID;
                    $deedDtails->Share = $Share;
                    if($deedDtails->save()) $res=1;
                    $shareID = $deedDtails->DeedDetailsID;
                }

            print CJSON::encode(array("result"=>$res, "customerID"=>$customerID , "shareID"=>$shareID ));
        }
/**
 * Add the record of File and data row provided in request
 * @param JSON string $formdata Array of files records
 * @return Json formated string , contains status zero 
 */
        public function actionAddFile()
        {
            
           $formData = CJSON::decode(stripslashes($_POST['formData']));
           $fileData = CJSON::decode($formData["fileData"]);
            $res=0;

            if(count($fileData)>0 and is_array($fileData)){
                    foreach ($fileData as $imageFile) {

                            $file = new FileMaster();
                            $file->Type = "deed";
                             $file->LandID = $formData["landID"];
                             $file->DeedID = $formData["deedID"];
                             $file->DateCreated = date('Y-m-d');
                             $file->Title = $imageFile["fileName"];
                             $file->Image = $imageFile["imageName"];
                                if($file->save()) $res=1;
                                   else  print_r( $file->getErrors() );
                    }    
            
            }else print "Files not found";
           print CJSON::encode($res);
        }

        public function actionAddHajaz() 
        {
                extract($_POST);
            $res=0;
            $HajzMaster = new HajzMaster;
                $HajzMaster->LandID = $_LandID ; 
                $HajzMaster->DeedID = $_DeedID ; 
                $HajzMaster->Remarks = $Remarks ; 
                $HajzMaster->Type = $Type ; 
                $HajzMaster->TypeDetail = $TypeDetail ; 
                $HajzMaster->DateCreated = $DateCreated ; 
                $HajzMaster->AmountMortgaged = $AmountMortgaged ; 

            $HajzMaster->IsActive = $IsActive;
            if($HajzMaster->save()) $res=1;
             
            print CJSON::encode(array("HajzID"=>$HajzMaster->HajzID,"result"=>$res ));
        }
/**
 * Add the record of Deed and all and data provided in request
 * @return Json formated string , contains status zero on failuar or 1 on sucess and deed ID
 */
        public function actionAddDeed() 
        {

              $formData = CJSON::decode(stripslashes($_POST['formData']));
              extract($formData);
            $res=0;
            $DeedMaster = new DeedMaster;
            $DeedMaster->LandID = $LandID ; 
            $DeedMaster->Remarks = $Type ; 
            $DeedMaster->DateCreated = $DateCreated ; 
              if($DeedMaster->save()) $res=1;
             
            print CJSON::encode(array("DeedID"=>$DeedMaster->DeedID,"result"=>$res ));
        }
/**
 * Delete the record of Deed details and all the assosiations in the Deed detils with ID of deed row provided in request
 * @return Json formated string , contains status zero on failuar or 1 on sucess
 */
        public function actionDeleteOwner() 
        {
                extract($_POST);
            $res=0;
            $searchCriteria=new CDbCriteria;
            print $query = "delete from `DeedDetails` where `DeedID`='$deedID'  AND  CustomerID = '$customerID'";
            $command =Yii::app()->db->createCommand($query);
            
            if($command->execute()) $res=1;

            
            print CJSON::encode($res);
        }
/**
 * Delete the record of Fine and all the assosiations in the Deed detils with ID of fine row provided in request
 * @return Json formated string , contains status zero on failuar or 1 on sucess
 */
        public function actionDeleteFine() 
        {
                extract($_POST);
            $res=0;
            $searchCriteria=new CDbCriteria;
            $query = "Delete From `HajzMaster` where `HajzID`='$HajzID'";
            $command =Yii::app()->db->createCommand($query);
            
            if($command->execute()) $res=1;
            print CJSON::encode($res);
        }
/**
 * Delete the record of Deed and all the assosiations in the Deed detils with ID of deed row provided in request
 * @return Json formated string , contains status zero on failuar or 1 on sucess
 */
        public function actionDeleteDeed() 
        {
            $formData = CJSON::decode(stripslashes($_POST['formData']));
            extract($formData);
            $res=0;
            
             $query = "Delete From `DeedDetails` where `DeedID`='$deedID'";
            $command =Yii::app()->db->createCommand($query);
            
            if($command->execute()) {
                $searchCriteria=new CDbCriteria;
                 $query = "Delete From `DeedMaster` where `DeedID`='$deedID'";
                $command =Yii::app()->db->createCommand($query);

                if($command->execute()) $res=1;
            
            }
            print CJSON::encode($res);
        }
/**
 * Update the Fine status with ID of image row provided in request
 * @return Json formated string , contains status zero on failuar or 1 on sucess
 */
        public function actionChangeActive() 
        {
            $formData = CJSON::decode(stripslashes($_POST['formData']));

            extract($formData);
            $res=0;
             $HajazMaster=  HajzMaster::model()->findByPk($FineID);
             $HajazMaster->IsActive = $FineStatus;
              if($HajazMaster->save()) $res=1;
                else print_r( $HajazMaster->getErrors() );
            print CJSON::encode($res);
           
        }
/**
 * Delete the record of file with ID of image row provided in request
 * @return Json formated string , contains status zero on failuar or 1 on sucess
 */
        public function actionDeleteFile() 
        {
                extract($_POST);
            $res=0;

            $res = FileMaster::model()->findByAttributes(array('FileID'=>$FileID));
            $pathToFile = Yii::app()->basePath."/../images/uploads/";
            $fileToDelete = $res->Image;
            print "path and file is".$pathToFile.$fileToDelete;
            unlink($pathToFile.$fileToDelete) or die("File not deleted");
            print $query = "Delete From `filemaster` where `FileID`='$FileID'";//AND  LandID = '$LandID'
            $command =Yii::app()->db->createCommand($query);
            
            if($command->execute()) $res=1;
            print CJSON::encode($res);
        }
/**
 * Update the caption/title of the image againts the ID of image row provided in request
 * @return Json formated string , contains status zero on failuar or 1 on sucess
 */
        public function actionUpdateImageCaption() 
        {
                extract($_POST);
            $res=0;
            

             $fileMaster=  FileMaster::model()->findByPk($id);
             $fileMaster->Title = $caption;
              if($fileMaster->save()) $res=1;
                else print_r( $fileMaster->getErrors() );
            print CJSON::encode($res);
        }
/**
 * Update he deed date and rmakrs in DeedMaster 
 * delete all the entries assosiation between deeds and owners in deedDetails 
 * Add the new records of owner assosiated to the deed
 * @return Json formated string , contains status zero on failuar or 1 on sucess
 */
        public function actionUpdateLandOwnerShare() 
        {
            
            $formData = CJSON::decode(stripslashes($_POST['formData']));
             $shareData = CJSON::decode($formData['shareData']);

             $_DeedID = $formData['deedID'];
             $_DateCreated = $formData['DateCreated'];
             $_Remarks = $formData['Remarks'];
             

                        $DeedMaster=DeedMaster::model()->findByPk($_DeedID);
                        $DeedMaster->DateCreated = $_DateCreated ; 
                        $DeedMaster->Remarks = $_Remarks ; 
                         if($DeedMaster->save()) $res=1;
                                       else  print_r( $DeedMaster->getErrors() );
             
            DeedDetails::model()->deleteAllByAttributes(array("DeedID"=>$formData['deedID']));
            $res=0;

            if(count($shareData)>0 and is_array($shareData)){
                    foreach ($shareData as $shareRow) {
                        $DeedDetails = new DeedDetails;
                        $DeedDetails->CustomerID = $shareRow["CustomerID"] ; 
                        $DeedDetails->DeedID = $_DeedID ; 
                        $DeedDetails->Share = $shareRow["sharePercentage"]    ; 
                                    if($DeedDetails->save()) $res=1;
                                       else  print_r( $DeedDetails->getErrors() );
                    }    
            
            }else print "ShareData not found";
           print CJSON::encode($res);

        }
/**
 * mark the deedmaster tables ArchieveUpdate fieled updated to the ID provided in request
 */
        public function actionMarkUpdated() 
        {
                extract($_POST);
            $res=0;
            $searchCriteria=new CDbCriteria;
             $deedMaster= DeedMaster::model()->findByPk($DeedID);
              $deedMaster->ArchiveUpdate = True;
             if($deedMaster->save()) $res=1;
            
            print CJSON::encode($res);
        }
/**
 * Update the LAND data to the LandMaster table with the ID provided in the request.
 * @return JSON zero on failuar or 1 on sucess 
 */
        public function actionUpdateLandData() 
        {
            $res = "0";
           extract($_POST);

                $landDetails=LandMaster::model()->findByPk($LandID);
                $landDetails->Plot_No = $Plot_No ; 
                $landDetails->Piece = $Piece ; 
                $landDetails->location = $location ; 
                $landDetails->Land_Type = $Land_Type ; 
                $landDetails->TotalArea = $TotalArea ; 
                $landDetails->length = $length ; 
                $landDetails->width = $width ; 
                $landDetails->Remarks = $Remarks ; 
                $landDetails->North = $North ; 
                $landDetails->South = $South ; 
                $landDetails->East = $East ; 
                $landDetails->West = $West;

                 if($landDetails->save()) $res=1;
            print CJSON::encode($res);
        }
/**
 *  Find the land from land table having the search string provided in request
 * @return json formated string, contains land IDs
 * 
 */
        public function actionCustomerSearch()	
        {// for autocomplete will do DB search for Customers and Lands
		
		if (isset($_GET['term'])) { // first search that 
                // if user arabic name 
                // or english name 
                // or miobile number match
                    
                               
                                $keyword = $_GET["term"];

                               $searchCriteria=new CDbCriteria;
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


//			$qtxt = 'SELECT CustomerID, Nationality, CustomerNameArabic from CustomerMaster WHERE ('.$strCondition.' OR CustomerNameEnglish LIKE :name OR MobilePhone Like :name) limit 25';
//			$command = Yii::app()->db->createCommand($qtxt);
//			$command->bindValue(':name','%'.$_GET['term'].'%',PDO::PARAM_STR);
//			$res = $command->queryAll();
//                           if( count($res)<1){//run if no customer found 
                           //search DB if Land ID matches

                                    $qtxt = 'SELECT LandID lnd from LandMaster WHERE LandID Like :name';
                                    $command = Yii::app()->db->createCommand($qtxt);
                                    $command->bindValue(':name','%'.$_GET['term'].'%',PDO::PARAM_STR);
                                    $res = $command->queryColumn();

//                            }
		}
		print CJSON::encode($res);
                
            // die ($strCondition);
	}
   

/**
 * not in use, may be used in future 
 */
        public function actionpSearchProperty()	{// method not in use 
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
