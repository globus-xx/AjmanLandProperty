<h1>نظام ادارة الملفات</h1>


<form action='<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/scan' id='land_check_form' method='post'>
<label>من فضلك ادخل رقم الارض  :</label>            
    <input type='text' name='land_id_txt' id='land_id_txt' />               
    <input type='submit' name='sub' value='اختر وانتقل الى المرحلة الثانية'>
</form>

    

<script>
 $( "#land_id_txt" ).autocomplete({
		source: "<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/get_lands",
		minLength: 2,
		focus: function( event, ui ) {
			$("#land_id_txt").val( ui.item.LandID );
			return false;
		},
		select: function( event, ui ) {
			$("#land_id_txt").val(ui.item.LandID);			
			return false;
		  }
		}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
			return $( "<li>" )
			.append( "<a>" + item.LandID + "</a>" )
			.appendTo( ul );
		};    
                
                
     $( "#land_check_form" ).submit(function(){
            
        if($("#land_id_txt").val()!="")
        {                             
        var i=0;
        
                $.ajax({
                    type: "POST",
                    url: "<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/check_land",
                    data: "landid="+$("#land_id_txt").val(),
                    async : false,
                    success: function(data) {                            
                        if(data=="true")                            
                        {  
                             
                           
                           $.ajax({
                                type: "POST",
                                url: "<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/check_folder",
                                data: "landid="+$("#land_id_txt").val(),
                                async : false,
                                success: function(data2) {                                        
                                    if(data2=="true")                            
                                    {                                                                                
                                       if (confirm('يوجد ملفات محملة مسبقا في النظام  ,هل تريد المتابعة ؟')) {
                                            // Save it!
                                            i=1;
                                        } else {
                                            // Do nothing!
                                            i=2;
                                        }
                                    }
                                    else
                                        i=1;
                                }
                            });
                
                
                        }
                    }
                });
                
                
                if(i===1)
                return true;
                else if(i===2)
                return false;
                else
                    {alert("عفوا ... رقم الارض غير صحيح!!!");return false;}
        }
        else
        {
        alert("من فضلك ادخل رقم الارض");
        return false;
        }
        
     });     
                
</script>




