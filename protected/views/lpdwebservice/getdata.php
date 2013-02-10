
<script type="text/javascript" src="/AjmanLandProperty/js/jquery-1.8.1.min.js"></script> 
             <script>
                   
             
               var landid ='<?php echo $landid; ?>'
               var base='<?php echo Yii::app()->request->baseUrl;?>';
            $.ajax({ 
                                type: "POST",
				url:base + "/index.php/CustomerService/Search", 
				data: "action=search&string="+landid+"&returnType=ws",
                                async:false,
				success: function(data) { 
					var Results = JSON.parse(data); 	
					console.log(Results);

                                                             
				}
                        });  
                                                     
             </script> 