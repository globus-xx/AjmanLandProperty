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
	 * Build Sql Command And Draw The Table
	 * 
	 */
	public function actionCalulate()
	{	                        
            $rows=$_POST["rows"];     
            $tables=$_POST["tables"];                                                      
            $columns=$_POST["columns"];                                       
            $data=$_POST["data"];
            $conditions=$_POST["conditions"];
            $page=$_POST["page"];
            
            
            $per_page = 9;
            $start = ($page-1)*$per_page;
            
            $connection=Yii::app()->db; 
            
            $d=0;
            if($data!="")
            {
            $d=1;
            
            $data   =  explode(",", $data);
            $datasql="";
            
            foreach($data as $ro)
            {               
               $datasql.="SUM(".$ro."),";               
            }
            
            $datasql=  substr($datasql,0,  strlen($datasql)-1);
            }
                
            
            if($conditions!="")
            {
            $con=1;                        
            $conditions   =  explode(",", $conditions);                        
            $subresult="";
            
            $single=0;
            $length=0;
            foreach($conditions as $ro)
            { 
                $length++;
                if($single==0)
                {
                    $subresult.=$ro."=";               
                    $single=1;
                }
                elseif($length<count($conditions))
                { $subresult.=$ro." AND";$single=0;}
                elseif($length==count($conditions))
                { $subresult.=$ro; $single=0;}
            }
            
            }
            else
                $conditions="1=1";
            
            if($columns!=""&&$rows!=""&&$data!=""&&$con=1)
            {
                $sql='SELECT DISTINCT  '.$rows.','.$columns.','.$datasql.' FROM '.$tables.' WHERE  '.$subresult.'  GROUP BY '.$rows. ' WITH ROLLUP LIMIT '.$start.','.$per_page;            
                $sql2='SELECT DISTINCT  '.$rows.','.$columns.','.$datasql.' FROM '.$tables.' WHERE  '.$subresult.'  GROUP BY '.$rows. ' WITH ROLLUP '; 
            }
            elseif($columns==""&&$rows!="")
            {
                $sql='SELECT DISTINCT '.$rows.' FROM '.$tables. ' GROUP BY '.$rows.' LIMIT '.$start.','.$per_page;  
                $sql2='SELECT DISTINCT '.$rows.' FROM '.$tables. ' GROUP BY '.$rows;   
            }
            elseif($columns!=""&&$rows=="")
            {
                $sql='SELECT DISTINCT  '.$columns.' FROM '.$tables.' GROUP BY '.$columns.' LIMIT '.$start.','.$per_page;       
                $sql2='SELECT DISTINCT  '.$columns.' FROM '.$tables.' GROUP BY '.$columns; 
            }
            elseif($columns!=""&&$rows!=""&&$data=="")
            {
                $sql='SELECT DISTINCT  '.$rows.','.$columns.' FROM '.$tables.' GROUP BY '.$rows.' LIMIT '.$start.','.$per_page;
                $sql2='SELECT DISTINCT  '.$rows.','.$columns.' FROM '.$tables.' GROUP BY '.$rows;
            }
//            elseif($columns!=""&&$rows!=""&&$data!="")
//            {
//                 print CJSON::encode("hello");die(); 
//                $sql='SELECT DISTINCT  '.$rows.','.$columns.','.$datasql.' FROM '.$tables.' GROUP BY '.$rows. ' WITH ROLLUP LIMIT '.$start.','.$per_page;            
//                $sql2='SELECT DISTINCT  '.$rows.','.$columns.','.$datasql.' FROM '.$tables.' GROUP BY '.$rows. ' WITH ROLLUP '; 
//            }
            else
            {
                
            }
            
            $csv_output="";
           
            $result=$connection->createCommand($sql)->queryAll();
            $result2=$connection->createCommand($sql2)->queryAll();
            
            $r=0;
            $c=0;
            $check=$columns;
            $check2=$rows;
            
            
            if($rows!="")
            {
            $r=1;
            $rows   =  explode(",", $rows);            
            }
            
                        
            if($columns!="")
            {
            $c=1;    
            $columns=  explode(",", $columns);
            }
            
            $substring="<tr style='background:yellow'>";
            
            if($r==1)
            foreach($rows as $ro)
                {                    
                    $substring.="<td>".$ro."</td>";
                    $csv_output.=$ro.", ";
                }
               
            if($c==1)
            foreach($columns as $ro2)
                {                    
                    $substring.="<td>".$ro2."</td>";
                    $csv_output.=$ro2.", ";
                }
                 
                
            if($d==1)
            foreach($data as $ro3)
            {               
               $substring.="<td>SUM(".$ro3.")</td>";  
               $csv_output.="SUM(".$ro3.") ,";
            }
                
                
            $substring.="</tr>";
            
            $result_table=$substring;
            $substring="";
            
            foreach($result as $row)
            {                                                 
                if($check2!="")
                {
                foreach($rows as $ro)
                {                    
                    $rores=  explode(".", $ro);                    
                    $substring.="<td>".$row[$rores[1]]."</td>";                    
                }
                }
                
                if($check!="")
                foreach($columns as $ro2)
                {                        
                    $rores=  explode(".", $ro2);
                    $substring.="<td>".$row[$rores[1]]."</td>";                   
                }
                
                if($d==1)
                {
                    foreach($data as $ro)
                        {                        
                            $substring.="<td>".$row["SUM(".$ro.")"]."</td>";                           
                        }
                }                                               
                
                $result_table.="<tr>".$substring."</tr>";
                $substring="";
            }
            
            
            
          // add data for csv file                    
          $count=0;
          $csv_output.="\n";
                  
            foreach($result2 as $row)
            { 
                if($check2!="")                
                {
                $rowcount=0;
                foreach($rows as $ro)
                {                        
                    $csv_output.=$row[$rores[1]].", ";                    
                }
                }              
                
                
                if($check!="")
                {                
                        foreach($columns as $ro2)
                        {                               
                            $csv_output.=$row[$rores[1]].", ";                    
                        }
                }
                
                if($d==1)        
                {                                 
                        foreach($data as $ro)
                        {                                                                                        
                                $csv_output.=$row["SUM(".$ro.")"].", ";                                                                                            
                        }                
                }
                
                
                $csv_output.="\n";                
                $count++;
            }
            
             Yii::app()->session['csv'] = $csv_output;
            // ===================================================
            
            
            // pagination code 
            $pages = ceil($count/$per_page);
            
            $result_table.="<tr><td>";                                    
            $result_table.="<ul id='pagination'>";

                //Pagination Numbers
                for($i=1; $i<=$pages; $i++)
                {
                    $result_table.= '<li id="'.$i.'">'.$i.'</li>';
                }
            
            $result_table.="</ul>";                       
            $result_table.="</td></tr>";
            // ===================================================
            
            
            
            print CJSON::encode($result_table);                     
	}
        
        
        
        
        public function actionExporttocsv()
	{
            $csvcontent= Yii::app()->session['csv']; 
            $file = 'export';
            $filename = $file."_".date("Y-m-d_H-i",time());
            header("Content-type: application/vnd.ms-excel");
            header("Content-disposition: csv" . date("Y-m-d") . ".csv");
            header("Content-disposition: filename=".$filename.".csv");
            print $csvcontent;            
            exit();            
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
            
//            $qtxt = 'SELECT DISTINCT '.$field.' as FieldName,COUNT('.$field.') As FieldCount from '.$table.' GROUP BY '.$field.' ORDER BY '.$field.';';
//      
//           
//            $connection=Yii::app()->db;                                     
//            $result=$connection->createCommand($qtxt)->queryAll();
//            
////            print_r($fields);
////            die();
//            
////            foreach($fields as $row)
////            {
////                
////            }
//            
//		$this->render('draw',array(
//                    "result"=>$result,"table"=>$table,"field"=>$field
//                ));    			
	}
        
        
        function percent($num_amount, $num_total) {
            $count1 = $num_amount / $num_total;
            $count2 = $count1 * 100;
            $count = number_format($count2, 0);
            echo $count;
        }
        
        
        
       
       
        
     
        
        
        
        
        
}
?>
