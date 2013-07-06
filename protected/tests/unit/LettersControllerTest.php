<?php


class LettersControllerTest extends CDbTestCase
{
    
public function testDelete($id)
{       
    $letter=new LettersController();       
    $this->assertTrue($letter->delete($id));            
}


}

?>


