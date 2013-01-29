<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination
$targetFolder = '/AjmanLandProperty/images/uploads'; // Relative to the root

$verifyToken = md5('unique_salt' . $_POST['timestamp']);
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png','JPEG','JPG'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
        $tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
        $fileName = time().".".$fileParts['extension'];
	$targetFile = rtrim($targetPath,'/') . '/' . $fileName;$_FILES['Filedata']['name'];
	
	if (in_array($fileParts['extension'],$fileTypes)) {
//                        $sql = 'insert into images set item="deed" , land_id="'.$_POST['landID'].'", item_id="'.$_POST['deedID'].'", created_on="'.date('Y-m-d').'", caption="'.$_FILES['Filedata']['name'].'", image="'.time().".".$fileParts['extension'].'"';
//                $link = mysql_connect('localhost', 'root', '');
//                if (!$link) {
//                    die('Not connected : ' . mysql_error());
//                }
//
//                // make foo the current db
//                $db_selected = mysql_select_db('AjmanLandProperty', $link);
//                if (!$db_selected) {
//                    die ('Can\'t use foo : ' . mysql_error());
//                }
//
//            mysql_query($sql) or die(mysql_error());
        move_uploaded_file($tempFile,$targetFile);
		echo $fileName;
	} else {
		echo 'Invalid file type.';
	}
}
?>