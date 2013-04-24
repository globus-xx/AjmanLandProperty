<?php

class ReportsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';
        public $database_name='ajmanlandproperty';
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(			
			'rights',
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
			)
                    ,
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','OpenTable'),
				'users'=>array('@'),
			)
                   
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionCalulate()
	{	             
              $rows=$_POST["rows"];     
              $tables=$_POST["tables"];                            
                          
              $columns=$_POST["columns"];                                       
              $data=$_POST["data"];
                                        
            $connection=Yii::app()->db; 
                        
            if($columns!="")
            $sql='SELECT DISTINCT  '.$rows.','.$columns.' FROM '.$tables.' GROUP BY '.$rows;
            
            if($columns=="")
            $sql='SELECT DISTINCT '.$rows.' FROM '.$tables. ' GROUP BY '.$rows;            
            $result=$connection->createCommand($sql)->queryAll();
                        
            
            $rows   =  explode(",", $rows);
            $check=$columns;
            
            
            if($columns!="")
            $columns=  explode(",", $columns);
            
            
            $substring="<tr style='background:yellow'>";
            
            
            foreach($rows as $ro)
                {                    
                    $substring.="<td>".$ro."</td>";
                }
                
            foreach($columns as $ro2)
                {                    
                    $substring.="<td>".$ro2."</td>";
                }
                                                
            $substring.="</tr>";
            
            $result_table=$substring;
            $substring="";
            
            
            foreach($result as $row)
            {                
                foreach($rows as $ro)
                {                    
                    $substring.="<td>".$row[$ro]."</td>";
                }
                
                if($check!="")
                foreach($columns as $ro2)
                {                                       
                    $substring.="<td>".$row[$ro2]."</td>";
                }
                
                $result_table.="<tr>".$substring."</tr>";
                $substring="";
            }
            
            print CJSON::encode($result_table);                     
	}
        
        
        public function actionIndex()
	{		            
//            $criteria = new CDbCriteria;            		
//            $items = Letters::model()->findAll($criteria);
            $connection=Yii::app()->db; 
            $sql='SHOW TABLES FROM '.$this->database_name;
            $tables=$connection->createCommand($sql)->queryAll();
            
            
		$this->render('report',array(
                    "tables"=>$tables,"db"=>$this->database_name
                ));                      
	}
	
	public function actionOpenTable($table="")
	{
            
            $connection=Yii::app()->db; 
            $sql='SHOW COLUMNS FROM '.$table;
            
            
            $fields=$connection->createCommand($sql)->queryAll();
            
            
		$this->render('fields',array(
                    "fields"=>$fields,"table"=>$table
                ));    			
	}
        
        
        public function actionCalculateChart($field,$table)
	{
            
            $qtxt = 'SELECT DISTINCT '.$field.' as FieldName,COUNT('.$field.') As FieldCount from '.$table.' GROUP BY '.$field.' ORDER BY '.$field.';';
      
           
            $connection=Yii::app()->db;                                     
            $result=$connection->createCommand($qtxt)->queryAll();
            
//            print_r($fields);
//            die();
            
//            foreach($fields as $row)
//            {
//                
//            }
            
		$this->render('draw',array(
                    "result"=>$result,"table"=>$table,"field"=>$field
                ));    			
	}
        
        
        function percent($num_amount, $num_total) {
            $count1 = $num_amount / $num_total;
            $count2 = $count1 * 100;
            $count = number_format($count2, 0);
            echo $count;
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
        
       
        
        public function actionDelete($id)
	{
		

                $post=Letters::model()->findByPk($id); // assuming there is a post whose ID is 10
                $post->delete(); // delete the row from the database table
                
                
                 $this->redirect(array('temp'));
                
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser                                
//		if(!isset($_GET['ajax']))
//			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
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
                                    
            

        }
        
        
        
        
        
}
?>
