<?php


class ReportsControllerTest extends CDbTestCase
{
    

public function testCalulate()
{
       
    $reports=new ReportsController();   
    
    try{
    $reports->actionCalulate();
    return true;
    }
    catch (Exception $e)
    {
        return FALSE;
    }
            
}

}

?>


