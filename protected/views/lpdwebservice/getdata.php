
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
    
    
    <body>
        
        
    
<script type="text/javascript" src="/AjmanLandProperty/js/jquery-1.8.1.min.js"></script> 
             <script>
                  
        
        
             
               var landid ='<?php echo $landid; ?>'
               var base='<?php echo Yii::app()->request->baseUrl;?>';
               var retureddata='<?php echo $returneddata; ?>'
               alert(landid)
            $.ajax({ 
                                type: "POST",
				url:base + "/index.php/CustomerService/ws", 
				data: "string='"+landid+"'",
                                async:false,
				success: function(data) { 
			           debugger
                                   var Results = JSON.parse(data); 	
			           console.log(Results);  
//                                   var a = Array.prototype.slice.call(Results);
                                   document.write( JSON.stringify(Results));                                                                                
                                   
                                   
				}
                  });  
                                                     
             </script> 
             
             
   </body>          
</html>