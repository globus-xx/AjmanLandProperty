<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h2> Saving The Xml File </h2>
<form action="http://localhost/AjmanLandProperty/index.php/CustomerService/ws/" method="post">
    
    <input type="text" name="string" value="<?php echo $landid?>">
    <input type="hidden" name="wstype" value="demo">
    <input type="hidden" name="print" value="0">
    <input type="submit">
</form>






<h2> Print The Xml Output </h2>
<form action="http://localhost/AjmanLandProperty/index.php/CustomerService/ws/" method="post">
    
    <input type="text" name="string" value="<?php echo $landid?>">
    <input type="hidden" name="wstype" value="demo">
    <input type="hidden" name="print" value="1">
    <input type="submit">
</form>