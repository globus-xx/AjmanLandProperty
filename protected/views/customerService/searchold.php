<html>
	
<style>

table, th, td
{
	border: 1px solid black;
}

</style>
<body dir="rtl" >
    <form id="SearchForm" method="post">
        <input type="text" id="searchstring" name="searchstring">Pl enter
        <input type="submit">
    </form>
     
	
	
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
	
	<br><br>
	
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
	
	</div>
	
</body>

	<script type='text/javascript'>
		
		//Hide all on-load
		$('#landresult').hide(); 
		$('#customerresult').hide(); 
		$('#areasearch').hide();
		$('#countryresult').hide();
                $('#loadingresult').hide();
                 $('#customerprofile').hide();
		
		$("#SearchForm").submit(function(event) 
		{ event.preventDefault();
                   
//						$('#loadingresult').show();
                    
			 $('#loadingresult').show();
                        var searchstring =  new Array();
//			 searchstring["string"] = $("#searchstring").val();
                          searchstring["action"] = "search";

//			if (searchstring["string"].length<4)
//			{
//				return;
//			} 
//                        alert(searchstring["action"]);
			var paramJSON = JSON.stringify(searchstring);	 //ensuring that info sent to the server is stringed!
//			var paramJSON = JSON.stringify("action=search&string="+$("#searchstring").val());
                        $.ajax({ 
                                type: "POST",
				url:'CustomerService/Search', 
				data: "action=search&string="+$("#searchstring").val(),
				success: function(data) { 
					var Results = JSON.parse(data); 	
					console.log(Results);
					//LAND ID entered and only 1 returned LAND ID	
					if (Results.length ==1 && Results[0]['LandID'])
					{
						$('#landresult').show();
						$('#customerresult').hide(); 
						$('#areasearch').hide();
						$('#countryresult').hide(); 
						console.log(Results);
						displayLandInfo(Results);
						
					}	
					
					//One particular customer-name found
					if (Results.length ==1 && Results[0]['CustomerID'])
					{
//                                            alert("I am here"+Results[0]['CustomerNameArabic']);
						$('#landresult').hide();
						$('#customerresult').show(); 
						$('#areasearch').hide();
						$('#countryresult').hide(); 
						console.log(Results);
						displayCustomerInfo(Results);
					}
					
					//A country was entered, and a list of customers belonging to the country are returned
					if (Results.length >1 && Results[0]['CustomerID'])
					{
						$('#landresult').hide();
						$('#customerresult').hide(); 
						$('#areasearch').hide();
						$('#countryresult').show(); 
						console.log(Results);
						displayCountryInfo(Results);
                                                $('#loadingresult').hide();
						
					}
						
				}
                        });

		});
		function userTab(){
                            var userTab="<table><tr><td><a onclick=switchToView('customerresult')>Back to user listing</a></td>" ;

                                        userTab+="<td><a onclick=switchToView('customerprofile')>User Profile</a></td>" ;
                                        userTab+="<td align='right'><a onclick=switchToView('landresult')>Land List</a></td>";
            //                            
            //                            userTab+="<td> عنوان المنزل</td>" ;
            //                            userTab+="<td>القطعة</td>" ;
            //                            userTab+="<td></td>" ;
                                        userTab+="</tr>" ;
                               return userTab+="</table>";
                }   
                function switchToView(viewName){
//                viewName = "#"+viewName
//                alert("here"+viewName)
                 
                   hideAll()
						$("#"+viewName).show(); 
//                                                if(viewName=='land') $("#landresult").show(); 
//                                                if(viewName=='customer') $("#customerresult").show(); 
                }
                function hideAll(){
                        $('#landresult').hide();
                        $('#customerresult').hide(); 
                        $('#areasearch').hide();
                        $('#countryresult').hide(); 
                        $("#customerprofile").hide(); 
                }
                
		function displayLandInfo(result)
		{
			$('#landid').text(result[0]['LandID']);
			
			//****************************Land Info Table*****************************************
			var landstr = "<tr><td>"+result[0]['location']+"</td>	<td>Plot No: "+result[0]['Plot_No']+"</td><td>Piece No: "+result[0]['Piece']+"</td><td>Total Area: "+result[0]['TotalArea']+"</td></tr><tr><td>شمالا: "+result[0]['North']+"</td><td>جنوبا: "+result[0]['South']+"</td><td>شرقا: "+result[0]['East']+"</td><td>غربا: "+result[0]['West']+"</td></tr>";
						
			$('#landinfo').empty();
			$('#landinfo').html('<tbody></tbody>');
			$('#landinfo').find('tbody').append(landstr);
			//*************************************************************************************
			
			//*************************Current Owners**********************************************
			
			var currentowners = "<tr><td>ID</td><td>Omar</td><td>Palestine</td><td>100%</td></tr>"
								
			$('#currentowners').empty();
			$('#currentowners').html('<tbody><th>customer ID</th>	<th>Customer Name</th>	<th>Nationality</th>	<th>Share</th></tbody>');
			$('#currentowners').find('tbody').append(currentowners);
			
		}
		
		function displayCustomerInfo(Results)
		{   
                    
                    
                    var userdetailsContent = "<table dir=rtl>";
                    
                    userdetailsContent+="<tr ><td colspan= 6>  " ;
                    userdetailsContent+= userTab();
                    userdetailsContent+="</td></tr>" ;
//                    userdetailsContent+="<tr><td>"+ Results[0]["CustomerNameArabic"]+" <td></tr>"
                    
//                    userdetailsContent+="<tr><td> "+ Results[0]["HomeAddress"]+" <td></tr>"
                    
//                    userdetailsContent+="<tr><td>  "+ Results[0]["HomePhone"]+"  <td></tr>";
                    
//                    userdetailsContent+="<tr><td>"+ Results[0]["CustomerNameArabic"]+"</td></tr>";
 
//                    userdetailsContent+="<tr><td>"+ Results[0]["CustomerNameArabic"]+"</td></tr>";
                    
                    userdetailsContent+="<tr><td>الإسم -- عربي</td><td>"+ Results[0]["CustomerNameArabic"]+"</td></tr>";
                    userdetailsContent+="<tr><td>عنوان المنزل</td><td>"+ Results[0]["HomeAddress"]+"</td></tr>";
                    userdetailsContent+="<tr><td>هاتف المنزل</td><td>"+ Results[0]["HomePhone"]+"</td></tr>";
                    userdetailsContent+="<tr><td></td><td>"+ Results[0]["MobilePhone"]+"</td></tr>";
                    
                    userdetailsContent+="<tr><td>هاتف محمول</td><td>"+ Results[0]["DateofBirth"]+"</td></tr>";
                    
                    userdetailsContent+="<tr><td>تاريخ الميلاد</td><td>"+ Results[0]["DateofBirth"]+"</td></tr>";
                    
                    userdetailsContent+="<tr><td>جنسية</td><td>"+ Results[0]["Nationality"]+"</td></tr>";
                    
                    userdetailsContent+="<tr><td>البريد الإلكتروني</td><td>"+ Results[0]["EmailAddress"]+"</td></tr>";
                    
                    userdetailsContent+= "</table>";
                    
                     $("#customerprofile").html(userdetailsContent);
                    
                    
                    var content ="<div><ol style='margin: 50px'>";
                    for(var i = 0 ; i<Results.length; i++){
                        var index = i+1
                        if(content.length >1)
                              var content =content+"<li style='float:right; width: 250px;'>&nbsp;<a onclick='diplayUserDetails("+Results[i]['CustomerID']+")'   target='blank'>"+Results[i]['CustomerNameArabic']+"</a> </li>" 
//                        else
//                              var content ="<li>+"index+")&nbsp; <a href='customerMaster/"+Results[i]['CustomerID']+"' target='blank'>"+Results[i]['CustomerNameArabic']+"</a></li>"


                    }	
                    content +="</ol></div>";
                    content +="";
                    $("#customerresult").html(content);
		}
		function diplayUserDetails(customerID){
//                    function(event) 
//		 preventDefault();
//                 alert("Ia am here");
//                 event.preventDefault();
                 
                 $('#loadingresult').show();
                        var searchstring = []
			 searchstring["string"] = customerID;
                          searchstring["action"] = "search";

//			if (searchstring.length<4)
//			{
//				return;
//			}

			var paramJSON = JSON.stringify(searchstring);	 //ensuring that info sent to the server is stringed!
                             $.ajax({ 
                                type: "POST",
				url:'CustomerService/Search', 
				data: "action=propertySearch&string="+customerID,
				success: function(data) 
				{ 
					var Results = JSON.parse(data); 	
					console.log(Results);
					//LAND ID entered and only 1 returned LAND ID
                                        
                                         var content ="<table border=1 dir='rtl' class='items'>";
                    
                    
                    
                    var width = "130px";
                    content+="<tr ><td colspan= 6>  " ;
                    content+=       userTab();
                    content+="</td></tr>" ;
                    
                    content+="<tr><td>رقم الارض</td>" ;
                     content+="<td align='right'>نوع الارض </td>";
                     content+="<td></td>" ;
                     content+="<td> عنوان المنزل</td>" ;
                     content+="<td>القطعة</td>" ;
                     content+="<td></td>" ;
                     content+="</tr>" ;

//                    alert(Results[0]['LandID'])
                    for(var i = 0 ; i<Results.length; i++){
                        var index = i+1
                        if(content.length >1)
                              content=content+"<tr><td>"+i+"</td>" ;
                              content+="<td><a onclick='diplayUserDetails("+Results[i]['LandID']+")' target='blank'>"+Results[i]['LandID']+"</a> </td>";
                              content+="<td>"+Results[i]['Land_Type']+"</td>" ;
                              content+="<td>"+Results[i]['location']+"</td>" ;
                              content+="<td>"+Results[i]['TotalArea']+"</td>" ;
                              content+="<td>"+Results[i]['North']+","+Results[i]['']+"</td>" ;
                              content+="</tr>" ;

//                        else
//                              var content ="<li>+"index+")&nbsp; <a href='customerMaster/"+Results[i]['CustomerID']+"' target='blank'>"+Results[i]['CustomerNameArabic']+"</a></li>"


                    }	
                    content +="</table>";
                    $("#landresult").html(content);
                    hideAll();
                    $("#landresult").show();
					if (Results.length >1 )
					{
//						$('#landresult').show();
//						$('#customerresult').hide(); 
//						$('#areasearch').hide();
//						$('#countryresult').hide(); 
//						console.log(Results);
//						displayLandInfo(Results);
						
					}	
				}
                           });
                }
		function displayCountryInfo(Results)
		{
//                    alert("I am here"+Results.length+Results[0]['CustomerNameArabic'].substring(0, 1));
                    var content ="<table border=1 dir='rtl' class='items'>";
                    var width = "130px";
                     content+="<tr><td>رقم العميل</td>" ;
                     content+="<td align='right'>الإسم -- عربي </td>";
                     content+="<td>ألإسم -- إنجليزي</td>" ;
                     content+="<td> عنوان المنزل</td>" ;
                     content+="<td>هاتف المنزل</td>" ;
                     content+="<td>هاتف محمول</td>" ;
                     content+="</tr>" ;

                    
                    for(var i = 0 ; i<300; i++){
                        var index = i+1
                        if(content.length >1)
                              content=content+"<tr><td>"+i+"</td>" ;
                              content+="<td><a onclick='diplayUserDetails("+Results[i]['CustomerID']+")'  target='blank'>"+Results[i]['CustomerNameArabic']+"</a> </td>";
                              content+="<td>"+Results[i]['CustomerNameEnglish']+"</td>" ;
                              content+="<td>"+Results[i]['HomeAddress']+"</td>" ;
                              content+="<td>"+Results[i]['HomePhone']+"</td>" ;
                              content+="<td>"+Results[i]['MobilePhone']+"</td>" ;
                              content+="</tr>" ;

//                        else
//                              var content ="<li>+"index+")&nbsp; <a href='customerMaster/"+Results[i]['CustomerID']+"' target='blank'>"+Results[i]['CustomerNameArabic']+"</a></li>"


                    }	
                    content +="</table>";
                    $("#countryresult").html(content);
		}
	</script>
</body>
</html>


