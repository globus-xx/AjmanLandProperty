<?php

class LettersController extends Controller
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
				'actions'=>array('index','Search'),
				'users'=>array('@'),
			),
                    array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','autow'),
				'users'=>array('@'),
			),
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','update'),
				'users'=>array('@'),
			),
                    array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','doupdate'),
				'users'=>array('@'),
			),
                    
                    array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','letterupdate'),
				'users'=>array('@'),
			),
                    
                    array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','choose'),
				'users'=>array('@'),
			),
                    
                     array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','lettersave'),
				'users'=>array('@'),
			),
                    
                    array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','downloadletter'),
				'users'=>array('@'),
			),
                    
                    array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','updateletter'),
				'users'=>array('@'),
			),
                    
                     array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','convert'),
				'users'=>array('@'),
			),
                    
                    array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','generatefile'),
				'users'=>array('@'),
			),
                    array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','gosave'),
				'users'=>array('@'),
			),
                    
                    
                     array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','open'),
				'users'=>array('@'),
			),
                    
                    array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','viewExportedLetters'),
				'users'=>array('@'),
			),
                    
                     array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','download'),
				'users'=>array('@'),
			),
                    
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','delete'),
				'users'=>array('@'),
			),
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','temp'),
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
            
            
            $criteria = new CDbCriteria;            		
            $items = Letters::model()->findAll($criteria);

            
            
            
		$this->render('choosetype',array(
			'item'=>$items,
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
			$searchCriteria->order = 'CustomerNameArabic';
		
			if (CustomerMaster::model()->count($searchCriteria)>0)
	        {
				$customerResult = CustomerMaster::model()->findAll($searchCriteria);
                                
                                $customerPropertyResult = "123";//LandMaster::model()->findAllByAttributes(array("LandID"=>$customerResult[0]["CustomerID"]));
                                $customerResult[0]->customerResultProperty = $customerPropertyResult;
//                                   $customerResult[0]["customerResultProperty"] = $customerPropertyResult;
                                print_r($customerResult[0]);
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
        
        
        
        
        public function actionSearchProperty()
	{
		if(isset($_POST["data"])) //check that this action is only called using POST.. not get, not regular.
        {
			$searchstring = json_decode($_POST["data"]); 
			//$searchstring = "%".$searchstring . "%"; 
			
			$searchCriteria=new CDbCriteria;
			$searchCriteria->condition = 'CustomerNameArabic LIKE :searchstring OR MobilePhone LIKE :searchstring OR Nationality LIKE :searchstring';
			$searchCriteria->params = array(':searchstring'=> $searchstring);
			$searchCriteria->order = 'CustomerNameArabic';
		
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
        
        public function actionTemp()
	{       
            
//         $dataProvider=new CActiveDataProvider('Letters');            
//		$this->render('template',array(
//			'dataProvider'=>$dataProvider,
//		));
		
          /*  
                $model=new Letters('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Letters']))
			$model->attributes=$_GET['Letters'];
*/
                
            $criteria = new CDbCriteria;            		
            $items = Letters::model()->findAll($criteria);

            $criteria2 = new CDbCriteria;            		
            $exported= Exportedletters::model()->findAll($criteria2);
            
            
            $criteria3 = new CDbCriteria;            		
            $destination= Destination::model()->findAll($criteria3);
            
		$this->render('template',array(
			'item'=>$items,'lettersgenerated'=>$exported,'destinations'=>$destination
		));      
                
                
            
//            $this->render('view',array(
//			'model'=>$this->loadModel(1),
//		));
			
//            $this->render('template');
        }
        
        public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        
        public function actionUpdate($id)
	{
		//$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

//		if(isset($_POST['Letters']))
//		{
//			$model->attributes=$_POST['Letters'];
//			if($model->save())
//				$this->redirect(array('view','id'=>$model->LetterID));
//		}
                       

            $criteria = new CDbCriteria;
            $criteria->condition = "`LetterID` = $id";
		
            $items = Letters::model()->findAll($criteria);

            foreach ($items as $item)            
            {
                $idd=$item->LetterID;
                $title=$item->Title;
                $text=$item->LetterText;                
            }
               
		$this->render('update',array(
			'text'=>$text,'id'=>$idd,'title'=>$title
		));
	}
        
        
        
            public function actionupdateletter()
	{
		if(isset($_POST['ftext']))
                 $lettertext=$_POST['ftext'];  
                
                $title=$_POST['title'];  
                
		$this->render('updateletter',array(
			'text'=>$lettertext,'title'=>$title
		));
                                                
	}
        
     
        
        public function actionchoose()
	{
            $type=$_POST['mtype'];
                                                            
            
            $this->render("insertvalues" ,array(
			'id'=>$type
		));                          
        }
        
        
        public function actiongeneratefile()
	{                                                                                              
                                                                       
           $destination="";
           
           $error=0;
           $str="";
           $errormes="";
           $landprice="";  
           
           $location="";
           $plotno="";
           $peice="";
           
           $buydate="no date";
           
           
           $prevcusname="";
           $prevcusnationality="";
           $prevcusdoctype="";
           $prevcusdocnum="";
           
            $currentcusname="";
            $currentcusnationality="";
            $currentcusdoctype="";
            $currentcusdocnum="";
            
            $currentowners="no owners";            
            $previousowners="no owners";
            
            $landdesc="no description";
                   
            $id=$_POST['letterid'];                        
            $landid=$_POST['landid'];                      
            $destination=$_POST['destination'];
            $landprice=$_POST['landprice'];
            
            if(isset($_POST['landdesc']))
            {
            $landdesc=$_POST['landdesc'];
            }
         
            if(isset($_POST['cuowners']))
            {
               $current=$_POST['cuowners'];
            }
            
            
            if(isset($_POST['prowners']))
            {
               $previos=$_POST['prowners'];
            }
            
            if(isset($_POST['lands']))
            {
               $landids=$_POST['lands'];
            }
          
          
                                      
                                      
                                       // The previous Owner information     
                                       if(isset($previos[0]))
                                       {
                                                                                                                                 
                                      $searchCriteria=new CDbCriteria;  
                                      $g=0;
                                      
                                      foreach($previos as $owns)
                                      {
                                          
                                                $go=$owns;
                                                                                                                                             
                                                $searchCriteria->condition = "`CustomerID` =  $go";                                                                    
                                                $customer = CustomerMaster::model()->findAll($searchCriteria);

                                                $prevcusname=$customer[0]->CustomerNameArabic;
                                                $prevcusnationality=$customer[0]->Nationality;
                                                $prevcusdoctype=$customer[0]->DocumentType;
                                                $prevcusdocnum=$customer[0]->DocumentNumber;
                                                
                                                if($prevcusnationality=="")
                                                {
                                                    $prevcusnationality="no nationality";
                                                }
                                                else if($prevcusdoctype=="")
                                                {
                                                    $prevcusdoctype="no document type";
                                                }
                                                else if($prevcusdocnum=="")
                                                {
                                                    $prevcusdocnum="no document number";
                                                }
                                                
                                                
                                                  if($g==0)
                                                    $previousowners=$prevcusname." (".$prevcusnationality.") "."بموجب ". $prevcusdoctype."  رقم ".$prevcusdocnum;
                                                    else
                                                    $previousowners.=" و ".$prevcusname." (".$prevcusnationality.") "."بموجب ". $prevcusdoctype."  رقم ".$prevcusdocnum;

                                                    $g++;
                                                
                                       }
                                       
                                       }
                                       else
                                          $previousowners="no previous owners";
                                       
                                       
                                       
                                       
                                      

                                       
                                       // The lands owned by a customer     
                                       if(isset($landids[0]))
                                       {
                                                                                                                                 
                                      $searchCriteria=new CDbCriteria;  
                                      $landstable="<table style='min-width:400px;'><tr><td>سند ملك </td> <td>المنطقة</td><td>الحوض</td><td>رقم القطعة</td></tr>";
                                      
                                      
                                      foreach($landids as $landowns)
                                      {
                                          
                                                $go=$landowns;
                                                                                                                                             
                                                $searchCriteria->condition = "`LandID` =  '$go'";                                                                    
                                                $items = LandMaster::model()->findAll($searchCriteria);

                                                $location=$items[0]->location;
                                                $plotno=$items[0]->Plot_No;
                                                $peice=$items[0]->Piece;
                                                
                                                
                                                if($location=="")
                                                {
                                                    $location="no location";
                                                }
                                                else if($plotno=="")
                                                {
                                                    $plotno="no plot number";
                                                }
                                                else if($peice=="")
                                                {
                                                    $peice="no peice";
                                                }
                                                
                                                
                                                  
                                                    $landstable.="<tr ><td style='border:1px solid #000000'>".$landowns."</td><td style='border:1px solid #000000'>".$location."</td><td style='border:1px solid #000000'>".$plotno."</td><td style='border:1px solid #000000'>".$peice."</td></tr>";                                                                                                     
                                                
                                       }
                                       
                                       $landstable.="</table>";
                                       
                                       }
                                       else
                                          $landstable="no lands owned";
                                        
                                       
                                       

                                      $deeds =DeedMaster::model()->findAllByAttributes(array(),$condition  = 'LandID = :landid AND Remarks <> :remarks',
                                              $params     = array(
                                                ':landid' => $landid, 
                                                ':remarks' => 'cancelled',
                                                   )
                                              ); 
                                      
                                     
                                      
                                       if(isset($deeds[0]->DeedID))
                                       {                                                                                                                             
                                         if(isset($deeds[0]->ContractID))
                                          {
                                               $contractMaster = ContractsMaster::model()->findAllByAttributes(array("ContractsID"=>$deeds[0]->ContractID));                                              
                                               $landprice=$contractMaster[0]->AmountCorrected; 
                                               $buydate=$contractMaster[0]->DateCreated;                                              
                                          }                                          
                                       }  
                                     
                                      
                                      
                                       if(isset($current[0]))
                                       {
                                     
                                      // The current Owner information  
                                      $g=0;
                                      $searchCriteria=new CDbCriteria;
                                          
                                      foreach($current as $owns)
                                      {
                                          
                                          
                                       $go=$owns;
                                                                             
                                      
                                       $searchCriteria->condition = "`CustomerID` =  $go";                                                                    
                                       $customer = CustomerMaster::model()->findAll($searchCriteria);
                                       
                                       $currentcusname=$customer[0]->CustomerNameArabic;
                                       $currentcusnationality=$customer[0]->Nationality;
                                       $currentcusdoctype=$customer[0]->DocumentType;
                                       $currentcusdocnum=$customer[0]->DocumentNumber;
                                       
                                                if($currentcusnationality=="")
                                                {
                                                    $currentcusnationality="no nationality";
                                                }
                                                else if($currentcusdoctype=="")
                                                {
                                                    $currentcusdoctype="no document type";
                                                }
                                                else if($currentcusdocnum=="")
                                                {
                                                    $currentcusdocnum="no document number";
                                                }
                                                                                                                                                        
                                          if($g==0)
                                          $currentowners=$currentcusname." (".$currentcusnationality.") "."بموجب ". $currentcusdoctype."  رقم ".$currentcusdocnum;
                                          else
                                          $currentowners.=" و ".$currentcusname." (".$currentcusnationality.") "."بموجب ". $currentcusdoctype."  رقم ".$currentcusdocnum;
                                          
                                          $g++;
                                      }
                                      
                                      
                                        }
                                        else if(isset($_POST['customerid']))
                                        {
                                            $customeridnumber=$_POST['customerid'];
                                            
                                             
                                             $searchCriteria=new CDbCriteria;
                                             $searchCriteria->condition = "`CustomerID` =  $customeridnumber";                                                                    
                                             $customer = CustomerMaster::model()->findAll($searchCriteria);
                                             
                                                $currentcusname=$customer[0]->CustomerNameArabic;
                                                $currentcusnationality=$customer[0]->Nationality;
                                                $currentcusdoctype=$customer[0]->DocumentType;
                                                $currentcusdocnum=$customer[0]->DocumentNumber;
                                                
                                               if($currentcusnationality=="")
                                                {
                                                    $currentcusnationality="no nationality";
                                                }
                                                else if($currentcusdoctype=="")
                                                {
                                                    $currentcusdoctype="no document type";
                                                }
                                                else if($currentcusdocnum=="")
                                                {
                                                    $currentcusdocnum="no document number";
                                                }
                                        
                                                $currentowners=$currentcusname." (".$currentcusnationality.") "."بموجب ". $currentcusdoctype."  رقم ".$currentcusdocnum;
                                        }
                                       else
                                            $currentowners="no current owners";


                                      
                                      
                                       
                                       // The Land information                                                   
                                       $criteria=new CDbCriteria;                                                 
                                       $criteria->condition = "`LandID` = '$landid'";		
                                       $items = LandMaster::model()->findAll($criteria);
          
                                        foreach ($items as $item)            
                                         {             
                                           $location=$item->location;
                                           $plotno=$item->Plot_No;              
                                           $peice=$item->Piece;
                                         } 

                                      
                                      
                                       // The Letter information 
                                       
                                            $criteria->condition = "`LetterID` = $id";		
                                            $items = Letters::model()->findAll($criteria);

                                            foreach ($items as $item)            
                                            {
                                                $text=$item->LetterText;
                                                $idd=$item->LetterID; 
                                                $title=$item->Title; 
                                            }
                                            
                                        
                                            
                                    // generate number for letterid
                                            $maxOrderNumber = Yii::app()->db->createCommand()
                                                ->select('max(ExportedletterID) as max')
                                                ->from('Exportedletters')
                                                ->queryScalar();
                                              $somevariable = $maxOrderNumber ;
                                            
                                          
                                            $idmax=$somevariable;                                          
                                            $idmax=$idmax+1;  
                                            
                                              $username="";
                                              $represent="";
                                              
                                            $username=Yii::app()->user->name;
                                           
                                            
                                            
                                            if($username=="admin")
                                                $represent="01";
                                            
                                            else if($username=="yalshamsi")
                                                $represent="02";
                                            
                                            else if($username=="akheir")
                                                $represent="03";
                                          
                                                                                                                                                                                                                                                                    
                                                
                                            $letternumber="LPDCS/".$represent."/".$idmax;
                                            
                                            
                                            
                                            
                                            
                                            
                                            if($landprice=="")
                                            {                                               
                                                $landprice="NO AMOUNT";                                                
                                            }
                                            
                                            
                                            // replace the data in the message
                                              $str = str_replace("curowner", $currentcusname, $text); 
                                              $str = str_replace("cnationality", $currentcusnationality, $str); 
                                              $str = str_replace("cdoctype", $currentcusdoctype, $str); 
                                              $str = str_replace("cdocnum", $currentcusdocnum, $str); 
                                             
                                              $str = str_replace("ogroup", $currentowners, $str); 
                                              $str = str_replace("pgroup", $previousowners, $str);
                                              
                                              $str = str_replace("prevowner", $prevcusname, $str); 
                                              $str = str_replace("pnationality", $prevcusnationality, $str); 
                                              $str = str_replace("pdoctype", $prevcusdoctype, $str); 
                                              $str = str_replace("pdocnum", $prevcusdocnum, $str); 
                                              
                                              
                                              $str = str_replace("landid", $landid, $str);
                                              $str = str_replace("location", $location, $str);
                                              $str = str_replace("plotnum", $plotno, $str);
                                              $str = str_replace("peice", $peice, $str);
                                              $str = str_replace("landprice", $landprice, $str);
                                              $str = str_replace("buydate", $buydate, $str);
                                              
                                              $str = str_replace("destination", $destination, $str);
                                              $str = str_replace("tdate", date("j/ n/ Y"), $str);
                                              
                                              $str = str_replace("letterid", $letternumber, $str);
                                              $str = str_replace("employeename", $username, $str);
                                              $str = str_replace("landdesc", $landdesc, $str);
                                              $str = str_replace("landtable", $landstable, $str);
                                     
                                       
    
//echo $str;  


                                                      
//                                            $result=  $this->render("word" ,array(
//                                                            'lettertext'=>$str,'errormes'=>$errormes
//                                                    ));
                                            
                                            
                                            $this->renderPartial("word", array(
                                                            'lettertext'=>$str,'errormes'=>$errormes,'title'=>$title
                                                ));
                                            
                                          //  print $result;
//                                              
//                                              
//                                                $this->redirect( array('word'));
            
                
        }
        
        
        
        public function actionautow()
	{
		$res3 = array();
		
		if (isset($_GET['term'])) {
			$qtxt = 'SELECT DestinationName from destination WHERE DestinationName LIKE :name';
			$command = Yii::app()->db->createCommand($qtxt);
			$command->bindValue(':name','%'.$_GET['term'].'%',PDO::PARAM_STR);
			$res1 = $command->queryColumn();
			
//			$qtxt = 'SELECT Name from RealEstatePeople WHERE Name LIKE :name';
//			$command = Yii::app()->db->createCommand($qtxt);
//			$command->bindValue(':name','%'.$_GET['term'].'%',PDO::PARAM_STR);
//			$res2 = $command->queryColumn();
//			
//			foreach ($res2 as $r)
//			{	$res3[] = $r." * "; }
			
		}
		$res = array_merge($res1,$res3);
		print CJSON::encode($res);
	}
        
        
        
        public function actionDelete($id)
	{		
                $post=Letters::model()->findByPk($id); // assuming there is a post whose ID is 10
                $post->delete(); // delete the row from the database table
                
                
                 $this->redirect(array('temp'));
                
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser                                
//		if(!isset($_GET['ajax']))
//			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
        
        
        public function loadModel($id)
	{
            
		$model=Letters::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        
        public function actionconvert($id)
	{
         
/*
        // Here we define query conditions.
        $criteria = new CDbCriteria;
        $criteria->condition = "`LetterID` = $id";
		
        $items = Letters::model()->findAll($criteria);

        foreach ($items as $item)            
           $text=$item->LetterText;
        
*/		
		
		// Include the PHPWord.php, all other classes were loaded by an autoloader
require_once '/../../../PHPWord.php';

// Create a new PHPWord Object
$PHPWord = new PHPWord();

// Every element you want to append to the word document is placed in a section. So you need a section:
$section = $PHPWord->createSection();

// After creating a section, you can append elements:
$section->addText('Hello world!');

// You can directly style your text by giving the addText function an array:
$section->addText('Hello world! I am formatted.', array('name'=>'Tahoma', 'size'=>16, 'bold'=>true));

// If you often need the same style again you can create a user defined style to the word document
// and give the addText function the name of the style:
$PHPWord->addFontStyle('myOwnStyle', array('name'=>'Verdana', 'size'=>14, 'color'=>'1B2232'));
$section->addText('Hello world! I am formatted by a user defined style', 'myOwnStyle');

// You can also putthe appended element to local object an call functions like this:
$myTextElement = $section->addText('Hello World!');
$myTextElement->setBold();
$myTextElement->setName('Verdana');
$myTextElement->setSize(22);

// At least write the document to webspace:
$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
$objWriter->save('helloWorld.docx');


//		  $this->render('convert');


	}
        
        public function actionopen($id)
	{
            $criteria = new CDbCriteria;
            $criteria->condition = "`LetterID` = $id";
		
            $items = Letters::model()->findAll($criteria);

            foreach ($items as $item)            
            {
                $text=$item->LetterText;
                $idd=$item->LetterID;                
            }
            
            
       
            
            $this->render("viewletter" ,array(
			'text'=>$text
		));
            
            
            
            
//            echo $text;
        }
        
        public function actionviewExportedLetters($id)
	{
            
            $criteria = new CDbCriteria;
            $criteria->condition = "`ExportedletterID` = $id";
		
            $items = Exportedletters::model()->findAll($criteria);

            foreach ($items as $item)            
            {
                $text=$item->Exportedlettertext;               
            }
            
            
       
            
            $this->render("viewletter" ,array(
			'text'=>$text
		));
            
            
        }
        
        
        public function actiondownload($id)
	{
            $criteria = new CDbCriteria;
            $criteria->condition = "`LetterID` = $id";
		
            $items = Letters::model()->findAll($criteria);

            foreach ($items as $item)            
            {
                $text=$item->LetterText;   
                $title=$item->Title;
            }
            
           
//            header("Content-type: application/vnd.ms-word");
//            header("Content-Disposition: attachment;Filename=document_name.doc");
// 
//            echo $text;
            
//            $this->render("download" ,array(
//			'text'=>$text,
//		));
            
            
            $name=$title." ".date("j/ n/ Y")." ".Yii::app()->user->name;
            
header("Pragma: no-cache"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false); // required for certain browsers
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=\"$name.doc");
header("Content-Transfer-Encoding: binary");
ob_clean();
flush();



echo $text;  
            
            
        }
        
    public function actiondownloadletter()
	{
        $text=$_POST['ftext'];
        
        
        $title=$_POST['title'];
        
        $name=$title." ".date("j/ n/ Y")." ".Yii::app()->user->name;
        
        header("Pragma: no-cache"); // required
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false); // required for certain browsers
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment; filename=\"$name.doc");
        header("Content-Transfer-Encoding: binary");
        ob_clean();
        flush();

        echo $text;  
        }
        
        public function actiongosave()
	{
		$post=new Letters;
                $post->Title=$_POST['ftitle'];
                $post->LetterText="<html><head><meta http-equiv=Content-Type content=text/html;charset=utf-8 /></head><body>".$_POST['ftext']."</body></html>";              
                $post->save();

		 $this->redirect(array('temp'));
                                                
	}
        
        
         public function actionlettersave()
	{
                                          
                $text=$_POST['lettertext'];
                
                $post=new Exportedletters;
                $post->Exportedlettertext=$text;  
                $post->UserName=Yii::app()->user->name;               
                $post->save(); 
                
            // Yii::app()->user->name
            // print CJSON::encode($text);
                      
               
         }
         
         public function actionletterupdate()
	{
             if(isset($_POST['ftext']))
                 $lettertext=$_POST['ftext'];
                 
             $title=$_POST['title'];
                
                $this->renderPartial("word", array(
                 'lettertext'=>$lettertext,'title'=>$title
                 ));
                
         }
         
          
        
        
         public function actiondoupdate($id)
	{
		                                                
                $post=Letters::model()->findByPk($id);
                $post->Title=$_POST['ftitle'];
                $post->LetterText=$_POST['ftext'];;      
                $post->save(); // save the change to database
                
                
                $this->redirect(array('temp'));
                
	}
        
}
?>
