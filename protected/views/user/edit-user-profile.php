<center>
<?php
if(isset($mess))
{
    echo $mess;
}
?>
</center>

<form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php/site/updateUser" method="post">
  <table style="direction:ltr;width:300px;float:left;">
      
    <?php
    foreach($userdata as $row)
    {
        ?>
    <tr><td><input type="hidden" name="id" value="<?php echo $row->id?>"></td></tr>
    
     <?php
    foreach($userprofile as $row2)
    {
        ?>
    <tr><td>First Name :</td><td><input type="text" name="fname" value="<?php echo $row2->firstname?>" style="width:200px;"></td></tr>
    <tr><td>Last Name :</td><td><input type="text" name="lname" value="<?php echo $row2->lastname?>" style="width:200px;"></td></tr>
   <?
    }
   ?>
    
    <tr><td>Password :</td><td><input type="password" name="userpassword" value="<?php echo $row->password?>" style="width:200px;"></td> </tr>
    <tr><td>Email :</td><td><input type="text" name="useremail" value="<?php echo $row->email?>" style="width:200px;"></td></tr>            
        <?
    }
        ?>
        
    
    
   <tr><td> <input type="submit" value="Update"></td><tr>
  </table>
</form>
