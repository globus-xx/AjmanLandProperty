<center>
<?php
if(isset($mess))
{
    echo $mess;
}
?>
</center>

<h2> البيانات الشخصية </h2>
<div style="direction: rtl;float:right;">
<form action="<?php echo Yii::app()->request->baseUrl; ?>/index.php/site/updateUser" method="post">
  <table style="direction:rtl;width:361px;float:left;">
      
    <?php
    foreach($userdata as $row)
    {
        ?>
    <tr><td><input type="hidden" name="id" value="<?php echo $row->id; ?>" ></td></tr>
    
    <?php
    foreach($userprofile as $row2)
    {
    ?>
    <tr><td>الاسم الاول :</td><td><input type="text" name="fname" value="<?php echo $row2->firstname; ?>" style="width:200px;"></td></tr>
    <tr><td>الاسم الاخير :</td><td><input type="text" name="lname" value="<?php echo $row2->lastname; ?>" style="width:200px;"></td></tr>
   <?php
    }
   ?>
    
    <tr><td>كلمة المرور :</td><td><input type="password" name="userpassword" onclick="this.value=''" value="<?php echo $row->password; ?>" style="width:200px;"></td> </tr>
    <tr><td>البريد الالكتروني :</td><td><input type="text" name="useremail" value="<?php echo $row->email; ?>" style="width:200px;"></td></tr>            
        <?php
    }
        ?>
        
    
    
   <tr><td></td><td> <input type="submit" value="تعديل"></td></tr>
  </table>
</form>
</div>