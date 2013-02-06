
<script type="text/javascript" src="/AjmanLandProperty/js/jquery-1.8.1.min.js"></script> 
             <script>
                   
             
               var landid ='<?php echo $landid; ?>'
            $.ajax({ 
                                type: "POST",
				url:'http://localhost/AjmanLandProperty/index.php/CustomerService/Search', 
				data: "action=search&string="+landid+"&returnType=ws",
                                async:false,
				success: function(data) { 
					var Results = JSON.parse(data); 	
					console.log(Results);                                        
                                        document.write(data);                               
				}
                        });  
                                                     
             </script> 