

<form action="generatefile" method="post" >

<table style="width:500px;">
<tr><td>ادخل المعلومات التالية من فضلك :</td></tr>
<tr><td>land id</td><td>:</td><td><input type="text" name="landid" size="20" dir="ltr"></td></tr>
<tr><td>destination of the letter</td><td>:</td>
    <td>
       
   
        <?php
		$url = $this->createUrl("Letters/autow");
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'name'=>'destination',
                    'source'=>$url,
                    // additional javascript options for the autocomplete plugin
                    'options'=>array(
                    'minLength'=>'4',
                    ),
                    'htmlOptions'=>array(
                        'style'=>'width:150px;'
                    ),
                ));
                
                
            ?>
    </td></tr>
<tr><td>Land description</td><td>:</td><td><input type="text" name="landdesc" size="20" dir="ltr"></td></tr>
<tr><td>Land price (if required)</td><td>:</td><td><input type="text" name="landprice" size="20" dir="ltr"></td></tr>
<tr><td colspan="3"><input type="hidden" name="userid" value="<?php $gouser= Yii::app()->user->id;echo $gouser; ?>" ><input type="submit" name="go" value="التالي"></td></tr>
</table>
    <input type="hidden" value="<?php echo $id ?>" name="letterid">
</form>





