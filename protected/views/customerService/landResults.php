
<?php $test = CJSON::decode($customerws);
if(isset($_POST["wstype"])){
    if($_POST["wstype"]=='demo'){
    ?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<?php 

print "<p>JSON String<br>".$customerws."<p>";
print "<p>After Parsing<p>";
print_r($test);
extract($test);}
}else 
    print $customerws;

?>
