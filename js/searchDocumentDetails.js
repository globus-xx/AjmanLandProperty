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
    currentOwnersContent+="<tr><td colspan='2'><input type=hidden id=_deedID value="+Results["current"]["deed"]+">"+Results["current"]["deed"]+"<strong>الزبون الحالي </strong></td><td><input type=image id=addnew src='../images/add.png' title='add owner' alt='add owner'> &nbsp; <img src='../images/remove.png' title=remove alt=remove ></td></tr>";
    currentOwnersContent+="<tr><td>اسم الزبون </td><td> جنسية الزبون</td><td>مشاركة(%)</td></tr>";
    if(typeof(Results["current"]["customers"])!="undefined"){
        var arrayNode= Results["current"]["customers"]
        for(var i = 0; i<arrayNode.length ; i++ ){
            currentOwnersContent+="<tr><td><img src='../images/remove.png' id=removeWithID_"+arrayNode[i]["CustomerID"]+" onclick=removeIT("+arrayNode[i]["CustomerID"]+") title=remove alt=remove value="+arrayNode[i]["CustomerID"]+"> &nbsp; <input type='checkbox' name='cuowners[]' value="+arrayNode[i]["CustomerID"]+"><a class='searchLink' >"+ arrayNode[i]["CustomerNameArabic"]+"</a></td>";
            currentOwnersContent+="<td>"+ arrayNode[i]["Nationality"]+"</td>";
            currentOwnersContent+="<td> "+ Results["current"]["share"][arrayNode[i]["CustomerID"]]+"</td>";
            currentOwnersContent+=" </tr>"
    }
    } else{
            currentOwnersContent+="<tr><td>عفوا لا توجد نتائج في هذا الصنف </td></tr>"
    }  
     currentOwnersContent+= "</table>";

        //****************************Current Owners Table*****************************************
 var finesContent = "<table dir=rtl class=landFines>";
//        finesContent+="<tr ><td colspan= 6>  " ;
//        finesContent+= landTab();
//        finesContent+="</td></tr>" ;
       if(typeof(Results["fines"])!="undefined"){
                var arrayNode= Results["fines"]
               finesContent+="<tr><td colspan='4'><strong>غرامات الارض</strong></td><td><input type=image id=addnew src='../images/add.png' title='add owner' alt='add owner'> &nbsp; <img src='../images/remove.png' title=remove alt=remove ></td></tr>";
               finesContent+="<tr><td>ID </td><td> ملاحظات</td><td>الكمية المرهونة </td><td>تفاصيل النوع </td><td> التاريخ</td></tr>";
               for(var i = 0; i<arrayNode.length ; i++ ){
                        finesContent+="<tr><td><img src='../images/remove.png' id=removeWithID_"+arrayNode[i]["HajzID"]+" onclick=removeIT("+arrayNode[i]["HajzID"]+",fines) title=remove alt=remove value="+arrayNode[i]["HajzID"]+"> &nbsp; <input type='checkbox' name='cuowners[]' value="+arrayNode[i]["CustomerID"]+">"+ arrayNode[i]["HajzID"]+"</td><td>"+ arrayNode[i]["Remarks"]+"</td>";
                        finesContent+="<td>"+ arrayNode[i]["AmountMortgaged"]+"</td>"
                        finesContent+="<td>"+ arrayNode[i]["Type"]+"("+arrayNode[i]["Type Deatils"]+")</td><td>"+ arrayNode[i]["DateCreated"]+"</td>";
                        finesContent+="</tr>";
               }
     }else{
                 finesContent+="<tr><td>عفوا لا توجد نتائج في هذا الصنف</td></tr>"
     }       
//        $("#landresult").append(finesContent);
        finesContent+= "</table>";
    var landdetailsContent = "<table dir=rtl  >";
    landdetailsContent+="<tr ><td colspan= 6>  " ;
    landdetailsContent+= landTab();
    landdetailsContent+="</td></tr>" ;
    landdetailsContent+="<tr>";
        landdetailsContent+="<td> <form id=landInfoForm name=landInfoForm ><input type=hidden id=testField name=testField><table width='50%' class=landDetails><tr> <td> <strong>تفاصيل الارض</strong><td><img src='../images/save.png' onclick=UpdateLandData('"+ Results["landInfo"]["LandID"]+"')></td></tr>";
                landdetailsContent+="<tr> <td> رمز المنطقة</td><td><a   >"+ Results["landInfo"]["LandID"]+"</a></td></tr>";
                landdetailsContent+="<tr><td>الحوض</td><td><input id=Plot_No name=Plot_No type=text value='"+ Results["landInfo"]["Plot_No"]+"'></td></tr>";
                landdetailsContent+="<tr><td>القطعة</td><td><input id=Piece name=Piece type=text value='"+ Results["landInfo"]["Piece"]+"'></td></tr>";
                landdetailsContent+="<tr><td>المنطقة</td><td><input id=location name=location type=text value='"+ Results["landInfo"]["location"]+"'></td></tr>";
                landdetailsContent+="<tr><td>النوع</td><td><input id=Land_Type name=Land_Type type=text value='"+ Results["landInfo"]["Land_Type"]+"'></td></tr>";
                landdetailsContent+="<tr><td>المساحة</td><td><input id=TotalArea name=TotalArea type=text value='"+ Results["landInfo"]["TotalArea"]+"'></td></tr>";
                landdetailsContent+="<tr><td>length</td><td><input id=length name=length type=text value='"+ Results["landInfo"]["length"]+"'></td></tr>";
                landdetailsContent+="<tr><td>witdh</td><td><input id=width name=width type=text value='"+ Results["landInfo"]["width"]+"'></td></tr>";
                landdetailsContent+="<tr><td>شمالا</td><td><input id=North name=North type=text value='"+ Results["landInfo"]["North"]+"'></td></tr>";
                landdetailsContent+="<tr><td>جنوبا</td><td><input id=South name=South type=text value='"+ Results["landInfo"]["South"]+"'></td></tr>";
                landdetailsContent+="<tr><td>شرقا</td><td><input id=East name=East type=text value='"+ Results["landInfo"]["East"]+"'></td></tr>";
                landdetailsContent+="<tr><td>غربا</td><td><input id=West name=West type=text value='"+ Results["landInfo"]["West"]+"'><input id=LandID name=LandID type=hidden value='"+ Results["landInfo"]["LandID"]+"'></td></tr>";
                landdetailsContent+="<tr><td>Remarks</td><td><input id=Remarks name=Remarks type=text value='"+ Results["landInfo"]["Remarks"]+"'></td></tr>";
                landdetailsContent+= "</td></tr></table><input type=hidden id=_testField name=_testField></form></td>"
        landdetailsContent+="<td>"+currentOwnersContent+finesContent+"</td></tr>";  
//        landdetailsContent+="<td>"+finesContent+"</td></tr>";  
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
                            CustomerResult[0]= null;
                            CustomerResult[0] = CustomerResult;
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
var name = $( "#name" ),
      email = $( "#email" ),
      password = $( "#password" ),
      allFields = $( [] ).add( name ).add( email ).add( password ),
      tips = $( ".validateTips" );
 
   $(function() {
    var name = $( "#name" ),
      email = $( "#email" ),
      password = $( "#password" ),
      allFields = $( [] ).add( name ).add( email ).add( password ),
      tips = $( ".validateTips" );
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    }
 
    function checkRegexp( o, regexp, n ) {
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }
 
    $( "#addOwner-form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 300,
      modal: false,
      buttons: {
        "Add owner": function() {
          var bValid = true;
          allFields.removeClass( "ui-state-error" );
 
//          bValid = bValid && checkLength( name, "username", 3, 16 );
//          bValid = bValid && checkLength( email, "email", 6, 80 );
//          bValid = bValid && checkLength( password, "password", 5, 16 );
 
//          bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
           
          if ( bValid ) { alert("data received");
            var customerID = $("#_customerID").val() ;
            var deedID = $("#_deedID").val()
             var share = $("#_share").val()
            $( this ).dialog( "close" );
                $.ajax({ 
                   type: "POST",
                   url:'DocumentMaster/AddOwner', 
                   data: "customerID="+customerID+"&deedID="+deedID+"&Share="+share,
                   success: function(data) 
                   {
                       $('<tr><td><img src="../images/remove.png" title=remove id=removeWithID_'+$("#_customerID").val()+' onclick=removeIT('+$("#_customerID").val()+')> &nbsp; <input type=checkbox name=cuowners[] value='+$("#_customerID").val()+' >'+$("#customerSearch").val()+'</td> <td>'+$("#_nationality").val()+' </td> <td>'+$("#_share").val()+' </td></tr>').appendTo('.currentOwners');

                   }
               })
            
          }else{alert("problem")}
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      },
      close: function() {
        allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
 
    $( "#addOwner-form" )
      .button()
      .click(function() {
        $( "#addOwner-form" ).dialog( "open" );
      });
  });
  
  function removeIT(id, type){
      alert(id+"s"+ $("#removeWithID_"+id))
      if(type=="fines") deleteFines(id)
          else
          deleteOwner(id)
      $("#removeWithID_"+id).closest('tr').remove();
      
  }
  function deleteOwner(id){
      
            var customerID = id ;
            var deedID = $("#_deedID").val()
            var share = $("#_share").val()
                 $.ajax({ 
                   type: "POST",
                   url:'DocumentMaster/DeleteOwner', 
                   data: "customerID="+customerID+"&deedID="+deedID,
                   success: function(data) 
                   {
                      alert("suseccfully removed")
                   }
               })
      
  }
  function deleteFines(id){
        
        $.ajax({ 
            type: "POST",
            url:'DocumentMaster/DeleteFines', 
            data: "fineID="+id,
            success: function(data) 
            {
               alert("suseccfully removed")
            }
        })
      
  }
  function UpdateLandData(id){
      
            var landID = id ;
            var $inputs = $('#landInfoForm :input');

    // not sure if you wanted this, but I thought I'd add it.
    // get an associative array of just the values.
    var values = $('#landInfoForm').serialize();
    values = JSON.stringify(values);
//            var deedID = $("#_deedID").val()
//            var share = $("#_share").val()
                 $.ajax({ 
                   type: "POST",
                   url:'DocumentMaster/UpdateLandData', 
                   data: values,
                   success: function(data) 
                   {
                      alert("suseccfully updated")
                   }
               })
      
  }  
  
 