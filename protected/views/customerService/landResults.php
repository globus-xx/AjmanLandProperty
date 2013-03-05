<?php 

$webservicefilename="webservice_".$landid."_".time().".xml";
$filepath="/webservice/".$webservicefilename;
$filerelatedurl="webservice/".$webservicefilename;


// initializing or creating array
$posteddata = $customerws;

// creating object of SimpleXMLElement
$xml_student_info = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\" ?><ajmanlandproperty></ajmanlandproperty>");

// function call to convert array to xml
array_to_xml($posteddata,$xml_student_info);


if($print==1)
    print $xml_student_info->asXML();

else
{
//saving generated xml file
$xml_student_info->asXML($filerelatedurl);



if (file_exists($filerelatedurl)) { 
    
    
                $dbFilename=$webservicefilename;
                
                $post=new WebserviceLogs;
                $post->File_Name=$dbFilename;                  
                $post->save(); 
                
               
                
    header("Location:".Yii::app()->request->baseUrl.$filepath);   
}

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
