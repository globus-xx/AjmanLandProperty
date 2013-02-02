function landTab(listType, customerID){
        var userTab="<table class=tab><tr>"
                userTab+="<td><a onclick=switchToView('landresult')><strong>تفاصيل الارض</strong></a></td>" ;
                userTab+="<td><a onclick=switchToView('fines')><strong>الغرامات و الملاحظات</strong></a></td>" ;
                userTab+="<td align='right'><a onclick=switchToView('previousowner')><strong>المالك السابق</strong></a></td>";
                userTab+="</tr>" ;
        return userTab+="</table>";
} 
function userTab(listType, customerID){

           var userTab="<table class=tab><tr>"
               if(listType ==1){ 
//                   userTab+="<a onclick=switchToView('countryresult')>Back to user listing</a></td>" ;
                   userTab+="<td><a onclick=_displayCustomerProfile("+customerID+");switchToView('customerprofile')><strong>تفاصيل العضو</strong></a></td>" ;
                }else { 
//                    userTab+="<a onclick=switchToView('customerresult')>Back to user listing</a></td>" ;
                    userTab+="<td><a onclick=switchToView('customerprofile')><strong>تفاصيل العضو</strong></a></td>" ;
                }
                        userTab+="<td align='right'><a onclick=switchToView('landresult')><strong>قائمة الاراضي</strong></a></td>";
                        userTab+="<td align='right'><a onclick=switchToView('previouslandresult')><strong>قائمة الاراضي السابقة</strong></a></td>";
                        userTab+="</tr>" ;
               return userTab+="</table>";
} 
function switchToView(viewName){
    hideAll()
   $("#"+viewName).show(); 
   
    if(viewName=='landresult') 
       $("#letterTable").show(); 
   
   if(viewName=='previousowner')
       $("#letterTable").show();    
}
function hideAll(){// hide all the divs before loading the related one
        $('#letterTable').hide();
        $('#previouslandresult').hide();
        $('#fines').hide();
        $('#currentowner').hide();
        $('#previousowner').hide();
        $('#landresult').hide();
        $('#customerresult').hide(); 
        $('#areasearch').hide();
        $('#countryresult').hide(); 
        $('#loadingresult').hide(); 
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
    currentOwnersContent+="<tr><td colspan='3'><strong>الزبون الحالي</strong></td></tr>";
    currentOwnersContent+="<tr><td>اسم الزبون </td><td> جنسية الزبون</td><td>مشاركة(%)</td></tr>";
    if(typeof(Results["current"]["customers"])!="undefined"){
        var arrayNode= Results["current"]["customers"]
        for(var i = 0; i<arrayNode.length ; i++ ){
            currentOwnersContent+="<tr><td> <input type='checkbox' name='cuowners[]' value="+arrayNode[i]["CustomerID"]+"><a class='searchLink' >"+ arrayNode[i]["CustomerNameArabic"]+"</a></td>";
            currentOwnersContent+="<td>"+ arrayNode[i]["Nationality"]+"</td>";
            currentOwnersContent+="<td> "+ Results["current"]["share"][arrayNode[i]["CustomerID"]]+"</td>";
            currentOwnersContent+=" </tr>"
    }
    } else{
            currentOwnersContent+="<tr><td>عفوا لا توجد نتائج في هذا الصنف </td></tr>"
    }  
     currentOwnersContent+= "</table>";

        //****************************Current Owners Table*****************************************

    var landdetailsContent = "<table dir=rtl  >";
    landdetailsContent+="<tr ><td colspan= 6>  " ;
    landdetailsContent+= landTab();
    landdetailsContent+="</td></tr>" ;
    landdetailsContent+="<tr>";
        landdetailsContent+="<td> <table width='50%' class=landDetails><tr> <td colspan='2'> <strong>تفاصيل الارض</strong></tr>";
                landdetailsContent+="<tr> <td> رمز المنطقة</td><td><a   >"+ Results["landInfo"]["LandID"]+"</a></td></tr>";
                landdetailsContent+="<tr><td>الحوض</td><td>"+ Results["landInfo"]["Plot_No"]+"</td></tr>";
                landdetailsContent+="<tr><td>القطعة</td><td>"+ Results["landInfo"]["Piece"]+"</td></tr>";
                landdetailsContent+="<tr><td>المنطقة</td><td>"+ Results["landInfo"]["location"]+"</td></tr>";
                landdetailsContent+="<tr><td>النوع</td><td>"+ Results["landInfo"]["Land_Type"]+"</td></tr>";
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
                  previousOwnersContent+="<tr><td colspan='2'>المالك السابق</td></tr>";
                 
                     for(var j= 0; j<arrayNodeB.length; j++){ 
                           var arrayNode= Results["previous"]["deed"][j]["customers"]
                           
                           previousOwnersContent+="<tr class='deed' onclick='showDeedCustomersTR("+arrayNodeB[j]["deed"]+")'><td colspan='2'><strong>رقم العقد:"+arrayNodeB[j]["deed"]+"</strong></td></tr>";
                           previousOwnersContent+="<tr class='"+arrayNodeB[j]["deed"]+" previousOwnerhead'><td>اسم الزبون </td><td> جنسية الزبون</td></tr>";
                          for(var i = 0; i<arrayNode.length ; i++ )
                              previousOwnersContent+="<tr  class='"+arrayNodeB[j]["deed"]+" previousOwnerEven'><td><input type='checkbox' name='prowners[]' value="+arrayNode[i]["CustomerID"]+"> <a class='searchLink' >"+ arrayNode[i]["CustomerNameArabic"]+"</a></td><td>"+ arrayNode[i]["Nationality"]+"</td></tr>";
                    }
            }else{
                 previousOwnersContent+="<tr><td>عفوا لا توجد نتائج في هذا الصنف</td></tr>"
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
               finesContent+="<tr><td colspan='5'><strong>غرامات الارض</strong></td></tr>";
               finesContent+="<tr><td>ID </td><td> ملاحظات</td><td>الكمية المرهونة </td><td>تفاصيل النوع </td><td> التاريخ</td></tr>";
               for(var i = 0; i<arrayNode.length ; i++ ){
                        finesContent+="<tr><td> <a onlick=''>"+ arrayNode[i]["HajzID"]+"</a></td><td>"+ arrayNode[i]["Remarks"]+"</td>";
                        finesContent+="<td>"+ arrayNode[i]["AmountMortgaged"]+"</td>"
                        finesContent+="<td>"+ arrayNode[i]["Type"]+"("+arrayNode[i]["Type Deatils"]+")</td><td>"+ arrayNode[i]["DateCreated"]+"</td>";
                        finesContent+="</tr>";
               }
     }else{
                 finesContent+="<tr><td>عفوا لا توجد نتائج في هذا الصنف</td></tr>"
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
    userdetailsContent+="<tr><td><strong> تفاصيل العضو</strong><table class=landDetails>"
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
function diplayUserDetails(customerID, type , CustomerResult){ // list the land info of any customerID provided
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
                            CustomerResult[0][0]= null;
                            CustomerResult[0][0] = CustomerResult;
                            displayCustomerProfile(CustomerResult)
//               if(typeof(Results["currentOwners"][0][0])!="undefined" )  displayCustomerProfile(Results["currentOwners"][0]);
//                else 
//                    displayCustomerProfile(Results["currentOwners"])


   
                if(typeof(Results["landDetails"]["current"])!="undefined"){ 
                            if(Results["landDetails"]["current"].length>0 && Results["landDetails"]["current"]!= null ){
                                    var arraryNode = Results["landDetails"]["current"];


                                    for(var i = 0 ; i<arraryNode.length; i++){
                                        var index = i+1

                                        var arraryNodeB =Results["currentOwners"][i]
                                        var CurrentOwner="";
                                        if(typeof(Results["currentOwners"][i])!="undefined" && Results["currentOwners"][i].length>=2 ){
                                                 CurrentOwner="<span onclick='hideList()' id='expand' style='pading:0 10px ' >All&nbsp;</span>";
                                                 CurrentOwner+="<a class='searchLink2' onclick='doSearchSubmit($(this).text())'>"+arraryNodeB[0]["CustomerNameArabic"]+"</a>(1)<br>"
                                                 CurrentOwner+="<div id='customerList'>"
                                                    for(var j = 1 ; j<=arraryNodeB.length-1; j++){

                                                        CurrentOwner+="<a class='searchLink2' onclick='doSearchSubmit($(this).text())' >"+arraryNodeB[j]["CustomerNameArabic"]+"</a>("+(j+1)+")<br>"
                                                    }    
                                             CurrentOwner+="</div>"
                                               }  else CurrentOwner+="<a class='searchLink2' onclick='doSearchSubmit($(this).text())' >"+arraryNodeB[0]["CustomerNameArabic"]+ "</a>(1)<br>"
                                                    content=content+"<tr class=currentOwners><td>"+i+"</td>" ;
                                                    content+="<td><input type='checkbox' name='lands[]' value="+arraryNode[i]['LandID']+"><a class='searchLink2' onclick='doSearchSubmit($(this).text())'  >"+arraryNode[i]['LandID']+"</a> </td>";
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

                }//results wit current lands
                else{  $("#landresult").html(userTab()); }
                if(typeof(Results["landDetails"]["previous"])!="undefined") 
                            displayPreviousLands(Results)
                        else  
                            $("#previouslandresult").html( userTab(type,customerID)+"<center>عفوا لا توجد أراضي سابقة</center>");
                        $("#landresult").show();
                        $('#letterTable').show();
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