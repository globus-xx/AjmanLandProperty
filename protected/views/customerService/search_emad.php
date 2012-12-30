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
		function landTab(listType, customerID){
                           var userTab="<table><tr>"
//                               if(listType ==1){ 
                                   
                                   userTab+="<td><a onclick=switchToView('landresult')>Back to land details</a></td>" ;
                                    userTab+="<td><a onclick=switchToView('fines')>Fines and Remarks</a></td>" ;
                                        userTab+="<td align='right'><a onclick=switchToView('previousowner')>Previous Owners</a></td>";
                                        userTab+="</tr>" ;
                               return userTab+="</table>";
                } 
                		function userTab(listType, customerID){
                                   
                           var userTab="<table><tr><td>"
                               if(listType ==1){ 
                                   userTab+="<a onclick=switchToView('countryresult')>Back to user listing</a></td>" ;
                                   userTab+="<td><a onclick=_displayCustomerProfile("+customerID+");switchToView('customerprofile')>User Profile</a></td>" ;
                                }else { 
                                
                                    userTab+="<a onclick=switchToView('customerresult')>Back to user listing</a></td>" ;
                                    userTab+="<td><a onclick=switchToView('customerprofile')>User Profile</a></td>" ;
                                
                                }

                                        userTab+="<td align='right'><a onclick=switchToView('landresult')>Land List</a></td>";

                                        userTab+="</tr>" ;
                               return userTab+="</table>";
                } 
                function switchToView(viewName){
                   hideAll()
                   $("#"+viewName).show(); 
                }
                function hideAll(){
                        $('#fines').hide();
                        $('#currentowner').hide();
                        $('#previousowner').hide();
                        $('#landresult').hide();
                        $('#customerresult').hide(); 
                        $('#areasearch').hide();
                        $('#countryresult').hide(); 
                        $("#customerprofile").hide(); 
                }
                function showDeedCustomersTR(deedid){
                    
                    if($('.'+deedid).is(":visible")) 
                        $('.'+deedid).hide()
                    else
                        $('.'+deedid).show()
                }
                
                function doSearchSubmit(searchString){
                    $("#searchstring").val(searchString);

                    $("#SearchForm").trigger('submit')
                    
                }
		function displayLandInfo(Results)
		{   
                     var currentOwnersContent = "<table dir=rtl>";

                    currentOwnersContent+="<tr><td colspan='2'>Current Users</td></tr>";
                    currentOwnersContent+="<tr><td>customer name </td><td> customer nationality</td><td>Share(%)</td></tr>";
                    if(typeof(Results["current"]["customers"])!="undefined"){
                        var arrayNode= Results["current"]["customers"];
                        
                        for(var i = 0; i<arrayNode.length ; i++ ){
                            currentOwnersContent+="<tr><td> <input type='checkbox' name='cuowners[]' value="+arrayNode[i]["CustomerID"]+"><a class='searchLink' >"+ arrayNode[i]["CustomerNameArabic"]+"</a></td>";
                            currentOwnersContent+="<td>"+ arrayNode[i]["Nationality"]+"</td>";
                            currentOwnersContent+="<td> <a onlick=''>"+ arrayNode[i]["Share"]+"</a></td>";
                            currentOwnersContent+=" </tr>"
                            
                            
                        }
                       
                    } else{
                     currentOwnersContent+="<tr><td>Sorry no results found in this category</td></tr>"
                         
                     }  
                     currentOwnersContent+= "</table>";
//                     $("#currentowner").html(currentOwnersContent);
                        
			//****************************Current Owners Table*****************************************
                    
                    var landdetailsContent = "<table dir=rtl >";
                    
                    landdetailsContent+="<tr ><td colspan= 6>  " ;
                    landdetailsContent+= landTab();
                    landdetailsContent+="</td></tr>" ;
                    landdetailsContent+="<tr>";
                        landdetailsContent+="<td> Land Listing:<table width='50%'><tr> <td colspan='2'> Land Details</tr>";
                                landdetailsContent+="<tr> <td> رمز المنطقة</td><td><a   >"+ Results["landInfo"]["LandID"]+"</a></td></tr>";

                                landdetailsContent+="<tr><td>الحوض</td><td>"+ Results["landInfo"]["Plot_No"]+"</td></tr>";
                                landdetailsContent+="<tr><td>القطعة</td><td>"+ Results["landInfo"]["Piece"]+"</td></tr>";
                                landdetailsContent+="<tr><td>المنطقة</td><td>"+ Results["landInfo"]["location"]+"</td></tr>";
                                landdetailsContent+="<tr><td>جنسية</td><td>"+ Results["landInfo"]["Land_Type"]+"</td></tr>";
                                landdetailsContent+="<tr><td>المساحة</td><td>"+ Results["landInfo"]["TotalArea"]+"</td></tr>";
                                landdetailsContent+="<tr><td>شمالا</td><td>"+ Results["landInfo"]["North"]+"</td></tr>";
                                landdetailsContent+="<tr><td>جنوبا</td><td>"+ Results["landInfo"]["South"]+"</td></tr>";
                                landdetailsContent+="<tr><td>شرقا</td><td>"+ Results["landInfo"]["East"]+"</td></tr>";
                                landdetailsContent+="<tr><td>غربا</td><td>"+ Results["landInfo"]["West"]+"</td></tr>";

                                landdetailsContent+= "</td></tr></table></td>"
                        landdetailsContent+="<td>"+currentOwnersContent+"</td></tr>";    
                    landdetailsContent+= "</table>";
                    
                     $("#landresult").html(landdetailsContent);
                    
			//****************************Land Info Table*****************************************
                        var previousOwnersContent = "<table dir=rtl>";
                        previousOwnersContent+="<tr ><td colspan= 6>  " ;
                        previousOwnersContent+= landTab();
                        previousOwnersContent+="</td></tr>" ;
                     if(typeof(Results["previous"])!="undefined"){
                         var arrayNodeB= Results["previous"]["deed"]
                        previousOwnersContent+="<tr><td colspan='2'>Previous Users</td></tr>";
                        previousOwnersContent+="<tr><td>customer name </td><td> customer nationality</td></tr>";
                           for(var j= 0; j<arrayNodeB.length; j++){ 
                                 var arrayNode= Results["previous"]["deed"][j]["customers"]
                                  previousOwnersContent+="<tr onclick='showDeedCustomersTR("+arrayNodeB[j]["deed"]+")'><td colspan='2'><strong>Deed:"+arrayNodeB[j]["deed"]+"</strong></td></tr>";

                                for(var i = 0; i<arrayNode.length ; i++ )
                                previousOwnersContent+="<tr class="+arrayNodeB[j]["deed"]+"><td> <input type='checkbox' name='prowners[]' value="+arrayNode[i]["CustomerID"]+"> <a class='searchLink' >"+ arrayNode[i]["CustomerNameArabic"]+"</a></td><td>"+ arrayNode[i]["Nationality"]+"</td></tr>";
                                 
                            }
                            
                            
                     }else{
                     previousOwnersContent+="<tr><td>Sorry no results found in this category</td></tr>"
                         
                     }       
			$("#previousowner").html(previousOwnersContent);
                        previousOwnersContent+= "</table>";
			//****************************Previous Owners Table*****************************************
                        var finesContent = "<table dir=rtl>";
                        finesContent+="<tr ><td colspan= 6>  " ;
                        finesContent+= landTab();
                        finesContent+="</td></tr>" ;
                       if(typeof(Results["fines"])!="undefined"){
                         var arrayNode= Results["fines"]

                        finesContent+="<tr><td colspan='4'>Land Fines</td></tr>";

                        finesContent+="<tr><td>ID </td><td> Remarks</td><td>Amount of Mortgaged </td><td>Type(Type Deatils) </td><td> Date</td></tr>";

                        for(var i = 0; i<arrayNode.length ; i++ ){
                            finesContent+="<tr><td> <a onlick=''>"+ arrayNode[i]["HajzID"]+"</a></td><td>"+ arrayNode[i]["Remarks"]+"</td>";
                            finesContent+="<td>"+ arrayNode[i]["AmountMortgaged"]+"</td>"
                            finesContent+="<td>"+ arrayNode[i]["Type"]+"("+arrayNode[i]["Type Deatils"]+")</td><td>"+ arrayNode[i]["DateCreated"]+"</td>";
                            finesContent+="</tr>";
                        }

                     }else{
                        finesContent+="<tr><td>Sorry no results found in this category</td></tr>"
                     }       
			$("#fines").html(finesContent);
                        finesContent+= "</table>";
			//****************************Fines  Table*****************************************

		}
                
                function _displayCustomerProfile(customerID){
                    if( customerID != null ) {
                       
                        
                         $.ajax({ 
                                type: "POST",
				url:'CustomerService/Search', 
				data: "action=search&string="+customerID,
				success: function(data) 
				{ 
                                                var Results = JSON.parse(data); 	
                                                console.log(Results);

                                        if(Results[0]["CustomerID"]){
                                                var userdetailsContent = "<table dir=rtl>";

                                               userdetailsContent+="<tr ><td colspan= 6>  " ;
                                               userdetailsContent+= userTab(1);
                                               userdetailsContent+="</td></tr>" ;
                                               userdetailsContent+="<tr><td>الإسم -- عربي</td><td>"+ Results[0]["CustomerNameArabic"]+"</td></tr>";
                                               userdetailsContent+="<tr><td>عنوان المنزل</td><td>"+ Results[0]["HomeAddress"]+"</td></tr>";
                                               userdetailsContent+="<tr><td>هاتف المنزل</td><td>"+ Results[0]["HomePhone"]+"</td></tr>";
                                               userdetailsContent+="<tr><td>هاتف محمول</td><td>"+ Results[0]["MobilePhone"]+"</td></tr>";
                                               userdetailsContent+="<tr><td>تاريخ الميلاد</td><td>"+ Results[0]["DateofBirth"]+"</td></tr>";
                                               userdetailsContent+="<tr><td>جنسية</td><td>"+ Results[0]["Nationality"]+"</td></tr>";
                                               userdetailsContent+="<tr><td>البريد الإلكتروني</td><td>"+ Results[0]["EmailAddress"]+"</td></tr>";
                                               userdetailsContent+= "</table>";

                                                $("#customerprofile").html(userdetailsContent);
                                     }
                                }
                            })
                          }
                }
                
		function displayCustomerProfile(Results){
                    
                     var userdetailsContent = "<table dir=rtl>";
                    
                    userdetailsContent+="<tr ><td colspan= 6>  " ;
                    userdetailsContent+= userTab();
                    userdetailsContent+="</td></tr>" ;
                    userdetailsContent+="<tr><td>الإسم -- عربي</td><td>"+ Results[0]["CustomerNameArabic"]+"</td></tr>";
                    userdetailsContent+="<tr><td>عنوان المنزل</td><td>"+ Results[0]["HomeAddress"]+"</td></tr>";
                    userdetailsContent+="<tr><td>هاتف المنزل</td><td>"+ Results[0]["HomePhone"]+"</td></tr>";
                    userdetailsContent+="<tr><td>هاتف محمول</td><td>"+ Results[0]["MobilePhone"]+"</td></tr>";
                    userdetailsContent+="<tr><td>تاريخ الميلاد</td><td>"+ Results[0]["DateofBirth"]+"</td></tr>";
                    userdetailsContent+="<tr><td>جنسية</td><td>"+ Results[0]["Nationality"]+"</td></tr>";
                    userdetailsContent+="<tr><td>البريد الإلكتروني</td><td>"+ Results[0]["EmailAddress"]+"</td></tr>";
                    userdetailsContent+= "</table>";
                    
                     $("#customerprofile").html(userdetailsContent);
                    
                }
		function displayCustomerInfo(Results)
		{   var type = "customer"
                    setlistType(type);
                    displayCustomerProfile(Results);
                    var content ="<div><ol style='margin: 50px'>";
                    for(var i = 0 ; i<Results.length; i++){
                        var index = i+1
                        if(content.length >1)
                              var content =content+"<li style='float:right; width: 250px;'>&nbsp;<a onclick='diplayUserDetails("+Results[i]['CustomerID']+", 0)'   target='blank'>"+Results[i]['CustomerNameArabic']+"</a> </li>" 
//                        else
//                              var content ="<li>+"index+")&nbsp; <a href='customerMaster/"+Results[i]['CustomerID']+"' target='blank'>"+Results[i]['CustomerNameArabic']+"</a></li>"


                    }	
                    content +="</ol></div>";
                    content +="";
                    $("#customerresult").html(content);
		}
                
                function setlistType(listType){
                     listType = listType;
                }
                function getlistType(listType){
                    return listType;
                }
                function hideList(){
                     if($('#customerList').is(':visible'))
                    $("#customerList").hide();
                    else
                        $("#customerList").show();
                }
		function diplayUserDetails(customerID, type ){
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
                    content+=       userTab(type,customerID);
                    content+="</td></tr>" ;
                    
                    content+="<tr><td>رقم الارض</td>" ;
                     content+="<td align='right'>نوع الارض </td>";
                     content+="<td></td>" ;
                     content+="<td> عنوان المنزل</td>" ;
                     content+="<td>القطعة</td>" ;
                     content+="<td></td>" ;
                     content+="</tr>" ;

//                   Results = Results["landDetails"];
                    var arraryNode = Results["landDetails"];
                    for(var i = 0 ; i<arraryNode.length; i++){
                        var index = i+1
                        var arraryNodeB =Results["currentOwners"]
                        var CurrentOwner="";
                        if(typeof(Results["currentOwners"])!="undefined" && Results["currentOwners"].length>=2 ){
                                 CurrentOwner="<span onclick='hideList()' id='expand' style='pading:0 10px ' >All&nbsp;</span>";
                        CurrentOwner+="<a class='searchLink2' onclick='doSearchSubmit($(this).text())'>"+arraryNodeB[0]["CustomerNameArabic"]+"</a>(1)<br>"
                             
                          
                           
                          
                             CurrentOwner+="<div id='customerList'>"
                            for(var j = 1 ; j<=arraryNode.length; j++){

                                CurrentOwner+="<a class='searchLink2' onclick='doSearchSubmit($(this).text())' >"+arraryNodeB[j]["CustomerNameArabic"]+"</a>("+(j+1)+")<br>"
                            }    
                             CurrentOwner+="</div>"
                               }  else CurrentOwner+="<a class='searchLink2' onclick='doSearchSubmit($(this).text())' >"+arraryNodeB[0]["CustomerNameArabic"]+ "</a>(1)<br>"

                                  
                              
                              content=content+"<tr><td>"+i+"</td>" ;
                              content+="<td><a class='searchLink2' onclick='doSearchSubmit($(this).text())'  >"+arraryNode[i]['LandID']+"</a> </td>";
                              content+="<td>"+arraryNode[i]['Land_Type']+"</td>" ;
                              content+="<td>"+arraryNode[i]['location']+"</td>" ;
                              content+="<td>"+arraryNode[i]['TotalArea']+"</td>" ;
                              content+="<td>"+CurrentOwner+"</td>" ;
                              
                              content+="</tr>" ;
//
////                        else
////                              var content ="<li>+"index+")&nbsp; <a href='customerMaster/"+Results[i]['CustomerID']+"' target='blank'>"+Results[i]['CustomerNameArabic']+"</a></li>"


                    }	
                    content +="</table>";
                    $("#landresult").html(content);
                    hideAll();
                    $("#landresult").show();
                  
                    
	
				}
                           });
                }
		function displayCountryInfo(Results)
		{ 
                    setlistType("country")
                    var content ="<table border=1 dir='rtl' class='items'>";
                    var width = "130px";
                     content+="<tr><td>رقم العميل</td>" ;
                     content+="<td align='right'>الإسم -- عربي </td>";
                     content+="<td>ألإسم -- إنجليزي</td>" ;
                     content+="<td> عنوان المنزل</td>" ;
                     content+="<td>هاتف المنزل</td>" ;
                     content+="<td>هاتف محمول</td>" ;
                     content+="</tr>" ;

                    var type ="country"
                    for(var i = 0 ; i<Results.length; i++){
//                       if(Results[i]['CustomerNameArabic']!=null && Results[i]['CustomerNameArabic']!=""){ var index = i+1
                        if(content.length >1)
                              content=content+"<tr><td>"+(i+1)+"</td>" ;
                              content+="<td><a onclick='diplayUserDetails("+Results[i]['CustomerID']+", 1)'  target='blank' title="+Results[i]['CustomerID']+" >"+Results[i]['CustomerNameArabic']+"</a> </td>";
                              content+="<td>"+Results[i]['CustomerNameEnglish']+"</td>" ;
                              content+="<td>"+Results[i]['HomeAddress']+"</td>" ;
                              content+="<td>"+Results[i]['HomePhone']+"</td>" ;
                              content+="<td>"+Results[i]['MobilePhone']+"</td>" ;
                              content+="</tr>" ;

//                        else
//                              var content ="<li>+"index+")&nbsp; <a href='customerMaster/"+Results[i]['CustomerID']+"' target='blank'>"+Results[i]['CustomerNameArabic']+"</a></li>"


//                    }	
                    }
                    content +="</table>";
                    $("#countryresult").html(content);
		}
	</script>
</body>
</html>


