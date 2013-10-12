<?php
        // as we discussed on phone see the action  called Print_converted_dates and this using strtotime php function 
        // you can change the table name and primary id and date_column using public variables below
        // 
        // 
        // and the following is functions maybe you will use it in the future 
        // we have three tables (deedmaster , contractsmaster , hajzmaster) and three columns (DeedID , ContractsID , HajzID)
        // I have made 5 functions to complete the date conversion properly 
        // i will explain one by one 
        // before starting you should change table name and the primary keyand the date column
        // first is the print_all which will print all the dates inside specified table   (1)
        // second is the check_special_case which will print all the dates existing that is not like this format 00/00/0000 (2)
        // third is Create_new_column which will create new column in the specified table called  newdateccreated (3)
        // forth is convert_dates will convert all dates and save them in the new column newdateccreated (note in this function : due to larg data existing its better to uncomment the parts of code between {{step to comment}} to make the conversion step by step and dont make exception of max excution time  )  (4)
        // fifth is Finish_conversion which will delete the old date column and rename the new column same as the old column (5)


class DateController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        public $relations =array();
        
        
        
        public $table_name = "deedmaster";
        public $primary_key = "DeedID";
        public $date_column = "DateCreated";
        
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
				'actions'=>array('print_all','check_special_case','convert_dates','finish_conversion','create_new_column','print_converted_dates'),
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

        
        
        public function actionPrint_converted_dates()
        {
            
             // ================= get date
             $date = "";
             $sql = 'select * from '.$this->table_name.';';

             $connection=Yii::app()->db;
             $command=$connection->createCommand($sql);
             $result=$command->queryAll(); 
             
             foreach($result as $row)
             {
                 echo "old date : ".$row[$this->date_column]." =============>>>  new converted date : ".strtotime($row[$this->date_column]) ."<br>";  
             }
             
             
        }
        
        
        public function actionPrint_all()
        {
            $date = "";
            $sql = 'select * from '.$this->table_name.'; ';

             $connection=Yii::app()->db;
             $command=$connection->createCommand($sql);
             $result=$command->queryAll(); 
             
             foreach($result as $row)
             {
                 echo $row[$this->date_column]."<br>";  
             }
             
             
              echo "Done";
        }
        
        public function actionCheck_special_case()
        {
             // ================= get date
            $date = "";
            $sql = 'select * from '.$this->table_name.';';

             $connection=Yii::app()->db;
             $command=$connection->createCommand($sql);
             $result=$command->queryAll(); 
             
             foreach($result as $row)
             {
                  // ================= get date
                 $date = $row[$this->date_column];
                 
                 // ================= convert date
                 $date = explode("/", $date);                
                 
                 if(strlen($date[0])>2)
                 echo $date[0]."<br>";                 
             }
             
             
              echo "Done";
        }
        
        
        public function actionCreate_new_column()
        {
            // ================= create new date column                        
            $sql = 'ALTER TABLE '.$this->table_name.' ADD newdateccreated datetime';
            $connection=Yii::app()->db;
            $command=$connection->createCommand($sql);
            $command->execute();
            echo "Done";
        }
        
        public function actionConvert_dates()
        {
            
            set_time_limit(0);
                                                   
            // ================= copy date to the new column
            $date = "";
            $sql = 'select * from '.$this->table_name.';';

             $connection=Yii::app()->db;
             $command=$connection->createCommand($sql);
             $result=$command->queryAll(); 
             
             foreach($result as $row)
             {
                  // ================= get date
                 $date = $row[$this->date_column];
                 $dateori = $row[$this->date_column];
                 // ================= convert date
                 $date = explode("/", $date);
                
                 
                 if(strlen($date[0])>2)
                 { 
                   $newdate = explode(" ", $date[0]);  
                   
                   
                   if(strlen($newdate[0])>2)
                   {
                       $anothernewdate = explode("-", $date[0]);  
                       
                       if(strlen($anothernewdate[0])>2)
                       {
                           
                           if(strpos($anothernewdate[0], 'Err')!== false)    
                           {                                
                                //echo "Err case Conversion ======== ".$dateori." ======= ".$row['newdateccreated']."<br>";                                
                           }
                           else {
                                                                         
//                                ==============================================  step to comment 
//                                $sql = 'UPDATE '.$this->table_name.'
//                                SET newdateccreated= \''.$dateori.'\'
//                                WHERE '.$this->primary_key.'='.$row[$this->primary_key].';';
//                                
//                                $connection=Yii::app()->db;
//                                $command=$connection->createCommand($sql);
//                                $command->execute(); 
//
//                                echo "0000-00-00 date conversion ====== ".$dateori." ======= ".$row['newdateccreated']."<br>";   
//                                =============================================
                               
                           }
                           
                       }
                       else
                       {
                           if(strlen($anothernewdate[1])>2)
                           {                  
                               
//                             ==============================================  step to comment 
//                                $year = $anothernewdate[2];                                                               
//                                $month = $anothernewdate[1];
//                                $newmonth = date('m', strtotime($month));                                       
//                                $day = $anothernewdate[0];
//                                                                
//                                $result_date = $year ."-". $newmonth."-". $day;
//                                
//                              
//                                $sql = 'UPDATE '.$this->table_name.'
//                                        SET newdateccreated= \''.$result_date.'\'
//                                        WHERE '.$this->primary_key.'='.$row[$this->primary_key].';';
//                                
//                                
//                                $connection=Yii::app()->db;
//                                $command=$connection->createCommand($sql);
//                                $command->execute(); 
//                                
//                               echo "00-NOV-0000 date conversion  ======== ".$dateori." ======= ".$row['newdateccreated']." =======<br>";      
//                            =============================================
                               
                           }
                           else
                           {     
                               
//                             ==============================================  step to comment                                
//                                $year = $anothernewdate[2];
//                                $month = $anothernewdate[1];
//                                $day = $anothernewdate[0];
//                                
//                               $result_date = $year ."-". $month."-". $day;
//                                
//                                        $sql = 'UPDATE '.$this->table_name.'
//                                        SET newdateccreated= \''.$result_date.'\'
//                                        WHERE '.$this->primary_key.'='.$row[$this->primary_key].';';
//                                
//                                $connection=Yii::app()->db;
//                                $command=$connection->createCommand($sql);
//                                $command->execute(); 
//                                
//                                echo "00-00-0000 date conversion  ======== ".$dateori." ======= ".$row['newdateccreated']."<br>";    
//                            =============================================                                
                                
                           }
                       }
                   } 
                   else 
                   {
                                              
//                             ==============================================  step to comment                         
//                                $year = $newdate[2];
//                                $month = $newdate[1];
//                                $day = $newdate[0];
//                                
//                                $result_date = $year ."-". $month."-". $day;
//                                
//                                        $sql = 'UPDATE '.$this->table_name.'
//                                        SET newdateccreated= \''.$result_date.'\'
//                                        WHERE '.$this->primary_key.'='.$row[$this->primary_key].';';
//                                
//                                $connection=Yii::app()->db;
//                                $command=$connection->createCommand($sql);
//                                $command->execute(); 
//                                
//                               echo "00 00 00  case conversion  ======== ".$dateori." ======= ".$row['newdateccreated']."<br>";                                 
//                            =============================================                                   
                   }
                   
                               
                 }
                 else
                 {

//                             ==============================================  step to comment      ((Here You should encrease max excution time))
                     
                                $year = $date[2];
                                $month = $date[0];
                                $day = $date[1];
                                
                                $result_date = $year ."-". $month."-". $day;
                                
                               
                                        $sql = 'UPDATE '.$this->table_name.'
                                        SET newdateccreated= \''.$result_date.'\'
                                        WHERE '.$this->primary_key.'='.$row[$this->primary_key].';';
                                                                
                                $connection=Yii::app()->db;
                                $command=$connection->createCommand($sql);
                                $command->execute();                                                                 
                                echo "00/00/0000 case conversion  ======== ".$dateori." ======= ".$row['newdateccreated']." ===== <br>"; 
                                
//                            =============================================   
                     
                 }
                 
             }
             
            
            echo "Done";
            
                                                                                  
        }
                
        // ============================== delete old field and rename the new one 
        public function actionFinish_conversion()
        {
                     
            
            // ============== delete old column                                                               
                $sql = 'ALTER TABLE '.$this->table_name.'
                        DROP COLUMN '.$this->date_column.';';
                        
                $connection=Yii::app()->db;
                $command=$connection->createCommand($sql);
                $command->execute();       
                
                
           // =============== rename the new date column                                                                
                $sql = 'ALTER TABLE '.$this->table_name.'
                        change newdateccreated '.$this->date_column.' datetime;';
                        
                $connection=Yii::app()->db;
                $command=$connection->createCommand($sql);
                $command->execute();      
                
                echo "Done";
        }
         
        
        
        
        
      
}
