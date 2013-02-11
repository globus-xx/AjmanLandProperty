var currentOwnerArray = new Array();
var previousOwnerArray = new Array();
var name = $( "#name" ),
email = $( "#email" ),
password = $( "#password" ),
//allFields = $( [] ).add( name ).add( email ).add( password ),
tips = $( ".validateTips" );
$(document).ready(function() {
                             
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
    $( "#markUpdate" ).click(function(){
        
        var r=confirm("mark this as updated??");
                if (r==true)
                  {
                  $("#content").css("background-color","#CCFFCC");
         $.ajax({ 
            type: "POST",
            url:'DocumentMaster/MarkUpdated', 
            data: "DeedID="+$("#_deedID").val(),
            success: function(data) 
            {
                setTimeout(function(){ $("#content").css("background-color","white");},3000);
            }
        })
                  }
                else
                  {
                  x="You pressed Cancel!";
                   confirm(x)
                  }
       
        
       
       
    })
        $( "#addOwner-form" ).dialog({
          autoOpen: false,
          height: 420,
          width: 300,
          modal: false,
          buttons: {
            "Add owner": function() {
              //addOwnerRow();
              addOwnerToDB()
              $("#_share").val("0")
               $( this ).dialog( "close" );
            },
            Cancel: function() {
              $( this ).dialog( "close" );
            }
            ,
            "Submit & Add New": function() {
                 addOwnerToDB();
//              $( this ).dialog( "close" );
            }
          },
          close: function() {
            allFields.val( "" ).removeClass( "ui-state-error" );
            $("#_share").val("0")
          }
        });

//        $( "#addOwner-form" )
//          .button()
//          .click(function() {$( "#addOwner-form" ).dialog( "open" );
//              alert("i am");
//              $("#addDeed").show();
////            if(getShareTotal()<100) 
////            else showMessage("Add owner is not allowed, Share total must be less than 100", "error", 5000)
//          });

         $("#addDeedButton").click(function(){
             var deedType = $("#deedType").val();
             var deedDate = $("#DeedDate").val();
             var LandID = $("#LandID").val();
             
                         $.ajax({ 
                                   type: "POST",
                                   url:'DocumentMaster/AddDeed', 
                                   data:"&formData="+JSON.stringify({LandID:LandID,DateCreated:deedDate,Type: "cancelled"}),
                                   success: function(data) 
                                   {     var Results = JSON.parse(data); 
                                         DeedID = Results.DeedID
                                         $("#previous_DeedID").val(DeedID)
                                         $("#addDeed").hide();
                                        var previousOwnersContent ="<tr class='deed' ><td onclick='showDeedCustomersTR("+DeedID+")' align='right' colspan='2'><strong>رقم العقد:"+DeedID+"</strong></td>";
                                         previousOwnersContent+="<td ><img onclick=updateDeed('"+DeedID+"') src=../images/save.png id='"+DeedID+"' />&nbsp;<input type=image alt='add owner' title='add owner' src='../images/add.png' onclick=addPOwner('"+DeedID+"') class='addnewDeed' id='"+DeedID+"'></td></tr>";
                                         previousOwnersContent+="<tr><td colspan=3><table id='previous_"+DeedID+"' ><tr class='"+DeedID+" previousOwnerhead'><td></td><td>اسم الزبون </td><td> جنسية الزبون</td><td>مشاركة(%)</td></tr></table>";
                                         $(previousOwnersContent).appendTo('.previousOwners');
                        
                                         eval("var DeedID = new array()")
                                         previousOwnerArray.push(DeedID);
                                         showMessage("Deed Added","sucess");

   //                                 $("#share_"+id).closest('tr').css("background-color", "#CCFFCC");
   //                                 setTimeout(function(){ $("#share_"+id).closest('tr').css("background-color", "white");},3000);
                                   }
                        })
         })
  
        $( "#addFine-form" ).dialog({
           autoOpen: false,
           height: 600,
           width: 300,
           modal: false,
           buttons: {
             "Add Fine": function() {
               var bValid = true;
               allFields.removeClass( "ui-state-error" );

     //          bValid = bValid && checkLength( name, "username", 3, 16 );
     //          bValid = bValid && checkLength( email, "email", 6, 80 );
     //          bValid = bValid && checkLength( password, "password", 5, 16 );

     //          bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );

               if ( bValid ) { //alert("data received");
                 var ID = $("#_customerID").val() ;
                 var Remarks = $("#Remarks").val()
                  var AmountMortgaged = $("#AmountMortgaged").val()
                  var type = $("input[name=Type]").val()
                  var typeDetails = $("#TypeDetail").val()
                  var DateCreated = $("#_DateCreated").val()
                  var IsActive = $("input[name=IsActive]").val()

                  
                 $( this ).dialog( "close" );
                     var values = $('#fineForm').serialize();
                       values = JSON.stringify(values);
                     $.ajax({ 
                        type: "POST",
                        url:'DocumentMaster/AddHajaz', 
                        data: values,//"customerID="+customerID+"&deedID="+deedID+"&Share="+share,
                        success: function(data) 
                        {   
                            var Results = JSON.parse(data); 
                            ID = Results.HajzID
//                            alert(ID+data["HajzID"]+Results.HajzID)
                            
                            $('<tr><td><img src="../images/remove.png" title=remove id=removeWithID_'+ID+' onclick=removeIT('+ID+',"fines")> &nbsp; <input type=checkbox name=fines[] value='+ID+' >'+ID+'</td> <td>'+Remarks+' </td> <td>'+AmountMortgaged+' </td> <td>'+type+'('+typeDetails+') </td> <td>'+DateCreated+IsActive+' </td></tr>').appendTo('.landFines');

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
  // Handler for .ready() called.
});
function addPOwner(id){
//    $(".addnewDeed" ).trigger("click")
     var deedid = id;
     var deedType = "previousDeed"
//                           debugger
//                             if(shareTotal<100) 

                                                    $("#addDeed").hide();
                                                    $( "#addOwner-form" ).dialog( "open" );
                                                    $("#_customerID").val("") ;
                                                    $("#_nationality").val("") ;//alert(100-getShareTotal());
                                                    if(100-getShareTotal()<=100 && 100-getShareTotal()>=0)$("#_share").val(100-getShareTotal()) ;
                                                    $("#customerSearch").val("") ;
                                                    $("#deedType").val(deedType) ;
                                                    if(typeof(deedid!="undefined" || deedid!=""))$("#previous_DeedID").val(deedid) ;

}
function landTab(listType, customerID){
        var userTab="<table class=tab><tr>"
                userTab+="<td><a onclick=switchToView('landresult')><strong>تفاصيل الارض</strong></a></td>" ;
//                userTab+="<td><a onclick=switchToView('fines')><strong>الغرامات و الملاحظات</strong></a></td>" ;
                userTab+="<td align='right'><a onclick=switchToView('previousowner')><strong>المالك السابق</strong></a></td>";
                userTab+="</tr>" ;
        return userTab+="</table>";
} 

function switchToView(viewName){
    hideAll()
   $("#"+viewName).show(); 
   if(viewName =="landresult") $("#uploadButton").show();  
   
 
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
        $("#uploadButton").hide();
        $("#verifiedDeed").hide();
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
    currentOwnersContent+="<tr ><td colspan='3'><input type=hidden id=_deedID value="+Results["current"]["deed"]+"><strong>الزبون الحالي </strong></td><td>&nbsp; <img onclick=updateShare('true') src=../images/save.png  />&nbsp;<input type=image id=addnew src='../images/add.png' title='add owner' alt='add owner'>  &nbsp; <img src='../images/remove.png' title=remove alt=remove ></td></tr>";
    currentOwnersContent+="<tr bgcolor=#C9E0ED><td></td><td>اسم الزبون </td><td> جنسية الزبون</td><td>مشاركة(%)</td></tr>";
    if(typeof(Results["current"]["customers"])!="undefined"){
        var arrayNode= Results["current"]["customers"]
       
        
        for(var i = 0; i<arrayNode.length ; i++ ){
            currentOwnerArray.push(arrayNode[i]["CustomerID"]);
             var Shareid = Results["current"]["share"][arrayNode[i]["CustomerID"]]["shareDeedDetaisID"];
             var sharePercentage = Results["current"]["share"][arrayNode[i]["CustomerID"]]["sharePercentage"];
            currentOwnersContent+="<tr><td><img src='../images/remove.png' id=removeWithID_"+arrayNode[i]["CustomerID"]+" onclick=removeIT('"+arrayNode[i]["CustomerID"]+"','owner') title=remove alt=remove value="+arrayNode[i]["CustomerID"]+"> &nbsp; <input type='checkbox' name='cuowners[]' value="+arrayNode[i]["CustomerID"]+"></td>";
            currentOwnersContent+="<td><a href='customerMaster/update/"+arrayNode[i]["CustomerID"]+"' target=_blank >"+ arrayNode[i]["CustomerNameArabic"]+"</a></td>";
            currentOwnersContent+="<td>"+ arrayNode[i]["Nationality"]+"</td>";
            currentOwnersContent+="<td> <input id='share_"+Shareid+"' name='share_"+Shareid+"' type=text class=sharetxt value='"+ sharePercentage+"'  onblur=updateShare() size=5 >";
            currentOwnersContent+="<input id='_share_"+Shareid+"' name='_share_"+Shareid+"' type=hidden value='"+ sharePercentage+"'  onblur=updateShare('"+Shareid+"')  ></td>";
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
               finesContent+="<tr ><td colspan='4'><strong>غرامات الارض</strong></td><td><input type=image id=addnewFine src='../images/add.png' title='add hajaz' alt='add hajaz'> &nbsp; <img src='../images/remove.png' title=remove alt=remove >&nbsp;  </td></tr>";
               finesContent+="<tr bgcolor=#C9E0ED><td>ID </td><td> ملاحظات</td><td>الكمية المرهونة </td><td>تفاصيل النوع </td><td> التاريخ</td></tr>";
               for(var i = 0; i<arrayNode.length ; i++ ){
                   
                   if(arrayNode[i]["IsActive"] == '1') arrayNode[i]["IsActive"] ="Active"; else arrayNode[i]["IsActive"]="Not Active"
                       if(typeof(arrayNode[i]["DateCreated"]!="undefined") && arrayNode[i]["DateCreated"]!=null) arrayNode[i]["DateCreated"] = dubaiDate(arrayNode[i]["DateCreated"]); 
                             else arrayNode[i]["DateCreated"] =""
                        finesContent+="<tr><td><img src='../images/remove.png' id=removeWithID_"+arrayNode[i]["HajzID"]+" onclick=removeIT("+arrayNode[i]["HajzID"]+",'fines') title=remove alt=remove value="+arrayNode[i]["HajzID"]+"> &nbsp; <input type='checkbox' name='cuowners[]' value="+arrayNode[i]["CustomerID"]+">"+ arrayNode[i]["HajzID"]+"</td><td>"+ arrayNode[i]["Remarks"]+"</td>";
                        finesContent+="<td>"+ arrayNode[i]["AmountMortgaged"]+"</td>"
                        finesContent+="<td>"+ arrayNode[i]["Type"]+"("+arrayNode[i]["TypeDetail"]+")</td><td>"+arrayNode[i]["DateCreated"]+ arrayNode[i]["IsActive"]+"</td>";
                        finesContent+="</tr>";
               }
     }else{
                 finesContent+="<tr><td>عفوا لا توجد نتائج في هذا الصنف</td></tr>"
     }    
     
             //****************************Fines Table*****************************************
             
             
 // get the previous owners and list them with links to the profile on the Arabic name
        var previousOwnersContent = "<table dir=rtl class=previousOwners>";
        previousOwnersContent+="<tr ><td colspan= 6>  " ;
//        previousOwnersContent+= landTab();
        previousOwnersContent+="</td></tr>" ;
            if(typeof(Results["previous"])!="undefined"){
                  var arrayNodeB= Results["previous"]["deed"]
                  previousOwnersContent+="<tr><td colspan='2'>المالك السابق</td><td><input type=image class=addnewDeed src='../images/add.png' title='add owner' alt='add owner'>  &nbsp; </td></tr>";
                 
                     for(var j= 0; j<arrayNodeB.length; j++){

                           var arrayNode= Results["previous"]["deed"][j]["customers"]
                           var arrayNodeShare= Results["previous"]["deed"][j]["share"]
                           
                           
                           previousOwnersContent+="<tr class='deed' ><td onclick='showDeedCustomersTR("+arrayNodeB[j]["deed"]+")' align='right' colspan='2'><strong>رقم العقد:"+arrayNodeB[j]["deed"]+"</strong></td>";
                           previousOwnersContent+="<td ><img onclick=updateDeed('"+arrayNodeB[j]["deed"]+"') src=../images/save.png id='"+arrayNodeB[j]["deed"]+"' />&nbsp;<input type=image alt='add owner' title='add owner' src='../images/add.png' class='addnewDeed' id='"+arrayNodeB[j]["deed"]+"'></td></tr>";
                           previousOwnersContent+="<tr><td colspan=3><table id='previous_"+arrayNodeB[j]["deed"]+"' ><tr class='"+arrayNodeB[j]["deed"]+" previousOwnerhead'><td></td><td>اسم الزبون </td><td> جنسية الزبون</td><td>مشاركة(%)</td></tr>";
                             if(typeof(arrayNode)!="undefined"){   for(var i = 0; i<arrayNode.length ; i++ ){
                                                              previousOwnerArray.push(arrayNode[i]["CustomerID"]);
                                  var Shareid = arrayNodeShare[arrayNode[i]["CustomerID"]]["shareDeedDetaisID"];
                                  var sharePercentage =arrayNodeShare[arrayNode[i]["CustomerID"]]["sharePercentage"];

                                    previousOwnersContent+="<tr  class='"+arrayNodeB[j]["deed"]+" previousOwnerEven'><td><img src='../images/remove.png' id=removeWithID_previous"+arrayNode[i]["CustomerID"]+" onclick=removeIT('"+arrayNode[i]["CustomerID"]+"','previous') title=remove alt=remove value="+arrayNode[i]["CustomerID"]+"> &nbsp; <input type='checkbox' name='cuowners[]' value="+arrayNode[i]["CustomerID"]+"></td>";
                                    previousOwnersContent+="<td> <a href=customerMaster/update/"+ arrayNode[i]["CustomerID"]+" id="+ arrayNode[i]["CustomerID"]+" >"+ arrayNode[i]["CustomerNameArabic"]+"</a></td><td>"+ arrayNode[i]["Nationality"]+"</td><td><input id=share_"+Shareid+" name=share_"+Shareid+" class=peviousShare_"+arrayNodeB[j]["deed"]+" type=text value="+ sharePercentage+"></td></tr>";
                               }
                           }
                         previousOwnersContent+= "</table>" 
                     }
            }else{
                                  previousOwnersContent+="<tr><td colspan='2'>المالك السابق</td><td><input type=image class=addnewDeed src='../images/add.png' title='add owner' alt='add owner'>  &nbsp; </td></tr>";

//                 previousOwnersContent+="<tr><td>عفوا لا توجد نتائج في هذا الصنف</td></tr>"
            }       
//        $("#previousowner").html(previousOwnersContent);
//        var _previousOwner =  $("#previousowner").html();
        previousOwnersContent+= "</table></td></tr>";
        //****************************Previous Owners Table*****************************************
             
             if(Results["current"]["ArchiveUpdate"] == "True") {$("#verifiedDeed").css("display","");}//alert("I am"+Results["current"]["ArchiveUpdate"])
 var filesContent = "<table dir=rtl class=landFiles>";
//        finesContent+="<tr ><td colspan= 6>  " ;
//        finesContent+= landTab();
//        finesContent+="</td></tr>" ;
       if(typeof(Results["current"]["files"])!="undefined"){
                var arrayNode= Results["current"]["files"]
               filesContent+="<tr><td colspan='4'><strong> Files</strong></td><td></td></tr>";
               filesContent+="<tr><td>Actions </td><td> ملاحظات</td><td>تفاصيل النوع </td><td> التاريخ</td></tr>";
               for(var i = 0; i<arrayNode.length ; i++ ){
                   
                   if(arrayNode[i]["IsActive"] == '1') arrayNode[i]["IsActive"] ="Active"; else arrayNode[i]["IsActive"]="Not Active"
                       if(typeof(arrayNode[i]["DateCreated"]!="undefined") && arrayNode[i]["DateCreated"]!=null) arrayNode[i]["DateCreated"] = dubaiDate(arrayNode[i]["DateCreated"]); 
                             else arrayNode[i]["DateCreated"] = ""
                             
                        if(typeof(arrayNode[i]["caption"]!="undefined") && arrayNode[i]["Title"]!=null) {
                            arrayNode[i]["Title"] =arrayNode[i]["Title"].split(".")
                            arrayNode[i]["Title"] = arrayNode[i]["Title"][0]
                        }
                        filesContent+="<tr><td><img src='../images/remove.png' id=removeWithID_"+arrayNode[i]["FileID"]+" onclick=removeIT("+arrayNode[i]["FileID"]+",'files') title=remove alt=remove value="+arrayNode[i]["FileID"]+"> &nbsp;"
                        filesContent+="<input type='checkbox' name='cuowners[]' value="+arrayNode[i]["id"]+"></td>"
                        filesContent+="<td>"+getFileTilteDD(arrayNode[i]["FileID"],arrayNode[i]["Title"])
                        filesContent+="<input id='_caption_"+arrayNode[i]["FileID"]+"' name='_caption_"+arrayNode[i]["FileID"]+"' type=hidden value='"+ arrayNode[i]["Tile"]+"'  ></td>";
//                        filesContent+="<td>"+ arrayNode[i]["caption"]+"</td>"
                        filesContent+="<td><a href='../images/uploads/"+arrayNode[i]["Image"]+"' target='_blank'>"+arrayNode[i]["Title"]+"</a></td><td>"+arrayNode[i]["DateCreated"]+"</td>";
                        filesContent+="</tr>";
               }
     }else{
                 filesContent+="<tr><td>عفوا لا توجد نتائج في هذا الصنف</td></tr>"
     } 
                  //****************************Files Table*****************************************

        $("#fileList").html(filesContent);
        finesContent+= "</table>";
    var landdetailsContent = "<table dir=rtl  >";
    landdetailsContent+="<tr ><td colspan= 6>  " ;
    landdetailsContent+= landTab();
    landdetailsContent+="</td></tr>" ;
    landdetailsContent+="<tr ><td colspan= 6>  " ;
    landdetailsContent+= "Deed Type:&nbsp; <input type=text id=deedRemarks name=deedRemarks value='"+Results["current"]["Remarks"]+"' />, created on "+Results["current"]["DateCreated"];
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
        landdetailsContent+="<td>"+currentOwnersContent+finesContent+previousOwnersContent+"</td></tr>";  
        landdetailsContent+="<tr ><td colspan= 6>  " ;
    landdetailsContent+=' '
    landdetailsContent+="</td></tr>" ;


    

        //**************************** Land Info Table*****************************************
        
       
//    landdetailsContent+="<tr><td>"+_previousOwner+"</td></tr>" ;
//        landdetailsContent+="<td>"+finesContent+"</td></tr>";  
    landdetailsContent+= "</table>";
         $("#landresult").html(landdetailsContent);
}

function dubaiDate(datestring){
    datestring= datestring.split(' ')

    var oldDate = datestring[0].split('-');
    var newDate =  oldDate[2]+"-"+oldDate[1]+"-"+oldDate[0]
    return newDate;
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
  
function removeIT(id, type){
      if(type=="fines") if(deleteFines(id)) $("#removeWithID_"+id).closest('tr').remove();
          
      if(type=="files") if(deleteFiles(id)) $("#removeWithID_"+id).closest('tr').remove();
//          else{ debugger;if(deleteOwner(id))
      if(type=="owner")  { $("#removeWithID_"+id).closest('tr').remove(); currentOwnerArray.splice(currentOwnerArray.indexOf(id),1)}
      
      if(type=="previous")  { $("#removeWithID_previous"+id).closest('tr').remove(); previousOwnerArray.splice(previousOwnerArray.indexOf(id),1)}
//         }      
  }
  
function deleteOwner(id){
      
            var customerID = id ;
            var deedID = $("#_deedID").val()
//            var share =  $("#_share").val()
            var shareTotal = getShareTotal();
            var thisShareToDel = $("#removeWithID_"+customerID).closest('input [type=text]' ).val()
            debugger;
            if(shareTotal == 100 && thisShareToDel==0){ 
                 $.ajax({ 
                   type: "POST",
                   url:'DocumentMaster/DeleteOwner', 
                   data: "customerID="+customerID+"&deedID="+deedID,
                   success: function(data) 
                   { 
                       showMessage("Owner Removed");
                   }
               })
           }else {showMessage("Please set the share to zero '0' and Totak of share to 100 and try again.", "error"); return false}
      return true
  }
  
function deleteFines(id){
        
        $.ajax({ 
            type: "POST",
            url:'DocumentMaster/DeleteFine', 
            data: "HajzID="+id,
            success: function(data) 
            {
                showMessage("Fine Removed");
            }
        })
     return true
  }
  
function deleteFiles(id){
        
        $.ajax({ 
            type: "POST",
            url:'DocumentMaster/DeleteFile', 
            data: "FileID="+id,
            success: function(data) 
            {
                showMessage("File removed sucessfully", "sucess");
            }
        })
      return true
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
//                      alert("suseccfully updated")
                       showMessage("Land Data suseccfully updated");
                        
                   }
               })
      
  }
  
function updateCaption(id){
//    alert(id)
    var caption= $("#caption_"+id).val();
    var captionOld= $("#_caption_"+id).val();
    if( caption != captionOld && caption!=""){
//        alert(id+caption);
     $.ajax({ 
                   type: "POST",
                   url:'DocumentMaster/UpdateImageCaption', 
                   data: "id="+id+"&caption="+caption,
                   success: function(data) 
                   {
                       showMessage("File title suseccfully updated");
                    $("#caption_"+id).closest('tr').css("background-color", "#CCFFCC");
                    setTimeout(function(){ $("#caption_"+id).closest('tr').css("background-color", "white");},3000);
                   }
               })
    }
}

function updateShare(doAjax){ 
    
/* This method will create the array of shares and send it to server to perform DB update*/
if(doAjax == "" || doAjax == null)doAjax =false;
var deedType = $("#deedType").val()
 if(deedType!="previousDeed") var deedID = $("#_deedID").val()
 else var deedID = $("#previous_DeedID").val();
 
        if($(".shareTxt").length<1){
            var total = 0;
             
             
             var shareJson = "["; 
            $.each($(".sharetxt"),function(i,j){
                var shareValue = $(this).val();
//                alert($(this).id)
                if(shareValue > 0 && $(this).val()!="NaN"){    
                    total+=eval($(this).val());

                    var CustomerID = currentOwnerArray[i];
//                    debugger
                    shareJson += "{CustomerID:'"+CustomerID+"', sharePercentage:'"+shareValue+"'}," 
                }
            })
            shareJson = shareJson.replace(/(^,)|(,$)/g, "");
            shareJson += "]"
          
            if((total< 100 || total > 100) ) showMessage("Total of shares percentage must be 100", "error",5000);
                else {
                    showMessage("Total of Sahre is 100%");
                     if(doAjax=="true"){ 
                            $.ajax({ 
                                   type: "POST",
                                   url:'DocumentMaster/UpdateLandOwnerShare', 
                                   data:"&formData="+JSON.stringify({deedID:deedID,shareData: shareJson}),
                                   success: function(data) 
                                   {
                                        showMessage("Land Owners And Share Data Suseccfully Updated","sucess");

   //                                 $("#share_"+id).closest('tr').css("background-color", "#CCFFCC");
   //                                 setTimeout(function(){ $("#share_"+id).closest('tr').css("background-color", "white");},3000);
                                   }
                        })
                   } 
            }
        }

//    }
}

function updateDeed(deedID){ 
//    var id =$(this).attr("id");
    
/* This method will create the array of shares of previous deed and send it to server to perform DB update*/
//if(doAjax == "" || doAjax == null)doAjax =false;
//var deedType = $("#deedType").val()
// if(deedType!="previousDeed") var deedID = $("#_deedID").val()
// else
     var deedID = deedID;//$("#previous_DeedID").val();
 
        if($(".peviousShare_"+deedID).length>0){//  xdebugger
            var total = 0;
            var shareJson = "["; 
            $.each($(".peviousShare_"+deedID),function(i,j){
                var shareValue = $(this).val();
//                alert($(this).val())
                if(shareValue > 0 && $(this).val()!="NaN"){    
                    total+=eval($(this).val());

                    var CustomerID = $(this).closest('tr').find('a').attr('id');//previousOwnerArray[deedID][i];
//                    debugger;
                    shareJson += "{CustomerID:'"+CustomerID+"', sharePercentage:'"+shareValue+"'}," 
                }
            })
            shareJson = shareJson.replace(/(^,)|(,$)/g, "");
            shareJson += "]"
          
            if((total< 100 || total > 100) ) showMessage("Total of shares percentage must be 100", "error",5000);
                else {
                    showMessage("Total of Sahre is 100%");
//                     if(doAjax=="true"){ 
                            $.ajax({ 
                                   type: "POST",
                                   url:'DocumentMaster/UpdateLandOwnerShare', 
                                   data:"&formData="+JSON.stringify({deedID:deedID,shareData: shareJson}),
                                   success: function(data) 
                                   {
                                        showMessage("Land Owners And Share Data Suseccfully Updated","sucess");

   //                                 $("#share_"+id).closest('tr').css("background-color", "#CCFFCC");
   //                                 setTimeout(function(){ $("#share_"+id).closest('tr').css("background-color", "white");},3000);
                                   }
                        })
//                   } 
            }
        }

}

function showMessage(messageContent, alertType, delay){
    if(delay == null || delay =="") delay = 3000;
    if(alertType == null || alertType =="") alertType =  "normal";
     $("#messagDiv").addClass("messageDiv");
     $("#messagDiv").css("display", "");
     if(alertType == "error")   $("#messagDiv").css("background-color", "pink");
     if(alertType == "sucess")   $("#messagDiv").css("background-color", "#CCFFCC");
     else $("#messagDiv").css("background-color", "#EFEDAC")
                        $("#messagDiv").html(messageContent);
                        setTimeout(function(){ $("#messagDiv").css("display","none");},delay);
}

function getShareTotal(){
    var total = 0;
                $( this ).dialog( "close" );
                    $.each($(".sharetxt"),function(i,j){
//                  alert($(this).id)
                    shareValue = $(this).val();
                    if(shareValue > 0 && $(this).val()!="NaN")
                    total+=eval($(this).val());
                
                })
   return total;
}

function addOwnerToDB(){
    
     var customerID = $("#_customerID").val() ;
                var deedID = $("#_deedID").val()
                var deedType = $("#deedType").val()
                var previous_DeedID = $("#previous_DeedID").val()
                var share = $("#_share").val()
                var ArabicName = $("#customerSearch").val();
                var Nationality = $("#_nationality").val();
               
                if(deedType!="previousDeed") var deedID = $("#_deedID").val()
                else var deedID = $("#previous_DeedID").val();
                
      var dataTosend = "customerID="+customerID+"&deedID="+deedID+"&Share="+share+"&ArabicName="+ArabicName+"&Nationality="+Nationality;
//                }
//                else var dataTosend = "customerID="+customerID+"&deedID="+deedID+"&Share="+share+"&ArabicName="+ArabicName+"&Nationality="+Nationality;
//                    $( this ).dialog( "close" ); //commented so diloge remains opened as discussed with Omar           
               

                 var shaertotal=getShareTotal();
               
                     if(shaertotal > 100) showMessage("Total of shares percentage must be less than or 100 to add new Owner.", "error",5000);
              $.ajax({ 
                           type: "POST",
                           url:'DocumentMaster/AddOwner', 
                           data: dataTosend,
                           success: function(data) 
                           { var Results = JSON.parse(data); 
                                var res = Results.result
                                var customerID = Results.customerID;
                                var shareID = Results.shareID;
                                if(res==1){

                   if(customerID!="undefined" && customerID!=""){
                       
                           if(deedType !="previousDeed"){ 
                                if(jQuery.inArray(customerID, currentOwnerArray)=="-1") 
                                    {debugger
                                        $('<tr><td><img src="../images/remove.png" title=remove id=removeWithID_'+customerID+' onclick=removeIT('+customerID+',"owner")> &nbsp; <input type=checkbox name=cuowners[] value='+customerID+' > </td><td><a href="customerMaster/update/'+customerID+'" target=_blank>'+$("#customerSearch").val()+'</a></td> <td>'+$("#_nationality").val()+' </td> <td><input type=text value="'+share+'" class=sharetxt  size=5> </td></tr>').appendTo('.currentOwners');
                                         currentOwnerArray.push(customerID);
     //                                    if(100-getShareTotal()<=100 && 100-getShareTotal()>=0)$("#_share").val(100-getShareTotal()) ;
                                           $("#_share").val("0")

                                }else showMessage("Customer is already in land list", "error");
                           }
                           else if(deedType =="previousDeed"){ //alert('#previous_'+previous_DeedID);
                                if(jQuery.inArray(customerID, previousOwnerArray)=="-1") 
                                    {
                                        $('<tr class="'+previous_DeedID+' previousOwnerhead"><td><img src="../images/remove.png" title=remove id=removeWithID_previous'+customerID+' onclick=removeIT('+customerID+',"previous")> &nbsp; <input type=checkbox name=cuowners[] value='+customerID+' > </td><td><a id='+customerID+' href="customerMaster/update/'+customerID+'" target=_blank>'+$("#customerSearch").val()+'</a></td> <td>'+$("#_nationality").val()+' </td> <td><input id=share_'+shareID+' type=text value="'+share+'" class=peviousShare_'+deedID+' class=sharetxt  size=5> </td></tr>').appendTo('#previous_'+previous_DeedID);
//                                         previousOwnerArray[deedID].push(customerID);
     //                                    if(100-getShareTotal()<=100 && 100-getShareTotal()>=0)$("#_share").val(100-getShareTotal()) ;
                                           $("#_share").val("0")

                                }else showMessage("Customer is already in land list", "error");
                           }
                           
                 }
                                showMessage("Owner Added");
                               
                                 
//                                 updateShare(true);
                                }
                                else {alert("Sorry This record could not be processed OR Try with another customer."); showMessage("Sorry This record could not be processed", "error");}

                           }
                       })
}

function addOwnerRow(){
   
               showMessage("Data of owner received");
                customerID ="old"
                var customerID = $("#_customerID").val() ;
                var deedID = $("#_deedID").val()
                 var share = $("#_share").val()
                var ArabicName = $("#customerSearch").val();
                 var Nationality = $("#_nationality").val();
//                 if( $("#newCustomer").attr("checked")=="checked" ) { 
//                    customerID ="new"
                    var dataTosend = "customerID="+customerID+"&deedID="+deedID+"&Share="+share+"&ArabicName="+ArabicName+"&Nationality="+Nationality;
//                }
//                else var dataTosend = "customerID="+customerID+"&deedID="+deedID+"&Share="+share+"&ArabicName="+ArabicName+"&Nationality="+Nationality;
                    //commented so diloge remains opened as discussed with Omar           
               if(customerID!="undefined" && customerID!=""){
                           if(jQuery.inArray(customerID, currentOwnerArray)=="-1") 
                               {
                                   $('<tr><td><img src="../images/remove.png" title=remove id=removeWithID_'+customerID+' onclick=removeIT('+customerID+',"owner")> &nbsp; <input type=checkbox name=cuowners[] value='+customerID+' > </td><td><a href="customerMaster/update/'+customerID+'" target=_blank>'+$("#customerSearch").val()+'</a></td> <td>'+$("#_nationality").val()+' </td> <td><input type=text value="'+$("#_share").val()+'" class=sharetxt  size=5> </td></tr>').appendTo('.currentOwners');
                                    currentOwnerArray.push(customerID);
                                    if(100-getShareTotal()<=100 && 100-getShareTotal()>=0)$("#_share").val(100-getShareTotal()) ;
                               
                           }else showMessage("Customer is already in land list", "error");
                 }
             
}

function getFileTilteDD(DDID, selected){
    var DDoptionArray = ['1','b','c'];
    var DD = "<select id=caption_"+DDID+" onchange=updateCaption('"+DDID+"')>"
        $.each(DDoptionArray, function(i,j){
            if(j==selected)DD+=       "<option value="+j+" selected=selected>"+j+"</option>"
                else DD+=       "<option value="+j+">"+j+"</option>"
        })
        DD+= "</select>"
        return DD;
}
  
 