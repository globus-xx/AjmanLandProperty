<?php

class ContractsMasterController extends Controller
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

/*        public function primaryKey()
    {
        return array('CustomerID');
    }*/

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
				'actions'=>array('admin','create','update','landsearch','landresult', 'searchbuyers', 'searchrealstate', 'createcontract','Print','printfrom','printdeedcertificate','savedeedcertificate','printmukhattat','mukhattat','auto','autow','convert'),
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

  public function getReportableDefaults(){
    $defaults = array();
    $defaults['ContractTypes'] = array(
           0=>  'بيــــع',
           1=>  'وراثة',
           2=>  'تنازل',
           3=>  'وقف',
           4=>  'هبة',);
      // get the unique set of customers
    $sql = 'SELECT DISTINCT Nationality FROM `customermaster`';
    $connection = Yii::app()->db;   // assuming you have configured a "db" connection
    $command = $connection->createCommand($sql);
    $dataReader = $command->query();
    $defaults['CustomerNationalities'] = array();
    while(($row=$dataReader->read())!==false){
      $defaults['CustomerNationalities'][$row['Nationality']] = $row['Nationality'];
    }
    return $defaults;
  }

  public function actionReportables()
  {

    $dataProvider=new CActiveDataProvider('Reportable', array(
      'criteria'=>array(
          'condition'=>'reportable_type=\'ContractsMaster\'',
      )
    ));
    $this->render('reportables',array(
      'dataProvider'=>$dataProvider,
          ));

  }

  public function actionNewReportable()
  {
    $model = new Reportable;
    $model->reportable_type = 'ContractsMaster';

    $defaults = $this->getReportableDefaults();

    if(isset($_POST['Reportable']))
    {
      $model->attributes = $_POST['Reportable'];
      if($model->validate())
      {
        $model->save();
        $this->redirect(array('viewReportable', 'id'=>$model->id));
      }
    }
    $this->render('newReportable',array('model'=>$model, 'defaults'=>$defaults));
  }
  
  public function actionEditReportable($id)
  {
    $model = Reportable::model()->findByPk($id);

    $defaults = $this->getReportableDefaults();

    if(isset($_POST['Reportable']))
    {
      $model->attributes = $_POST['Reportable'];
      if($model->validate())
      {
        $model->save();
        $this->redirect(array('viewReportable', 'id'=>$model->id));
      }
    }
    $this->render('editReportable',array('model'=>$model, 'defaults'=>$defaults));
  }
  public function actionViewReportable($id)
  {
    $model = Reportable::model()->findByPk($id);


    $this->render('viewReportable',array(
      'model'=>$model,
      'results'=>ContractsMaster::getReportFromReportable($model)
          ));
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

  public function actionLandsearch()
  {
    if(isset($_GET["id"]))
    {
     $c_types = array(
         0=>	'بيــــع',
         1=>	'وراثة',
         2=>	'تنازل',
         3=>	'وقف',
         4=>	'هبة',);
     $contract_type = $_GET["id"];
     $this->render("landsearch",array('contract_type'=>$c_types[$contract_type],'ctype'=>$contract_type,));
   }else{
       $this->render("landsearch",array('contract_type'=>'بيــــع','ctype'=>0));
   }
 }



  /*
  LandResult will receive ajax-request from the view land-search and return Deed ID, Land ID and customer names who currently own that land as per the Deed-master and Deed-detail tables.
  */
  public function actionLandresult()
  {

    if(isset($_POST["data"])) //check that this action is only called using POST.. not get, not regular.
    {

      $deedIds = array();

      $searchstring = json_decode($_POST["data"]); 
      $searchstring = "%".$searchstring . "%"; 

      $searchCriteria=new CDbCriteria;
      $searchCriteria->condition = 'CustomerNameArabic LIKE :searchstring OR MobilePhone LIKE :searchstring';
      $searchCriteria->params = array(':searchstring'=> $searchstring);
      $searchCriteria->order = 'CustomerID';

      if (CustomerMaster::model()->count($searchCriteria)>0)
      {
        $customerResult = CustomerMaster::model()->findAll($searchCriteria);

        $customerIds = array();
        foreach($customerResult as $customer)
        {
            $customerIds[] = $customer->CustomerID;
        }
        // Look for Deeds where customer appear
        $deedDetails = DeedDetails::model()->findAllByAttributes(array("CustomerID"=>$customerIds));
        // Get all deed MASTER ids (unique)

        foreach($deedDetails as $deed)
        {
            $deedIds[] = $deed->DeedID;
        }

      }else{
        $searchCriteria = new CDbCriteria;
        $searchCriteria->condition = 'LandID LIKE :searchstring';
        $searchCriteria->params = array(':searchstring'=>$searchstring);
        $deeds = DeedMaster::model()->findAll($searchCriteria);

        foreach($deeds as $deed)
        {
           $deedIds[] = $deed->DeedID;
        }
      }

      $tempIds = array_unique($deedIds); //unique of above
      $deedIds = array();
                  
    foreach($tempIds as $deed)
    {
      $deedIds[] = $deed; //array_unique returns key->value ..so this is just to take the value and chuck out the key! and we put it back in deedIds()
    }
                  
    // Get all Deed Master
    $deedMasters = DeedMaster::model()->findAllByAttributes(array("DeedID"=>$deedIds));

    // Construct the Result
    $searchResult = array();

    foreach($deedMasters as $deedMaster)
    {
      if($deedMaster->Remarks!=="cancelled")
      {
        $object = new stdClass;
        $object->LandId = $deedMaster->LandID;
        $object->DeedId = $deedMaster->DeedID;
        $object->CustomerNameArabic = "";

        $deedDetails = $deedMaster->deedDetails;

        foreach($deedDetails as $deedDetail)
        {
            $object->CustomerNameArabic .= $deedDetail->customer->CustomerNameArabic ."___";
        }

        $hajzDetails = $deedMaster->hajzMasters;
        foreach($hajzDetails as $hajz)
        {
           if ($hajz->IsActive>0)
           {
            $object->hajzDetails.= $hajz->HajzID."=>".$hajz->TypeDetail.",";    
            $object->hajzID[] = $hajz->HajzID;
          }
        }
        $searchResult[] = $object;
      }
    }
    print CJSON::encode($searchResult);
    }else{
      throw new CHttpException(404,'The requested page does not exist.');
    }
  }
//**End of function above**//



    /*Finally save the contract into the contract-master, contract-details, deed-master and deed-details using data coming from create.php*/
    public function actionCreatecontract()
    {

     $city = array('1'=>'عجمان','2'=>'المنامة','3'=>'مصفوت');	
     $qita = array('01'=>'الزوراء ','02'=>'قطاع مركز المدينة ','03'=>'القطاع الشمالي ','04'=>'القطاع الاوسط ','05'=>'القطاع الجنوبي ','06'=>'القطاع الشرقي ','07'=>'قطاع المنامة ','08'=>'قطاع مصفوت ');
     $hayi = array('01'=>'الزراء', '02'=>'الراشدية 1', '03'=>'الراشدية 2', '04'=>'الراشدية 3', '05'=>'الرميلة 1', '06'=>'الرميلة 2', '07'=>'الرميلة 3', '08'=>'الصفيا ', '09'=>'النخيل 1', '10'=>'النخيل 2', '11'=>'النعيمة 1', '12'=>'النعيمية 2', '13'=>'النعيمية 3', '14'=>'ليوارة 1', '15'=>'ليوارة 2', '16'=>'مشيرف ', '17'=>'الباهية ', '18'=>'الجرف الصناعية 1', '19'=>'الجرف الصناعية 2', '20'=>'الجرف الصناعية 3', '21'=>'الجرف 1', '22'=>'الجرف 2', '23'=>'الحميدية 1', '24'=>'الحميدية 2', '25'=>'الرقايب 1', '26'=>'الرقايب 2', '27'=>'العالية ', '28'=>'التلة 1', '29'=>'التلة 2', '30'=>'الروضة 1', '31'=>'الروضة 2', '32'=>'الروضة 3 ', '33'=>'المنتزي 1', '34'=>'المنتزي 2', '35'=>'المويهات 1', '36'=>'المويهات 2', '37'=>'المويهات 3', '38'=>'عجمان الصناعية 1', '39'=>'عجمان الصناعية 2', '40'=>'الحليو 1', '41'=>'الحليو 2', '42'=>'الزاهية ', '43'=>'العامرة ', '44'=>'الياسمين ', '45'=>'المنامة 1', '46'=>'المنامة 2', '47'=>'المنامة 3', '48'=>'المنامة 4', '49'=>'المنامة 5', '50'=>'المنامة 6', '51'=>'المنامة 7', '52'=>'المنامة 8', '53'=>'المنامة 9', '54'=>'المنامة 10', '55'=>'المنامة 11', '56'=>'المنامة 12', '57'=>'المنامة 13', '58'=>'المنامة 14', '59'=>'المنامة 15', '60'=>'المنامة 16', '61'=>'المنامة 17', '62'=>'مصفوت 15', '63'=>'مصفوت 14', '64'=>'مصفوت 13', '65'=>'مصفوت 12', '66'=>'مصفوت 11', '67'=>'مصفوت 10', '68'=>'مصفوت 9', '69'=>'مصفوت 8', '70'=>'مصفوت 7', '71'=>'مصفوت 6', '72'=>'مصفوت 5', '73'=>'مصفوت 4', '74'=>'مصفوت 3', '75'=>'مصفوت 2', '76'=>'مصفوت 1',);

     $result = new StdClass;
     $result->error = 1;
     $result->message =array();
            //$result->printout = array();
     $remarks = array('الشراء','الوراثة','التنازل','وقف','العطاء و التمليك');

     if(isset($_POST["data"]))
     {
        $data = json_decode($_POST["data"]);
        $owner = $data->owners;
        $buyer  = $data->buyers;

        if(count($owner)==0)
        {
         $result->message[] = "No Selected Owner";

     }

     if(count($buyer)==0)
     {
         $result->message[] = "No Selected Buyers";
     }

     if(intval($data->contractamount)==0)
     {
         $result->message[] = "No  Amount";
     }

     if(count($result->message)==0)
     {             
        $deedMaster = DeedMaster::model()->findByPk($data->deedId); 
        $landupdate = LandMaster::model()->findByPk($deedMaster->LandID);
        $oldlandid = $deedMaster->LandID;

        $landupdate->Land_Type = $data->landtype;

        if ($data->newalready==false)
        {
            $landupdate->Remarks = $landupdate->LandID;
            $landupdate->LandID = $data->newlandid;
            $landupdate->LocationID = $city[substr($data->newlandid, 0, 1)];
            $landupdate->Plot_No = $qita[substr($data->newlandid,1,2)];
            $landupdate->location = $hayi[substr($data->newlandid,3,2)];
            $landupdate->Piece = substr($data->newlandid,5,strlen($data->newlandid));
        }
        $landupdate->save();

        $contractMaster = new ContractsMaster();
        if($data->newalready==false)
            $contractMaster->LandID = $data->newlandid;
        else
            $contractMaster->LandID = $deedMaster->LandID;

        $contractMaster->DateCreated = date("d-m-Y");
        $contractMaster->UserID = Yii::app()->User->ID;
        $contractMaster->ContractType = $data->contractype;
        $contractMaster->DeedID = $deedMaster->DeedID;
        $contractMaster->SchemeID = $deedMaster->SchemeID;
        $contractMaster->AmountEntered = intval($data->contractamount);
        $contractMaster->AmountCorrected = intval($data->correctedamount);
        if (intval($data->feeamount)==0)
           $contractMaster->Fee =0;
       else
        $contractMaster->Fee = intval($data->feeamount) + 250;
    $contractMaster->Remarks = $data->Remarks;

    if($contractMaster->save())
    {
       $result->printout = $contractMaster;

                                   // owner
       $owners = $data->owners;
       foreach($owners as $customer)
       {
        $deedLine = DeedDetails::model()->findByAttributes(array("DeedID"=>$deedMaster->DeedID, "CustomerID"=>$customer));
        $contractDetail = new ContractsDetail();
        $contractDetail->ContractID = $contractMaster->ContractsID;
        $contractDetail->Type = "seller";
        $contractDetail->CustomerID = $customer;
        $contractDetail->Share = $deedLine->Share;
        $contractDetail->CardID = 0;
        $contractDetail->Side = "";
        $contractDetail->save();

                                           // $result->printout[] = $contractDetail;
    }
                                    // buyers
    $buyers = $data->buyers;
    foreach($buyers as $customer)
    {
        $deedLine = DeedDetails::model()->findByAttributes(array("DeedID"=>$deedMaster->DeedID, "CustomerID"=>$customer->buyerid));
        $contractDetail = new ContractsDetail();
        $contractDetail->ContractID = $contractMaster->ContractsID;
        $contractDetail->Type = "buyer";
        $contractDetail->CustomerID = $customer->buyerid;
        if ($data->equals=="yes")
        {
            $contractDetail->Share = "كامل الحصص";
        }
        else
        {
            if(($customer->shareval==0) && ($deedLine))
            {
              $contractDetail->Share = $deedLine->Share;
          }
          else
          {
             $contractDetail->Share = $customer->shareval;
         }
     }
     $contractDetail->CardID = null;
     $contractDetail->Side = "";
     if(! $contractDetail->save())
     {
        foreach($contractDetail->getErrors() as $key => $value)
        {
            $result->message[] = $key . " >>> " . $value . "<br/>";
        }
    }
                                            //$result->printout[] = $contractDetail;
}
                                    // real estate
$realstates = $data->realstate;
foreach($realstates as $estate)
{

    if($estate->isbuyer=="1")
    {
        $contractDetail = new ContractsDetail();
        $contractDetail->ContractID = $contractMaster->ContractsID;
        $contractDetail->Type = "waseet";
        $contractDetail->CustomerID = 0;
        $contractDetail->Share = 0;
        $contractDetail->CardID =$estate->stateid;
        $contractDetail->Side = "buyer";
        $contractDetail->save();
                                                //$result->printout[] = $contractDetail; 
    }
    if($estate->isseller=="1")
    {
        $contractDetail = new ContractsDetail();
        $contractDetail->ContractID = $contractMaster->ContractsID;
        $contractDetail->Type = "waseet";
        $contractDetail->CustomerID = 0;
        $contractDetail->Share = 0;
        $contractDetail->CardID =$estate->stateid;
        $contractDetail->Side = "seller";
        $contractDetail->save();
                                               // $result->printout[] = $contractDetail;
    }
}
$wakeels = $data->wakeel;
foreach($wakeels as $wakeel)
{
  if($wakeel->isbuyer=="1")
  {
     $contractDetail = new ContractsDetail();
     $contractDetail->ContractID = $contractMaster->ContractsID;
     $contractDetail->Type = $wakeel->type;
     $contractDetail->CustomerID = $wakeel->wakeelID;
     $contractDetail->Share = 0;
     $contractDetail->CardID = 0;
     $contractDetail->Side = "buyer";
     $contractDetail->remarks = $wakeel->wakeelremarks;
     $contractDetail->save();
 }
 if($wakeel->isseller=="1")
 {
     $contractDetail = new ContractsDetail();
     $contractDetail->ContractID = $contractMaster->ContractsID;
     $contractDetail->Type = $wakeel->type;
     $contractDetail->CustomerID = $wakeel->wakeelID;
     $contractDetail->Share = 0;
     $contractDetail->CardID = 0;
     $contractDetail->Side = "seller";
     $contractDetail->remarks = $wakeel->wakeelremarks;
     $contractDetail->save();
 }
}
                                    // save new deed
$newdeed = new DeedMaster();

if ($data->newalready==false)
  $newdeed->LandID =  $data->newlandid;
else
  $newdeed->LandID = $deedMaster->LandID;

$newdeed->SchemeID = $deedMaster->SchemeID;
$newdeed->DateCreated = date("d-M-Y");
$newdeed->UserID = Yii::app()->User->ID;
$newdeed->ContractID = $contractMaster->ContractsID;
$newdeed->InvoiceNo =0;
 //                                 $newdeed->Docs => later to be put from scanned copies
$newdeed->Remarks = $remarks[$data->contractype];


if($newdeed->save())
{
  $result->newdeedid = $newdeed->DeedID;
  $buyers = $data->buyers;
  foreach($buyers as $customer)
  {
    $olddeedLine = DeedDetails::model()->findByAttributes(array("DeedID"=>$deedMaster->DeedID, "CustomerID"=>$customer->buyerid));
    $deedline = new DeedDetails();
    $deedline->DeedID = $newdeed->DeedID;
    $deedline->CustomerID = $customer->buyerid;

    if($data->equals=="yes")
    {
       $deedline->Share = "كامل الحصص";
   }
   else
   {

       if(($customer->shareval==0) && ($olddeedLine))
       {
         $deedline->Share = $olddeedLine->Share;
     }
     else
     {
        $deedline->Share = $customer->shareval;
    }
}

if(! $deedline->save())
{
    foreach($deedline->getErrors() as $key => $value)
    {
        $result->message[] = $key . " >>> " . $value . "<br/>";
    }
}
}

}

if(count($result->message)==0)
{
  $result->error = 0;
  $result->message = array();
}
                            	$deedMaster->Remarks="cancelled"; //set old deed to cancelled, so it isn't shown in the deed's list upon searching again
                            	$deedMaster->save();

                                if($data->newalready==false)
                                {

                                   $q1 = "UPDATE DeedMaster SET LandID='".$data->newlandid."' WHERE LandID='".$oldlandid."'";
                                   $command = Yii::app()->db->createCommand($q1);
                                   $res = $command->execute();

                                   $q2 = "UPDATE ContractsMaster SET LandID='".$data->newlandid."' WHERE LandID='".$oldlandid."'";
                                   $command = Yii::app()->db->createCommand($q2);
                                   $res = $command->execute();


                               }
                           }
                           else
                           {
                             foreach($contractMaster->getErrors() as $key => $value)
                             {
                                $result->message[] = $key . " >>> " . $value . "<br/>";
                            }
                        }
                    }


                   // Yii::log('', CLogger::LEVEL_INFO,"found it:   " . $data->contractamount);

                }
                print CJSON::encode($result);
            }
	/**
	 * Step 2 of create a contract. This follows from landsearch-view where we direct the page here, by passing in the Deed Id
	 * The Deed Id serves as the input to the Contract Form and through it we have the rest of the info (current owners etc)
	 */
	public function actionCreate()
	{

      if(isset($_GET["id"]))
      {


                    $deedId = $_GET["id"]; //retrieve value passed from landsearch.php's clicking of a record @inititemrecord
                    $c_type = $_GET["type"];
                    // Master Deed
                    $deedMaster = DeedMaster::model()->findByPk($deedId);
					//echo "here...";
                    // Customer names for search ->this will serve the auto-complete textbox.
                    /*$sc = new CDbCriteria;
                    //$sc->limit = 22000;
                    $customerList =CustomerMaster::model()->FindAll($sc);
					$customerArray = array();

                    foreach($customerList as $customer)
                    {   
							
                            //$customerArray[] = $customer->CustomerNameEnglish;
                            $customerArray[] = $customer->CustomerNameArabic;
                            

                    }
                    // Get all real estates -> this will serve the auto-complete textbox.
                    $RealEstatePeople = RealEstatePeople::model()->findAll();
                    $RealNames = array();
                    foreach($RealEstatePeople as $people)
                    { 
                            $RealNames[] = $people->Name." * ";
                    }
                    
                    $wakeels = array_merge($customerArray,$RealNames);*/
                    //send to view with the deedMaster object, a full list of customer names and a full list of real estate office names
                   // the magic is in the view. 
                    $this->render('create',array(
                     'deedMaster'=>$deedMaster,
                        //'customerNames'=>$customerArray,
                        //'wakeels'=>$wakeels,
                     'type'=>$c_type,
                     ));
                }
                else
                {
                   throw new CHttpException(404,'The requested page does not exist.');
               }
           }
//** End of function above
           public function actionautow()
           {
              $res3 = array();

              if (isset($_GET['term'])) {
                 $qtxt = 'SELECT CustomerNameArabic from CustomerMaster WHERE CustomerNameArabic LIKE :name';
                 $command = Yii::app()->db->createCommand($qtxt);
                 $command->bindValue(':name','%'.$_GET['term'].'%',PDO::PARAM_STR);
                 $res1 = $command->queryColumn();

                 $qtxt = 'SELECT Name from RealEstatePeople WHERE Name LIKE :name';
                 $command = Yii::app()->db->createCommand($qtxt);
                 $command->bindValue(':name','%'.$_GET['term'].'%',PDO::PARAM_STR);
                 $res2 = $command->queryColumn();

                 foreach ($res2 as $r)
                     {	$res3[] = $r." * "; }

             }
             $res = array_merge($res1,$res3);
             print CJSON::encode($res);
         }

         public function actionauto()
         {

          if (isset($_GET['term'])) {
             $qtxt = 'SELECT CustomerNameArabic from CustomerMaster WHERE CustomerNameArabic LIKE :name';
             $command = Yii::app()->db->createCommand($qtxt);
             $command->bindValue(':name','%'.$_GET['term'].'%',PDO::PARAM_STR);

             $res = $command->queryColumn();

			/*$qtxt = 'SELECT CustomerNameArabic from CustomerMaster WHERE CustomerNameArabic LIKE :name';
			$command = Yii::app()->db->createCommand($qtxt);
			$command->bindValue(':name','%'.$new.'%',PDO::PARAM_STR);
			
			$res2 = $command->queryColumn();*/
		}
		//$res = array_merge($res1,$res2);
		print CJSON::encode($res);
	}


	
    public function actionSearchbuyers()
    {
        if(isset($_POST["data"]))
        {
            $searchstring = json_decode($_POST["data"]);
            $customer = CustomerMaster::model()->findByAttributes(array("CustomerNameArabic"=>$searchstring));
            if(!$customer)
            {
             $customer = CustomerMaster::model()->findByAttributes(array("CustomerNameEnglish"=>$searchstring));
         }
         if($customer)
         {
                           // Yii::log('', CLogger::LEVEL_INFO,"found it");
            print CJSON::encode($customer);
        }
        else
        {
                            //Yii::log('', CLogger::LEVEL_INFO,"found it not");
            print "error";
        }
    }
}

public function actionSearchrealstate()
{
    $searchstring = json_decode($_POST["data"]);
    $realstate = RealEstatePeople::model()->findByAttributes(array("Name"=>str_replace(" * ", "", $searchstring)));
    $result = new StdClass;
    if($realstate)
    {   
        $result->type = "waseet";
        $result->waseet = $realstate;
                    // Yii::log('', CLogger::LEVEL_INFO,"found it");
        print CJSON::encode($result);
                    //Yii::log('', CLogger::LEVEL_INFO,"found it not");
    }
    else
    {
        $wakeelName = CustomerMaster::model()->findByAttributes(array("CustomerNameArabic"=>$searchstring));
        if($wakeelName)
        {
           $result->type = "wakeel";
           $result->wakeel = $wakeelName;
           print CJSON::encode($result);
       }
       else
       {
           print "error";
       }

   }
}
/*
public function actionCreate()
	{
		$model=new ContractsMaster;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ContractsMaster']))
		{
			$model->attributes=$_POST['ContractsMaster'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ContractsID));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

*/

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

		if(isset($_POST['ContractsMaster']))
		{
			$model->attributes=$_POST['ContractsMaster'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ContractsID));
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

		$dataProvider=new CActiveDataProvider('ContractsMaster');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
          ));

	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ContractsMaster('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ContractsMaster']))
			$model->attributes=$_GET['ContractsMaster'];

		$this->render('admin',array(
			'model'=>$model,
          ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */

	public function actionprintdeedcertificate($id)
	{
		
		$dm = DeedMaster::model()->findByPk($id);
		$cnt = DeedDetails::model()->count('DeedID LIKE :id', array(':id'=>$id));
		
		$this->renderpartial('printdeedcertificate',array('deed'=>$dm,'cnt'=>$cnt));
		
	}
	
	public function actionmukhattat()
	{
		$this->render('printmukhattat');
	}

	public function actionprintmukhattat($id)
	{
		$dm = DeedMaster::model()->findByPk($id);
		$cnt = DeedDetails::model()->count('DeedID LIKE :id', array(':id'=>$id));
		
		$this->renderpartial('mukhattat',array('deed'=>$dm,'cnt'=>$cnt));
	}
	
	public function actionsavedeedcertificate()
	{
     if(isset($_POST["data"]))
     {
        $data = json_decode($_POST["data"]); 

        $deedcertificate = new DeedCertificate;
        $deedcertificate->sha1 = $data->code;
        $deedcertificate->LandID = $data->LandID;
        $deedcertificate->DeedID = $data->DeedID;
        $deedcertificate->ContractsID = $data->ContractID;
        $deedcertificate->UserID = $data->UserID;
        $deedcertificate->DateTime = date("d-m-y, G:i:s");
        $deedcertificate->save();
    }
}

public function actionconvert()
{

  $city = array('1'=>'عجمان','2'=>'المنامة','3'=>'مصفوت');	
  $qita = array('01'=>'الزوراء ','02'=>'قطاع مركز المدينة ','03'=>'القطاع الشمالي ','04'=>'القطاع الاوسط ','05'=>'القطاع الجنوبي ','06'=>'القطاع الشرقي ','07'=>'قطاع المنامة ','08'=>'قطاع مصفوت ');
  $hayi = array('01'=>'الزراء', '02'=>'الراشدية 1', '03'=>'الراشدية 2', '04'=>'الراشدية 3', '05'=>'الرميلة 1', '06'=>'الرميلة 2', '07'=>'الرميلة 3', '08'=>'الصفيا ', '09'=>'النخيل 1', '10'=>'النخيل 2', '11'=>'النعيمة 1', '12'=>'النعيمية 2', '13'=>'النعيمية 3', '14'=>'ليوارة 1', '15'=>'ليوارة 2', '16'=>'مشيرف ', '17'=>'الباهية ', '18'=>'الجرف الصناعية 1', '19'=>'الجرف الصناعية 2', '20'=>'الجرف الصناعية 3', '21'=>'الجرف 1', '22'=>'الجرف 2', '23'=>'الحميدية 1', '24'=>'الحميدية 2', '25'=>'الرقايب 1', '26'=>'الرقايب 2', '27'=>'العالية ', '28'=>'التلة 1', '29'=>'التلة 2', '30'=>'الروضة 1', '31'=>'الروضة 2', '32'=>'الروضة 3 ', '33'=>'المنتزي 1', '34'=>'المنتزي 2', '35'=>'المويهات 1', '36'=>'المويهات 2', '37'=>'المويهات 3', '38'=>'عجمان الصناعية 1', '39'=>'عجمان الصناعية 2', '40'=>'الحليو 1', '41'=>'الحليو 2', '42'=>'الزاهية ', '43'=>'العامرة ', '44'=>'الياسمين ', '45'=>'المنامة 1', '46'=>'المنامة 2', '47'=>'المنامة 3', '48'=>'المنامة 4', '49'=>'المنامة 5', '50'=>'المنامة 6', '51'=>'المنامة 7', '52'=>'المنامة 8', '53'=>'المنامة 9', '54'=>'المنامة 10', '55'=>'المنامة 11', '56'=>'المنامة 12', '57'=>'المنامة 13', '58'=>'المنامة 14', '59'=>'المنامة 15', '60'=>'المنامة 16', '61'=>'المنامة 17', '62'=>'مصفوت 15', '63'=>'مصفوت 14', '64'=>'مصفوت 13', '65'=>'مصفوت 12', '66'=>'مصفوت 11', '67'=>'مصفوت 10', '68'=>'مصفوت 9', '69'=>'مصفوت 8', '70'=>'مصفوت 7', '71'=>'مصفوت 6', '72'=>'مصفوت 5', '73'=>'مصفوت 4', '74'=>'مصفوت 3', '75'=>'مصفوت 2', '76'=>'مصفوت 1',);

  if(isset($_POST["data"]))
  {
     $data = json_decode($_POST["data"]);

     $landupdate = LandMaster::model()->findByPk($data->oldlandid);
     $landupdate->Remarks = $landupdate->LandID;
     $landupdate->LandID = $data->newlandid;
     $landupdate->LocationID = $city[substr($data->newlandid, 0, 1)];
     $landupdate->Plot_No = $qita[substr($data->newlandid,1,2)];
     $landupdate->location = $hayi[substr($data->newlandid,3,2)];
     $landupdate->Piece = substr($data->newlandid,5,strlen($data->newlandid));
     $landupdate->save();

     $q1 = "UPDATE DeedMaster SET LandID='".$data->newlandid."' WHERE LandID='".$data->oldlandid."'";
     $command = Yii::app()->db->createCommand($q1);
     $res = $command->execute();

     $q2 = "UPDATE ContractsMaster SET LandID='".$data->newlandid."' WHERE LandID='".$data->oldlandid."'";
     $command = Yii::app()->db->createCommand($q2);
     $res = $command->execute();

 }
 print CJSON::encode("success");
}


public function actionPrintfrom()
{
  $this->render('printfrom');
}

public function actionPrint($id)
{

 $cm = ContractsMaster::model()->findByPk($id);

			//counts of number of actual sellers and buyers....
			$ns = ContractsDetail::model()->count('ContractID LIKE :id AND Type LIKE :type',array(':id'=>$id,':type'=>'Seller')); //number of sellers
			$nb = ContractsDetail::model()->count('ContractID LIKE :id AND Type LIKE :type', array(':id'=>$id, ':type'=>'Buyer')); //number of buyers
			
			//counts of number of wakeel sellers or buyer sides....
			$nsw = ContractsDetail::model()->count('ContractID LIKE :id AND Type NOT LIKE :type AND Side LIKE :side', array(':id'=>$id, ':type'=>'waseet', ':side'=>'Seller'));
			$nbw = ContractsDetail::model()->count('ContractID LIKE :id AND Type NOT LIKE :type AND Side LIKE :side', array(':id'=>$id, ':type'=>'waseet', ':side'=>'Buyer'));
			
			$cs = new CDbCriteria;
			$cs->condition = 'ContractID LIKE :id AND Type LIKE :type';
			$cs->params = array(':id'=>$id,':type'=>'Seller');
			$sellers = ContractsDetail::model()->findAll($cs);
			
			$cb = new CDbCriteria;
			$cb->condition = 'ContractID LIKE :id AND Type LIKE :type';
			$cb->params = array(':id'=>$id,':type'=>'Buyer');
			$buyers = ContractsDetail::model()->findAll($cb);

			$csw = new CDbCriteria; //all wakeel on sellers side
			$csw->condition = 'ContractID LIKE :id AND Side LIKE :side AND Type NOT LIKE :type';
			$csw->params = array(':id'=>$id,':side'=>'Seller',':type'=>'waseet');
			$wsellers = ContractsDetail::model()->findAll($csw);
			
			$cbw = new CDbCriteria; //all wakeel on buyers side
			$cbw->condition = 'ContractID LIKE :id AND Side LIKE :side AND Type NOT LIKE :type';
			$cbw->params = array(':id'=>$id, ':side'=>'Buyer',':type'=>'waseet');
			$wbuyers = ContractsDetail::model()->findAll($cbw);

			
			if($cm===null)
				throw new CHttpException(404,'The requested page does not exist.');
			$this->renderpartial('printcontract',array('cm'=>$cm,'ns'=>$ns,'nb'=>$nb,'nsw'=>$nsw,'nbw'=>$nbw,'sellers'=>$sellers,'buyers'=>$buyers,'wsellers'=>$wsellers,'wbuyers'=>$wbuyers));

			
			
       }
       public function loadModel($id)
       {
          $model=ContractsMaster::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='contracts-master-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
