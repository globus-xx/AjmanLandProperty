<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   


<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="text/javascript" src="../../js/jquery-1.8.1.min.js"></script> 
       
<script type="text/javascript">
            
      $(document).ready(function() {
      
                        $("#printForm").submit(function(event) 
                        {                             
                            event.preventDefault();
                               
                                
                                
                            $.post("lettersave"  , { lettertext: $("#goman").val() });
                            
                            
                            
                            var mywindow = window.open('', 'my div', 'height=400,width=600');
                            mywindow.document.write('<html><head><title>my div</title>');
                            /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
                            mywindow.document.write('</head><body >');
                            mywindow.document.write($("#goman").val());
                            mywindow.document.write('</body></html>');

//                           if(1)
//                               {
//                                    //$.post("lettersave"  , { lettertext: $("#goman").val() });                                   
//                                    
//                                    
//                               }
                            
                            
                            mywindow.print();
                            mywindow.close();                           
                            
      
                           //window.close();                                        
                          
                        });
		});  
                
                
                
  
</script>


    </head>
    
<body>
        
              
<div id="printarea" style="width:800px;margin:0 auto;padding:50px;border:5px solid black; ">
    
<?php
        echo $lettertext;
        
        echo "<br><hr>";


if($lettertext!="")
{
?>
<center>

    
    <table>
        
        <tr>
                       
            <td>
                                    
                <input type="button" value="اغلاق"  style="width:150px;"  onclick="window.close();">
                               
            </td>
            
            <td>                
                <form action="updateletter" method="post">
                <textarea name="ftext" style="display:none;"><?php echo $lettertext ?></textarea>
                <input type="hidden" name="title" value="<?php echo $title ?>" >
                <input type="submit" value="تعديل" style="width:150px;"> 
                </form>
            </td>
            
            <td>                
                <form action="downloadletter" method="post"  >
                <textarea name="ftext" style="display:none;"><?php echo $lettertext ?></textarea>
                <input type="hidden" name="title" value="<?php echo $title ?>" >
                <input type="submit" value="توليد ملف" style="width:150px;"> 
                </form>
            </td>
        
            
            <td>
                <form   id="printForm" method="post" name="printForm">    
                    <textarea name="ftext" style="display:none;" id="goman"><?php echo $lettertext ?></textarea>
                    <input type="submit" value="طباعة"  style="width:150px;"  >
                </form>                
            </td>
            
            
            
            
        </tr>
            
    </table>    
    






    
    

    
</center>


<?php
}
?>
</div>
    
    
    



</body>
</html>









