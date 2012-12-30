<html>
	
<style>

table, th, td
{
	border: 1px solid black;
}

</style>
<body dir="rtl" >
<!--    <form id="SearchForm" method="post">من فضلك ادخل أي كلمة
        <input type="text" id="searchstring" name="searchstring">
        <input type="submit" value ="البحث">
    </form>-->
     
	
	
	  <?php 

//		$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
//			'name'=>'searchstring',
//			'source'=>$autocomplete, //came from the controller.. the array we constructed of all names, arabic and english
//			// additional javascript options for the autocomplete plugin
//			'options'=>array(
//				'minLength'=>'4',
//			),
//			'htmlOptions'=>array(
//				'style'=>'height:20px;'
//			),
//		));
	?>
     <form id="SearchForm" method="post">من فضلك ادخل أي كلمة
    <?php
		$url = $this->createUrl("CustomerService/CustomerSearch");
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'name'=>'searchstring',
                    'source'=>$url,
                    //'source'=>$customerNames, //came from the controller.. the array we constructed of all names, arabic and english
                    // additional javascript options for the autocomplete plugin
                    'options'=>array(
                        'minLength'=>'3',
                    ),
                    'htmlOptions'=>array(
                        'style'=>'height:20px;'
                    ),
                ));
            ?>
 <input type="submit" value ="البحث">
    </form>
	
	<br><br>
<form action="Letters/generatefile" method="post" id="letterForm" name="letterForm" target="_SELF" >	
	<div class='searchresult'>
	
		<div id='landresult'>
			<h6>معلومات لرقم سند : <span id='landid'></span></h6>
			
			<table id='landinfo'>
			</table>
			
                        
			<h6>Current Owners:</h6>
			<table id='currentowners'>
				<th>customer ID</th>	<th>Customer Name</th>	<th>Nationality</th>	<th>Share</th>
			</table>
			
			<h6>Previous Owners:</h6>
			<table id='previousowners'>
				<tr><th>Date 1</th></tr>
					<th>customer ID</th>	<th>Customer Name</th>	<th>Nationality</th>	<th>Share</th>			
			</table>			                          
                        
                        

                       
                        
		</div>
             <div id='previouslandresult'></div>
            <div id='fines'></div>
            <div id='previousowner'></div>

            
                
                
		<div id='customerresult'>
			Info for Customer Name: Omar Ali Ibrahim
		</div>
		
		<div id='areasearch'>
			List of Lands in a certain area
		</div>
		
		<div id='countryresult'>
			Loading...
		</div>
                
                <div id='loadingresult'>
			Loading...
		</div>
            
                <div id='customerprofile'>
			Loading...
		</div>
            
            
            


<table style="width:350px;">
    
<tr><td>وجهة الرسالة :</td>
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

<tr><td>وصف الارض :</td><td><input type="text" name="landdesc" size="20" dir="ltr"></td></tr>
<tr><td>سعر الارض (ليس ضروري) :</td><td><input type="text" name="landprice" size="20" dir="ltr"></td></tr>

<tr><td >من فضلك اختر نوع الرسالة :</td>   
    <td>
        <select name="letterid" style="width:155px;height:23px;">  
                   
           <?php 
            foreach($docs as $row)
           { 
             ?>  
                     <option value="<?php echo $row->LetterID ?>"><?php echo $row->Title ?></option>           
           <?php
            }
           ?>
            
        </select> 
    </td>
</tr>
<tr><td>
        <input type="hidden" name="landid" id="landid" value="">       
        <input type="submit" name="stype" value="التالي" ></td></tr>

</table>

</form>               	            
            
            
         






	</div>
	
</body>

	<script type='text/javascript'>
		var listType;
		//Hide all on-load
		$('#landresult').hide(); 
		$('#customerresult').hide(); 
		$('#areasearch').hide();
		$('#countryresult').hide();
                $('#loadingresult').hide();
                $('#customerprofile').hide();
		
                
//                $("#letterFofrm").submit(function(event) 
//		{ event.preventDefault();
//                    			
//			//var paramJSON = JSON.stringify(searchstring);	 //ensuring that info sent to the server is stringed!
////			var paramJSON = JSON.stringify("action=search&str
//                
//                $.ajax({ 
//                                type: "POST",
//				url:'Letters/generatefile', 
//				data: "action=generatefile&landid="+$("#searchstring").val()+"&letterid=12&destination="+$("#destination").val(),
//                                async:false,
//				success: function(data) { 
//					var Results = JSON.parse(data); 	
//					console.log(Results);
//					//LAND ID entered and only 1 returned LAND ID	
//                                  
//                                letterResult(Results);                                                
//                  }});
//                
//                });
                
//                
//                function letterResult(Results){
//                    
//                    var res=Results;
//                    $("#landRes").html(Results);
//                    
//                    
//                    
//                }

//                    function getvalue()
//                    {                         
//                         document.getElementsById('landidd').Value = $("#searchstring").val();
//                    }
                
                
		$("#SearchForm").submit(function(event) 
		{ event.preventDefault();
                    $('#letterForm #landid').val($('#searchstring').val())
//                    alert( $('#letterForm #landid').val());
                    
			 $('#loadingresult').show();
                        var searchstring =  new Array();
//			 searchstring["string"] = $("#searchstring").val();
                          searchstring["action"] = "search";


			var paramJSON = JSON.stringify(searchstring);	 //ensuring that info sent to the server is stringed!
//			var paramJSON = JSON.stringify("action=search&string="+$("#searchstring").val());
                        $.ajax({ 
                                type: "POST",
				url:'CustomerService/Search', 
				data: "action=search&string="+$("#searchstring").val(),
                                async:false,
				success: function(data) { 
					var Results = JSON.parse(data); 	
					console.log(Results);
					//LAND ID entered and only 1 returned LAND ID	
				
					//One particular customer-name found
					if (Results.length ==1 && Results[0]['CustomerID'])
					{
						hideAll(); 
						$('#customerresult').show(); 
						
						console.log(Results);
						displayCustomerInfo(Results);
					}
					
					//A country was entered, and a list of customers belonging to the country are returned
					else if (Results.length >1 && Results[0]['CustomerID'])
					{
						hideAll();
						
						console.log(Results);
						displayCountryInfo(Results);
                                                $('#loadingresult').hide();
						
					}
                                        
//                                            if(typeof(Results["current"])!=undefined){	
                                        else if (typeof(Results["landInfo"])!="undefined" )
					{ 
                                                 hideAll();
						$('#landresult').show();
                                               

						console.log(Results);
						displayLandInfo(Results);
						
					}	
//				}
				 $('#loadingresult').hide();		
				}
                        });
                        
                        $('.searchLink').unbind('click').click(function(){
                            var searchString = $(this).text()
                             $("#searchstring").val(searchString);
                              $("#SearchForm").trigger('submit')
                          });
                          
                          $('.searchLink2').unbind('click').click(function(){
                            var searchString = $(this).text()
                             $("#searchstring").val(searchString);
                              $("#SearchForm").trigger('submit')
                          });
                        
                          

		});

	</script>		<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/search.js'); ?>

</body>
</html>


