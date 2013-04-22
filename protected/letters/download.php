<?php

header("Pragma: no-cache"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false); // required for certain browsers
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=\"profile_.doc");
header("Content-Transfer-Encoding: binary");
ob_clean();
flush();



echo $text;
?>

