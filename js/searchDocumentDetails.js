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
/**
 * set the event and load the forms for add/edit the owner and fines.
 */
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
                                         showMessage("تم اضافة العقد","sucess");

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
/**
 * add owner in the previous deed only on the page, no change in the DB
 * @param {integer} id, previous deedid in which the owner will be added 
 * @returns {undefined}
 */
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
/**
 * 
 * hide all the widgets on the page
 */
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
/** 
 * 
 * @param {string} searchString
 * trigger the search with the search string.
 */
function doSearchSubmit(searchString){// will call on the click of customer name or automatically on search
    $("#searchstring").val(searchString);
    $("#SearchForm").trigger('submit')

}
/**
	 * display Land Info is the most important and main method.
         * Parse and set the presentation of the searched land from the data information in paramenetr.
	 * @param json resultset Results from the server ajax response
         * this will set land info
         * the Deed Information, with owners and shares
         * the file records
         * the fines details of the land
         * the previous deeds with owners and their shares
         * Set the options to add/updates, delete owners/shares of the current and previous deed.
         *  
	 */   
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

       if(typeof(Results["fines"])!="undefined"){
                var arrayNode= Results["fines"]
               finesContent+="<tr ><td colspan='4'><strong>غرامات الارض</strong></td><td><input type=image id=addnewFine src='../images/add.png' title='add hajaz' alt='add hajaz'> &nbsp; <img src='../images/remove.png' title=remove alt=remove >&nbsp;  </td></tr>";
               finesContent+="<tr bgcolor=#C9E0ED><td>ID </td><td> ملاحظات</td><td>الكمية المرهونة </td><td>تفاصيل النوع </td><td> التاريخ</td></tr>";
               
               for(var i = 0; i<arrayNode.length ; i++ ){
                   var active; 
                active="<img src='../images/activate.png' id=changeActive_"+arrayNode[i]["HajzID"]+" height=32 width=32 onclick=changeActive("+arrayNode[i]["HajzID"]+",'1') title='غير مفعل' alt='غير مفعل' value="+arrayNode[i]["HajzID"]+">"; 
                   if(arrayNode[i]["IsActive"] == '1') {arrayNode[i]["IsActive"] ="Active";
                        active="<img src='../images/dactive.png' id=changeActive_"+arrayNode[i]["HajzID"]+" height=32 width=32 onclick=changeActive("+arrayNode[i]["HajzID"]+",'0') title=مفعل alt=مفعل  value="+arrayNode[i]["HajzID"]+">";
                    } else arrayNode[i]["IsActive"]="Not Active"
                       if(typeof(arrayNode[i]["DateCreated"]!="undefined") && arrayNode[i]["DateCreated"]!=null) arrayNode[i]["DateCreated"] = dubaiDate(arrayNode[i]["DateCreated"]); 
                             else arrayNode[i]["DateCreated"] =""
                        finesContent+="<tr><td>"+active+"<img src='../images/remove.png' id=removeWithID_"+arrayNode[i]["HajzID"]+" onclick=removeIT("+arrayNode[i]["HajzID"]+",'fines') title=remove alt=remove value="+arrayNode[i]["HajzID"]+">"
                        finesContent+=" &nbsp; <input type='checkbox' name='cuowners[]' value="+arrayNode[i]["CustomerID"]+">"+ arrayNode[i]["HajzID"]+"</td><td>"+ arrayNode[i]["Remarks"]+"</td>";
                        
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
                           var DateCreated = arrayNodeB[j]["DateCreated"];//alert(DateCreated+"ds")
                           
                           previousOwnersContent+="<tr class='deed  previousDeed_"+arrayNodeB[j]["deed"]+"'  ><td onclick='showDeedCustomersTR("+arrayNodeB[j]["deed"]+")' align='right' colspan='2'><strong>رقم العقد:"+arrayNodeB[j]["deed"]+"</strong></td>";
                           previousOwnersContent+="<td ><img onclick=updateDeed('"+arrayNodeB[j]["deed"]+"') src=../images/save.png id='"+arrayNodeB[j]["deed"]+"' />&nbsp;<input type=image alt='add owner' title='add owner' src='../images/add.png' class='addnewDeed' id='"+arrayNodeB[j]["deed"]+"'><img src='../images/remove.png' onclick=deletePreviousDeed('"+arrayNodeB[j]["deed"]+"','previousDeed')> </td></tr>";
                           previousOwnersContent+="<tr class=previousDeed_"+arrayNodeB[j]["deed"]+"><td colspan=2><input type=text id=deedDateCreated_"+arrayNodeB[j]["deed"]+" name=deedDateCreated_"+arrayNodeB[j]["deed"]+" value="+DateCreated+" ></td>"
                           previousOwnersContent+="<td> <input  type=text id=deedRemarks_"+arrayNodeB[j]["deed"]+" id=deedRemarks_"+arrayNodeB[j]["deed"]+"id=deedRemarks_"+arrayNodeB[j]["deed"]+" value="+arrayNodeB[j]["Remarks"]+"></td></tr>";
                           previousOwnersContent+="<tr class=previousDeed_"+arrayNodeB[j]["deed"]+"><td colspan=3><table id='previous_"+arrayNodeB[j]["deed"]+"' ><tr class='"+arrayNodeB[j]["deed"]+" previousOwnerhead'><td></td><td>اسم الزبون </td><td> جنسية الزبون</td><td>مشاركة(%)</td></tr>";
                           
                           $("#_DeedDate").datepicker({ 
                            dateFormat: "dd-mm-yy",
                            altField: "#DeedDate",
                            altFormat: "yy-mm-dd"
                          }); 
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
               filesContent+="<tr><td colspan='4'><strong> الملفات</strong></td><td></td></tr>";
               filesContent+="<tr><td>التعديل </td><td> ملاحظات</td><td>تفاصيل النوع </td><td> التاريخ</td></tr>";
               for(var i = 0; i<arrayNode.length ; i++ ){
                   
                   if(arrayNode[i]["IsActive"] == '1') arrayNode[i]["IsActive"] ="مفعل"; else arrayNode[i]["IsActive"]="غير مفعل"
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
//    landdetailsContent+= landTab();
    landdetailsContent+="</td></tr>" ;
    landdetailsContent+="<tr ><td colspan= 6>  " ;
    landdetailsContent+= "نوع العقد:&nbsp; <input type=text id=deedRemarks_"+Results["current"]["deed"]+" name=deedRemarks value='"+Results["current"]["Remarks"]+"' />, تم انشاؤها في <input id=deedDateCreated_"+Results["current"]["deed"]+" name=deedDateCreated_"+Results["current"]["deed"]+" type=text value="+Results["current"]["DateCreated"]+" />";
    landdetailsContent+="</td></tr>" ;
    landdetailsContent+="<tr>";
        landdetailsContent+="<td> <form id=landInfoForm name=landInfoForm ><input type=hidden id=testField name=testField><table width='50%' class=landDetails><tr> <td> <strong>تفاصيل الارض</strong><td><img src='../images/save.png' onclick=UpdateLandData('"+ Results["landInfo"]["LandID"]+"')></td></tr>";
                landdetailsContent+="<tr> <td> رمز المنطقة</td><td><a   >"+ Results["landInfo"]["LandID"]+"</a></td></tr>";
                landdetailsContent+="<tr><td>الحوض</td><td><input id=Plot_No name=Plot_No type=text value='"+ Results["landInfo"]["Plot_No"]+"'></td></tr>";
                landdetailsContent+="<tr><td>القطعة</td><td><input id=Piece name=Piece type=text value='"+ Results["landInfo"]["Piece"]+"'></td></tr>";
                landdetailsContent+="<tr><td>المنطقة</td><td><input id=location name=location type=text value='"+ Results["landInfo"]["location"]+"'></td></tr>";
                landdetailsContent+="<tr><td>النوع</td><td><input id=Land_Type name=Land_Type type=text value='"+ Results["landInfo"]["Land_Type"]+"'></td></tr>";
                landdetailsContent+="<tr><td>المساحة</td><td><input id=TotalArea name=TotalArea type=text value='"+ Results["landInfo"]["TotalArea"]+"'></td></tr>";
                landdetailsContent+="<tr><td>الطول</td><td><input id=length name=length type=text value='"+ Results["landInfo"]["length"]+"'></td></tr>";
                landdetailsContent+="<tr><td>العرض</td><td><input id=width name=width type=text value='"+ Results["landInfo"]["width"]+"'></td></tr>";
                landdetailsContent+="<tr><td>شمالا</td><td><input id=North name=North type=text value='"+ Results["landInfo"]["North"]+"'></td></tr>";
                landdetailsContent+="<tr><td>جنوبا</td><td><input id=South name=South type=text value='"+ Results["landInfo"]["South"]+"'></td></tr>";
                landdetailsContent+="<tr><td>شرقا</td><td><input id=East name=East type=text value='"+ Results["landInfo"]["East"]+"'></td></tr>";
                landdetailsContent+="<tr><td>غربا</td><td><input id=West name=West type=text value='"+ Results["landInfo"]["West"]+"'><input id=LandID name=LandID type=hidden value='"+ Results["landInfo"]["LandID"]+"'></td></tr>";
                landdetailsContent+="<tr><td>ملاحظات</td><td><input id=Remarks name=Remarks type=text value='"+ Results["landInfo"]["Remarks"]+"'></td></tr>";
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
/**
	 * Convert date to teh format dd-mm-yy from the mysql standard date.
	 * If delete is successful, file will be deleted from record message box will be updated on the top of the page.
	 * @param string datestring the date to be coverted
         
	 */  
function dubaiDate(datestring){
    datestring= datestring.split(' ')

    var oldDate = datestring[0].split('-');
    var newDate =  oldDate[2]+"-"+oldDate[1]+"-"+oldDate[0] //dd-mm-yy
    return newDate;
}


 /**
	 * Delete the Owner and deed assosiation record for the given customer ID .
	 * If delete is successful, file will be deleted from record message box will be updated on the top of the page.
	 * @param integer id the ID of the file record in files table
         * @param type 
         * type could be fine
         * owner, the owner from the current deed to be deleted
         * previous deed
         * previous, owner of the previous deed will be deleted
         * delete the html table row or div of the given id and type.
         * 
	 */   
function removeIT(id, type){
      if(type=="fines") if(deleteFines(id)) $("#removeWithID_"+id).closest('tr').remove();
          
      if(type=="files") if(deleteFiles(id)) $("#removeWithID_"+id).closest('tr').remove();
//          else{ debugger;if(deleteOwner(id))
      if(type=="owner")  { $("#removeWithID_"+id).closest('tr').remove(); currentOwnerArray.splice(currentOwnerArray.indexOf(id),1)}
      
      if(type=="previousDeed")  { $(".previousDeed_"+id).remove(); }
      
      if(type=="previous")  { $("#removeWithID_previous"+id).closest('tr').remove(); previousOwnerArray.splice(previousOwnerArray.indexOf(id),1)}
//         }      
  }
/**
	 * Delete the Owner and deed assosiation record for the given customer ID .
	 * If delete is successful, file will be deleted from record message box will be updated on the top of the page.
	 * @param integer id the ID of the file record in files table
         
	 */   
function deleteOwner(id){
      
            var customerID = id ;
            var deedID = $("#_deedID").val()
//            var share =  $("#_share").val()
            var shareTotal = getShareTotal();
            var thisShareToDel = $("#removeWithID_"+customerID).closest('input [type=text]' ).val()
            
            if(shareTotal == 100 && thisShareToDel==0){ 
                 $.ajax({ 
                   type: "POST",
                   url:'DocumentMaster/DeleteOwner', 
                   data: "customerID="+customerID+"&deedID="+deedID,
                   success: function(data) 
                   { 
                       showMessage("تم حذف المالك");
                   }
               })
           }else {showMessage("مين فضلك عدل قيمة المشاركة الى الصفر و مجموع االمشاركة يجب ان يكون 100 ثم حاول مرة اخرى .", "error"); return false}
      return true
  }
/**
	 * Delete the fine record for the given ID .
	 * If delete is successful, file will be deleted from record message box will be updated on the top of the page.
	 * @param integer id the ID of the fine record in fine table
         * 
	 */   
function deleteFines(id){
        
       var r=confirm("Are you sure to delete fine??");
        if (r==true)
          {  $.ajax({ 
                    type: "POST",
                    url:'DocumentMaster/DeleteFine', 
                    data: "HajzID="+id,
                    success: function(data) 
                    {
                        showMessage("تم حذف الغرامة");
                    }
                })
             return true
     }
  }
/**
	 * Delete the file record for the given ID .
	 * If delete is successful, file will be deleted from record message box will be updated on the top of the page.
	 * @param integer id the ID of the file record in files table
         * 
	 */  
function deleteFiles(id){
        
        $.ajax({ 
            type: "POST",
            url:'DocumentMaster/DeleteFile', 
            data: "FileID="+id,
            success: function(data) 
            {
                showMessage("تم حذف الملف", "sucess");
            }
        })
      return true
  }
/**
	 * Update the database for the given ID and data of land.
	 * If update is successful, message box will be updated on the top of the page.
	 * @param integer id the ID of the record in land table
         * 
	 */ 
function UpdateLandData(id){
      
            var landID = id ;
            var $inputs = $('#landInfoForm :input');

    // not sure if you wanted this, but I thought I'd add it.
    // get an associative array of just the values.
    var values = $('#landInfoForm').serialize();
    values = JSON.stringify(values);

                $.ajax({ 
                   type: "POST",
                   url:'DocumentMaster/UpdateLandData', 
                   data: values,
                   success: function(data) 
                   {
//                      alert("suseccfully updated")
                       showMessage("تم تعديل معلومات الارض");
                        
                   }
               })
      
  }
  
/**
	 * Update the database for the given ID and value of file title.
	 * If update is successful, message box will be updated on the top of the page.
	 * @param integer id the ID of the file record in files table
         * 
	 */
function updateCaption(id){

    var caption= $("#caption_"+id).val();
    var captionOld= $("#_caption_"+id).val();
    if( caption != captionOld && caption!=""){
//        do ajax and send the request to updtes DB
     $.ajax({ 
                   type: "POST",
                   url:'DocumentMaster/UpdateImageCaption', 
                   data: "id="+id+"&caption="+caption,
                   success: function(data) 
                   {
                       showMessage("تم تعديل اسم الملف بنجاح");
                    $("#caption_"+id).closest('tr').css("background-color", "#CCFFCC");
                    setTimeout(function(){ $("#caption_"+id).closest('tr').css("background-color", "white");},3000);
                   }
               })
    }
}
/**
	 * This method will create the array of shares of previous deed and send it to server to perform DB update
         * First check that if the total of share is 100% or not
	 * @param  the doAjax [boolean],  will do ajax and update DB if true else check and display the message. 
	 */
function updateShare(doAjax){ 
    
/* This method will create the array of shares and send it to server to perform DB update*/
        if(doAjax == "" || doAjax == null)doAjax =false;
        var deedType = $("#deedType").val()
         if(deedType!="previousDeed") var deedID = $("#_deedID").val()
         else var deedID = $("#previous_DeedID").val();
         var deedRemarks = $("#deedRemarks_"+deedID).val();
         var deedDateCreated = $("#deedDateCreated_"+deedID).val();
         var nonNumbershare = 0;
        if($(".shareTxt").length<1){
            var total = 0;
             
             
             var shareJson = "["; 
            $.each($(".sharetxt"),function(i,j){
                    if(i<$(".sharetxt").length-1){
                     var shareValue = $(this).val();
                     if(shareValue > 0 && $(this).val()!="NaN"){    
                         total+=eval($(this).val());

                         var CustomerID = currentOwnerArray[i];

                         shareJson += "{CustomerID:'"+CustomerID+"', sharePercentage:'"+shareValue+"'}," 
                     }else  {nonNumbershare = 1;alert("i am")}
                 }
            })
            shareJson = shareJson.replace(/(^,)|(,$)/g, "");
            shareJson += "]"
          
            if((total< 100 || total > 100) || nonNumbershare==1) showMessage("مجموع نسبة المشاركة يجب ان يكون 100 و يكون الادخال نوعه رقم ", "error",5000);
                else {
                    showMessage("مجموع المشاركة هي 100%");
                     if(doAjax=="true"){ 
                            $.ajax({ 
                                   type: "POST",
                                   url:'DocumentMaster/UpdateLandOwnerShare', 
                                   data:"&formData="+JSON.stringify({deedID:deedID,DateCreated:deedDateCreated,Remarks:deedRemarks,shareData: shareJson}),
                                   success: function(data) 
                                   {
                                        showMessage("تم تعديل ملاك الارض و نسب المشاركة","sucess");

   //                                 $("#share_"+id).closest('tr').css("background-color", "#CCFFCC");
   //                                 setTimeout(function(){ $("#share_"+id).closest('tr').css("background-color", "white");},3000);
                                   }
                        })
                   } 
            }
        }

//    }
}
/**
	 * This method will updat the deed data and the share with create the array of shares of previous deed and send it to server to perform DB update
         * First check that if the total of share is 100% or not
	 * @param  the deedID [int],  ID of teh fine table row
	 */
function updateDeed(deedID){ 
/* This method will create the array of shares of previous deed and send it to server to perform DB update*/
var deedID = deedID;//$("#previous_DeedID").val();
var deedRemarks = $("#deedRemarks_"+deedID).val();
var deedDateCreated = $("#deedDateCreated_"+deedID).val();
 
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
          
            if((total< 100 || total > 100) ) showMessage("مجموع نسبة المشاركة يجب ان يكون 100", "error",5000);
                else {
                    showMessage("مجموع نسبة المشاركة هي 100%");
//                     if(doAjax=="true"){ 
                            $.ajax({ 
                                   type: "POST",
                                   url:'DocumentMaster/UpdateLandOwnerShare', 
                                   data:"&formData="+JSON.stringify({deedID:deedID,DateCreated:deedDateCreated,Remarks:deedRemarks,shareData: shareJson}),
                                   success: function(data) 
                                   {
                                        showMessage("تم تعديل ملاك الارض و نسب المشاركة بنجاح","sucess");
                                   }
                        })
//                   } 
            }
        }

}
/**
	 * This method will create the array of shares of previous deed and send it to server to perform DB update
	 * @param  the deedID [int],  ID of teh fine table row
	 */
function deletePreviousDeed(deedID){ 
/* This method will create the array of shares of previous deed and send it to server to perform DB update*/

var deedID = deedID
 
 var r=confirm("Are you sure to delete the previous Deed??");
                if (r==true)
                  {
                   
                            $.ajax({ 
                                   type: "POST",
                                   url:'DocumentMaster/DeleteDeed', 
                                   data:"&formData="+JSON.stringify({deedID:deedID}),
                                   success: function(data) 
                                   {
                                        removeIT(deedID, "previousDeed")
                                        showMessage("تم تعديل ملاك الارض و نسب المشاركة بنجاح","sucess");

                                   }
                        })
                   } 


}
/**
	 * This method will change the status of fine with ID and status provided in arguments
         * Will update the DB and the fine status in the fines
	 * @param  the FineID [int],  ID of teh fine table row
         * @param  the FineStatus[0 or 1 ] value to be updated in active, 
         
	 */
function changeActive(FineID,FineStatus){ 
/* This method will change the status of fine with ID and status provided in arguments*/

        $.ajax({ 
                                   type: "POST",
                                   url:'DocumentMaster/ChangeActive', 
                                   data:"&formData="+JSON.stringify({FineID:FineID, FineStatus:FineStatus}),
                                   success: function(data) 
                                   {
                                        
                                        $("#changeActive_"+FineID).unbind('click');
                                                $("#changeActive_"+FineID).removeAttr('onclick');
                                                        if(FineStatus==0) {$("#changeActive_"+FineID).attr('src','../images/activate.png ');
                                                            $("#changeActive_"+FineID).click(function(){
                                                               changeActive(FineID,' 1')
                                                            })
                                                        }
                                                        else {$("#changeActive_"+FineID).attr('src','../images/dactive.png');
                                                             $("#changeActive_"+FineID).click(function(){
                                                                 changeActive(FineID, '0')
                                                            })
                                                        }$("#changeActive_"+FineID).unbind('click');
                                                $("#changeActive_"+FineID).removeAttr('onclick');
                                                        if(FineStatus==0) {$("#changeActive_"+FineID).attr('src','../images/activate.png ');
                                                            $("#changeActive_"+FineID).click(function(){
                                                               changeActive(FineID,' 1')
                                                            })
                                                        }
                                                        else {$("#changeActive_"+FineID).attr('src','../images/dactive.png');
                                                             $("#changeActive_"+FineID).click(function(){
                                                                 changeActive(FineID, '0')
                                                            })
                                                }
                                        showMessage("تم تعديل ملاك الارض و نسب المشاركة بنجاح","sucess");
                                   }
                        })
}
/**
	 * Display the message on the window
	 * @param  the messageContent [text],  the message to be displayed
         * @param  the alertType[text], 
         * the type of message could be error displayed in red color
         * the type of message could be sucess displayed in green color
         * @param  the delay[milisecond],  time interval after that message will be disappear automaticaly
	 */
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
/**
	 * calculate the total of the deed and return
	 * Get the share text fileds from teh document and calulate the total
	 */
function getShareTotal(){
    var total = 0;
                $( this ).dialog( "close" );
                    $.each($(".sharetxt"),function(i,j){
//                  alert($(this).id)
                    var shareValue = $(this).val();
                    if(shareValue > 0 && $(this).val()!="NaN")
                    total+=eval($(this).val());
                
                })
   return total;
}
/**
	 * Single method to add customer of the current deed or Previous Deeds 
         * Add Owner to DB and display the message accordingly.
	 * @param  the DeedId,  deeid, share, arabic name nationality of the owner
         * @param Deed type
	 */
function addOwnerToDB(){
    
     var customerID = $("#_customerID").val() ;
                var deedID = $("#_deedID").val()
                var deedType = $("#deedType").val()
                var previous_DeedID = $("#previous_DeedID").val()
                var share = $("#_share").val()
                var ArabicName = $("#customerSearch").val();
                var Nationality = $("#_nationality").val();
               
                if(deedType!="previousDeed") var deedID = $("#_deedID").val()// check if owner to be added in previous deed
                else var deedID = $("#previous_DeedID").val();
                
      var dataTosend = "customerID="+customerID+"&deedID="+deedID+"&Share="+share+"&ArabicName="+ArabicName+"&Nationality="+Nationality;
//                }
//                else var dataTosend = "customerID="+customerID+"&deedID="+deedID+"&Share="+share+"&ArabicName="+ArabicName+"&Nationality="+Nationality;
//                    $( this ).dialog( "close" ); //commented so diloge remains opened as discussed with Omar           
               

                 var shaertotal=getShareTotal(); // validate that the total of share is 100% or not
               
                     if(shaertotal > 100) showMessage("مجموع نسبة المشاركة يجب ان تكون اقل من او تساوي 100 حتى يتم بالامكان اضافة مالك", "error",5000)
                     {
                     
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
                                    {
                                        $('<tr><td><img src="../images/remove.png" title=remove id=removeWithID_'+customerID+' onclick=removeIT('+customerID+',"owner")> &nbsp; <input type=checkbox name=cuowners[] value='+customerID+' > </td><td><a href="customerMaster/update/'+customerID+'" target=_blank>'+$("#customerSearch").val()+'</a></td> <td>'+$("#_nationality").val()+' </td> <td><input type=text value="'+share+'" class=sharetxt  size=5> </td></tr>').appendTo('.currentOwners');
                                         currentOwnerArray.push(customerID);

                                           $("#_share").val("0")

                                }else showMessage("الزبون موجود بشكل مسبق في قائمة الارض ", "error");
                           }
                           else if(deedType =="previousDeed"){ //alert('#previous_'+previous_DeedID);
                                if(jQuery.inArray(customerID, previousOwnerArray)=="-1") 
                                    {
                                        $('<tr class="'+previous_DeedID+' previousOwnerhead"><td><img src="../images/remove.png" title=remove id=removeWithID_previous'+customerID+' onclick=removeIT('+customerID+',"previous")> &nbsp; <input type=checkbox name=cuowners[] value='+customerID+' > </td><td><a id='+customerID+' href="customerMaster/update/'+customerID+'" target=_blank>'+$("#customerSearch").val()+'</a></td> <td>'+$("#_nationality").val()+' </td> <td><input id=share_'+shareID+' type=text value="'+share+'" class=peviousShare_'+deedID+' class=sharetxt  size=5> </td></tr>').appendTo('#previous_'+previous_DeedID);

                                           $("#_share").val("0")

                                }else showMessage("الزبون موجود بشكل مسبق في قائمة الارض ", "error");
                           }
                           
                 }
                                showMessage("تم اضافة المالك بنجاح");
              }
               else {alert("عفوا  هذا السجل لم يتم معالجته او حاول مع زبون آخر"); showMessage("عفوا هذا السجل لم يتم معالجته", "error");}

                           }
                       })
                }   
}

/**
	 * Initilaize and return the file title dropdown.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param  DDID the ID of the file record in files table
         *  @param selected Value of the file title stored in DB, to load with dropdown
	 */
function getFileTilteDD(DDID, selected){
    //define the values in an array to create the dropdown, in future change/append the array to add updte the values
    var DDoptionArray = ['1','b','c'];
    var DD = "<select id=caption_"+DDID+" onchange=updateCaption('"+DDID+"')>" // calls updates Caption  function ton change even to updates DB
        $.each(DDoptionArray, function(i,j){
            if(j==selected)DD+=       "<option value="+j+" selected=selected>"+j+"</option>"
                else DD+=       "<option value="+j+">"+j+"</option>"
        })
        DD+= "</select>"
        return DD;
}
  
 