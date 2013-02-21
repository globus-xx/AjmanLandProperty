<?php 
// initializing or creating array
$posteddata = $customerws;

// creating object of SimpleXMLElement
$xml_student_info = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\" ?><ajmanlandproperty></ajmanlandproperty>");

// function call to convert array to xml
array_to_xml($posteddata,$xml_student_info);

//saving generated xml file
$xml_student_info->asXML("webservice.xml");



if (file_exists("webservice.xml")) {      
    header("Location:".Yii::app()->request->baseUrl."/webservice.xml");   
}



// function defination to convert array to xml
function array_to_xml($student_info, &$xml_student_info) {
    foreach($student_info as $key => $value) {
        if(is_array($value)) {
            if(!is_numeric($key)){
                $subnode = $xml_student_info->addChild("$key");
                array_to_xml($value, $subnode);
            }
            else{
                array_to_xml($value, $xml_student_info);
            }
        }
        else {
            $xml_student_info->addChild("$key","$value");
        }
    }
}


?>
