function landTab(listType, customerID){
        var userTab="<table class=tab><tr>"
                userTab+="<td><a onclick=switchToView('landresult')><strong>Land details</strong></a></td>" ;
                userTab+="<td><a onclick=switchToView('fines')><strong>Fines and Remarks</strong></a></td>" ;
                userTab+="<td align='right'><a onclick=switchToView('previousowner')><strong>Previous Owners</strong></a></td>";
                userTab+="</tr>" ;
        return userTab+="</table>";
} 
function userTab(listType, customerID){

           var userTab="<table class=tab><tr>"
               if(listType ==1){ 
//                   userTab+="<a onclick=switchToView('countryresult')>Back to user listing</a></td>" ;
                   userTab+="<td><a onclick=_displayCustomerProfile("+customerID+");switchToView('customerprofile')><strong>User Profile</strong></a></td>" ;
                }else { 
//                    userTab+="<a onclick=switchToView('customerresult')>Back to user listing</a></td>" ;
                    userTab+="<td><a onclick=switchToView('customerprofile')><strong>User Profile</strong></a></td>" ;
                }
                        userTab+="<td align='right'><a onclick=switchToView('landresult')><strong>Land List</strong></a></td>";
                        userTab+="<td align='right'><a onclick=switchToView('previouslandresult')><strong>Previous Land List</strong></a></td>";
                        userTab+="</tr>" ;
               return userTab+="</table>";
} 
function switchToView(viewName){
    hideAll()
   $("#"+viewName).show(); 
}
function hideAll(){// hide all the divs before loading the related one
        $("#letterTable").hide()
        $("#previouslandresult").hide()
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

function doSearchSubmit(searchString){// will call on the click of customer name or automatically on search
    $("#searchstring").val(searchString);
    $("#SearchForm").trigger('submit')

}
function displayLandInfo(Results)// lsit previous and currnt lands from result of land search
{   
    // get the current owners and list them with links to the profile on the Arabic name
     var currentOwnersContent = "<table dir=rtl class=currentOwners>";
    currentOwnersContent+="<tr><td colspan='3'><strong>Current Customers</strong></td></tr>";
    currentOwnersContent+="<tr><td>customer name </td><td> customer nationality</td><td>Share(%)</td></tr>";
    if(typeof(Results["current"]["customers"])!="undefined"){
        var arrayNode= Results["current"]["customers"]
        for(var i = 0; i<arrayNode.length ; i++ ){
            currentOwnersContent+="<tr><td> <input type='checkbox' name='cuowners[]' value="+arrayNode[i]["CustomerID"]+"><a class='searchLink' >"+ arrayNode[i]["CustomerNameArabic"]+"</a></td>";
            currentOwnersContent+="<td>"+ arrayNode[i]["Nationality"]+"</td>";
            currentOwnersContent+="<td> "+ Results["current"]["share"][arrayNode[i]["CustomerID"]]+"</td>";
            currentOwnersContent+=" </tr>"
    }
    } else{
            currentOwnersContent+="<tr><td>Sorry no results found in this category</td></tr>"
    }  
     currentOwnersContent+= "</table>";

        //****************************Current Owners Table*****************************************

    var landdetailsContent = "<table dir=rtl  >";
    landdetailsContent+="<tr ><td colspan= 6>  " ;
    landdetailsContent+= landTab();
    landdetailsContent+="</td></tr>" ;
    landdetailsContent+="<tr>";
        landdetailsContent+="<td> <table width='50%' class=landDetails><tr> <td colspan='2'> <strong>Land Details</strong></tr>";
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

        //**************************** Land Info Table*****************************************
        
        // get the current owners and list them with links to the profile on the Arabic name
        var previousOwnersContent = "<table dir=rtl>";
        previousOwnersContent+="<tr ><td colspan= 6>  " ;
        previousOwnersContent+= landTab();
        previousOwnersContent+="</td></tr>" ;
            if(typeof(Results["previous"])!="undefined"){
                  var arrayNodeB= Results["previous"]["deed"]
                  previousOwnersContent+="<tr><td colspan='2'>Previous Owners</td></tr>";
                 
                     for(var j= 0; j<arrayNodeB.length; j++){ 
                           var arrayNode= Results["previous"]["deed"][j]["customers"]
                           
                           previousOwnersContent+="<tr class='deed' onclick='showDeedCustomersTR("+arrayNodeB[j]["deed"]+")'><td colspan='2'><strong>Deed:"+arrayNodeB[j]["deed"]+"</strong></td></tr>";
                           previousOwnersContent+="<tr class='"+arrayNodeB[j]["deed"]+" previousOwnerhead'><td>Customer Name </td><td> Customer Nationality</td></tr>";
                          for(var i = 0; i<arrayNode.length ; i++ )
                              previousOwnersContent+="<tr  class='"+arrayNodeB[j]["deed"]+" previousOwnerEven'><td><input type='checkbox' name='prowners[]' value="+arrayNode[i]["CustomerID"]+"> <a class='searchLink' >"+ arrayNode[i]["CustomerNameArabic"]+"</a></td><td>"+ arrayNode[i]["Nationality"]+"</td></tr>";
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
               finesContent+="<tr><td colspan='5'><strong>Land Fines</strong></td></tr>";
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

function _displayCustomerProfile(customerID){ // will load customre profile from customer ID provided, get the DB data from Ajax request
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
                     }//results
            }//sucess
        });// ajax
     }// if customer ID exist
}

function displayCustomerProfile(Results){// Will load the customer profile from results provided

     var userdetailsContent = "<table dir=rtl>";

    userdetailsContent+="<tr ><td colspan= 6>  " ;
    userdetailsContent+= userTab();
    userdetailsContent+="</td></tr>" ;
    userdetailsContent+="<tr><td><strong> User Profile</strong><table class=landDetails>"
    userdetailsContent+="<tr><td>الإسم -- عربي</td><td>"+ Results[0]["CustomerNameArabic"]+"</td></tr>";
    userdetailsContent+="<tr><td>عنوان المنزل</td><td>"+ Results[0]["HomeAddress"]+"</td></tr>";
    userdetailsContent+="<tr><td>هاتف المنزل</td><td>"+ Results[0]["HomePhone"]+"</td></tr>";
    userdetailsContent+="<tr><td>هاتف محمول</td><td>"+ Results[0]["MobilePhone"]+"</td></tr>";
    userdetailsContent+="<tr><td>تاريخ الميلاد</td><td>"+ Results[0]["DateofBirth"]+"</td></tr>";
    userdetailsContent+="<tr><td>جنسية</td><td>"+ Results[0]["Nationality"]+"</td></tr>";
    userdetailsContent+="<tr><td>البريد الإلكتروني</td><td>"+ Results[0]["EmailAddress"]+"</td></tr>";
    userdetailsContent+= "</tabe></td></tr></table>";

     $("#customerprofile").html(userdetailsContent);

}
function displayCustomerInfo(Results)// will load list off customers returned from country or any other result
{   var type = "customer"
    setlistType(type);
    displayCustomerProfile(Results);
    var content ="<div><ol style='margin: 50px'>";
    for(var i = 0 ; i<Results.length; i++){
        var index = i+1
        if(content.length >1)
              var content =content+"<li style='float:right; width: 250px;'>&nbsp;<a onclick='diplayUserDetails("+Results[i]['CustomerID']+", 0)'   target='blank'>"+Results[i]['CustomerNameArabic']+"</a> </li>" 

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
function displayPreviousLands(Results){
    var arrayNode =Results["landDetails"]["previous"];
            var previousLands="";
            previousLands+="<table >";
                    previousLands+="<tr ><td colspan= 6>  " ;
                    previousLands+=       userTab();
                    previousLands+="</td></tr>" ;
                     previousLands+="<tr><td><table class=landDetails>" ;
                    previousLands+="<tr><td>رقم الارض</td>" ;
                    previousLands+="<td align='right'>نوع الارض </td>";
                    previousLands+="<td> عنوان المنزل</td>" ;
                    previousLands+="<td>القطعة</td>" ;
                    previousLands+="</tr>" ;
                    for(var i = 0 ; i<arrayNode.length; i++){
                        previousLands+="<tr><td><a class='searchLink2' onclick='doSearchSubmit($(this).text())'>"+arrayNode[i]["LandID"]+"</a> </td><td>"+arrayNode[i]["Land_Type"]+" </td><td>"+arrayNode[i]["location"]+" </td><td>"+arrayNode[i]["TotalArea"]+" </td></tr>"
                    } 
        previousLands+="</table></td></tr><table>";
        $("#previouslandresult").html(previousLands);
}
function diplayUserDetails(customerID, type ){ // list the land info of any customerID provided
        $('#loadingresult').show();
        var searchstring = []
        searchstring["string"] = customerID;
        searchstring["action"] = "search";

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
                            content+="<tr class =currentOwners><td>رقم الارض</td>" ;
                            content+="<td align='right'>نوع الارض </td>";
                            content+="<td>جنسية</td>" ;
                            content+="<td> عنوان المنزل</td>" ;
                            content+="<td>القطعة</td>" ;
                            content+="<td></td>" ;
                            content+="</tr>" ;
                displayCustomerProfile(Results["currentOwners"]);

                if(typeof(Results["landDetails"])!="undefined"){
                            if(Results["landDetails"].length>0 && Results["landDetails"]!= null ){
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
                                                    content=content+"<tr class=currentOwners><td>"+i+"</td>" ;
                                                    content+="<td><a class='searchLink2' onclick='doSearchSubmit($(this).text())'  >"+arraryNode[i]['LandID']+"</a> </td>";
                                                    content+="<td>"+arraryNode[i]['Land_Type']+"</td>" ;
                                                    content+="<td>"+arraryNode[i]['location']+"</td>" ;
                                                    content+="<td>"+arraryNode[i]['TotalArea']+"</td>" ;
                                                    content+="<td>"+CurrentOwner+"</td>" ;
                                                    content+="</tr>" ;
                                    }	
                            }
                        content +="</table>";
                        $("#landresult").html(content);
                        hideAll(); 
                        if(typeof(Results["landDetails"]["previous"])!="undefined") 
                            displayPreviousLands(Results)
                        else  
                            $("#previouslandresult").html( userTab(type,customerID)+"<center>sorry no previous land found</center>");
                        $("#landresult").show();

                }//results
            }//sucess
        });// ajax
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
        if(content.length >1)
              content=content+"<tr><td>"+(i+1)+"</td>" ;
              content+="<td><a onclick='diplayUserDetails("+Results[i]['CustomerID']+", 1)'  target='blank' title="+Results[i]['CustomerID']+" >"+Results[i]['CustomerNameArabic']+"</a> </td>";
              content+="<td>"+Results[i]['CustomerNameEnglish']+"</td>" ;
              content+="<td>"+Results[i]['HomeAddress']+"</td>" ;
              content+="<td>"+Results[i]['HomePhone']+"</td>" ;
              content+="<td>"+Results[i]['MobilePhone']+"</td>" ;
              content+="</tr>" ;


    }
    content +="</table>";
    $("#countryresult").html(content);
}