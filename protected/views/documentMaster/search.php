<html>
	
<style>

table, th, td
{
	border: 1px solid white;
}
.tab{
    background-color: #EFFDFF;
    padding: 2px;
}
.deed {
    background-color: #C9E0ED
}

.previousOwnerhead {
    background-color: #EFFDFF;
    font-size: 13px;
    margin: 2px 2px;
}

.previousOwnerEven {
    background-color: #ccc;
     margin: 2px 2px;    
}

.previousOwnerOdd {
    background-color: #F8F8F8
}
.landDetails {
    background-color: #C9E0ED
}
.currentOwners {
    background-color: #ccc
}
.landFines {
    background-color: #ccc
}
#letterTable {
    background-color: #80CFFF;
}
label { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#users-contain { width: 350px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
.messageDiv{background-color: #EFEDAC; border-bottom-color: #ccc ; border: 1px; width: 200px; height: 55px; text-align: center; padding: 5px; margin: -95px 650px 0 0px; position: fixed; border-radius: 10px;z-index: 10;  }    
  </style>

<script type="text/javascript" >
function EmptyTextbox() {
 
// check if the textbox is blank
if (letterForm.destination.value == "") {

alert("من فضلك ادخل اسم الوجهة !!!");
return false;
} // end if

} // end function
</script>

<body dir="rtl" >

     <form id="SearchForm" method="post">من فضلك ادخل أي كلمة
    <?php
				$url = $this->createUrl("DocumentMaster/CustomerSearch");
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'name'=>'searchstring',
                    'source'=>$url,
                    //'source'=>$customerNames, //came from the controller.. the array we constructed of all names, arabic and english
                    // additional javascript options for the autocomplete plugin
//                    'options'=>array(
//                        'minLength'=>'3',
//                    ),
                   
                    'options'=>array(
         'minLength'=>'4',
         'focus'=>'js:function( event, ui ) {
          $( "#searchstring" ).val( ui.item.CustomerNameArabic );
   return false;
  }',
         'select'=>'js:function( event, ui ) {$("#searchstring").val( ui.item.label );$("#name").val( ui.item.Nationality ); return false; }',
     ),
                    'htmlOptions'=>array(
                        'style'=>'height:20px;'
                    ),
                ));
            ?>
 <input type="submit" value ="البحث">
 <div id="verifiedDeed" style="display: none; float: left; background-color: #CCFFCC; border-bottom-color: #ccc ; border: 1px; width: 200px; height: 55px; text-align: center; padding: 5px;"> ملاحظة : تم التحقق من السجل   <br> Notice: Record is verified</div>
 <div id="messagDiv" style=" float: left; "></div>
    </form>
	
	<br><br><div class='searchresult'>
	
		<div id='landresult'>
			<h6>معلومات لرقم سند : <span id='landid'></span></h6>
			
			<table id='landinfo'>
			</table>
			
			<h6>المالك الحالي :</h6>
			<table id='currentowners'>
				<th>رقم الزبون</th>	<th>اسم الزبون</th>	<th>الجنسية</th>	<th>مشاركة</th>
			</table>
			
			<h6>المالك السابق:</h6>
			<table id='previousowners'>
				<tr><th>Date 1</th></tr>
					<th>رقم الزبون</th>	<th>اسم الزبون</th>	<th>الجنسية</th>	<th>مشاركة</th>			
			</table>
			
		</div>
            
            <div id='previouslandresult'>123</div>
            <div id='fines'></div>
            <div id='previousowner'></div>
		
		<div id='customerresult'>
			تحميل ...
		</div>
		
		<div id='areasearch'>
			قائمة بالاراضي في منطقة معينة 
		</div>
		
		<div id='countryresult'>
			تحميل ...
		</div>
                
                <div id='loadingresult'>
			تحميل ...
		</div>
            
                <div id='customerprofile'>
			تحميل ...
		</div>
	
	</div>
        
      
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/searchDocumentDetails.js'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.uploadify.min.js'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/uploadify.css" />
        

           <script type="text/javascript" >
           
          
            
		var listType;
		//Hide all on-load
		hideAll();
		
		$("#SearchForm").submit(function(event) 
		{ event.preventDefault();
                    $('#letterForm #landid').val($('#searchstring').val());
                    
			 $('#loadingresult').show();
                        var searchstring =  new Array();
                          searchstring["action"] = "search";


			var paramJSON = JSON.stringify(searchstring);	 //ensuring that info sent to the server is stringed!

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
                                                $('#customerid').val(Results[0]['CustomerID']); 
//						displayCustomerInfo(Results);
                                                

                                                diplayUserDetails(Results[0]['CustomerID'], 0, Results[0])
					}
					
					//A country was entered, and a list of customers belonging to the country are returned
					else if (Results.length >1 && Results[0]['CustomerID'])
					{
						hideAll();
						
						console.log(Results);
						displayCountryInfo(Results);
                                                $('#loadingresult').hide();
						
					}
                                        
                                        else if (typeof(Results["landInfo"])!="undefined" )
					{ 
                                                 hideAll();
						$('#landresult').show();
                                                $("#uploadButton").show()
//                                                 $('#letterTable').show();	

						console.log(Results);
						displayLandInfo(Results);
						
					}	

				 $('#loadingresult').hide();		
				}
                        });
                        
                        $('.searchLink').unbind('click').click(function(){
                            var searchString = $(this).text()
                             $("#searchstring").val(searchString);
                              $("#SearchForm").trigger('submit')
                          });
                          
                          

                        $("#addnew" ).click(function() {
                             $("#_share").val("");
                             var shareTotal = getShareTotal();
                            
                           
//                             if(shareTotal<100) 
                                                    $("#addDeed").hide();
                                                    $( "#addOwner-form" ).dialog( "open" );
                                                    $("#_customerID").val("") ;
                                                    $("#previous_DeedID").val("") ;
                                                    $("#deedType").val("") ;
                                                    $("#_nationality").val("") ;//alert(100-getShareTotal());
                                                    if(100-getShareTotal()<=100 && 100-getShareTotal()>=0)$("#_share").val(100-getShareTotal()) ;
                                                    $("#customerSearch").val("") ;
//                             }
//                            else showMessage("Add owner is not allowed, Share total must be less than 100", "error", 5000)
                       });
                       $(".addnewDeed" ).click(function() {
                             $("#_share").val("");
                             var shareTotal = getShareTotal();
                             var deedid = $(this).attr("id")
                            var deedType = "previousDeed"
//                           debugger
//                             if(shareTotal<100) 
                                                   if(deedid=="" || typeof(deedid)=="undefined"){
                                                        $("#addDeed").show();
                                                   }else{
                                                        $("#addDeed").hide();
                                                        }
                                                    $( "#addOwner-form" ).dialog( "open" );
                                                    $("#_customerID").val("") ;
                                                    $("#_nationality").val("") ;//alert(100-getShareTotal());
                                                    if(100-getShareTotal()<=100 && 100-getShareTotal()>=0)$("#_share").val(100-getShareTotal()) ;
                                                    $("#customerSearch").val("") ;
                                                    $("#deedType").val(deedType) ;
                                                    if(typeof(deedid!="undefined" || deedid!=""))$("#previous_DeedID").val(deedid) ;
                                                   
//                             }
//                            else showMessage("Add owner is not allowed, Share total must be less than 100", "error", 5000)
                       });
                        $("#addnewFine" ).click(function() { 

                          $( "#addFine-form" ).dialog( "open" );
                         
                          $( "#addFine-form #_landIDspan" ).html( $("#LandID").val());
                           $( "#addFine-form #_LandID" ).val( $("#LandID").val());
                                                    
//                          $( "#addFine-form #_deedIDspan" ).html($("#deedID" ).val());
                           $( "#addFine-form #_DeedID" ).val( $("#_deedID").val());
                          
                        });
                        
                         $("#_DateCreated").datepicker({ 
                            dateFormat: "dd-mm-yy",
                            altField: "#DateCreated",
                            altFormat: "yy-mm-dd"
                          });
                            $("#_DeedDate").datepicker({ 
                            dateFormat: "dd-mm-yy",
                            altField: "#DeedDate",
                            altFormat: "yy-mm-dd"
                          });
//                         $(".currentOwners tr" ).on("click", "#removeWithID", function(){alert("i")
////                       .click(function() {
//                            alert($(this).value+"ss")
//                            deleteOwner($(this).id);
//debugger
//                          $(this).closest('tr').remove();
//                        });


                          
 		});
		
	
        </script>
        <div style="display: none">
        
<div id="addOwner-form" title="Add new owner">
  <p class="validateTips">All form fields are required.</p>
 
  <form id="ownerForm" name="ownerForm">
   <div id="addDeed"  name="addDeed"  style="display: none">                 <fieldset>
<!--                     <label for="_share">Deed Type</label>
                  <input type="text" name="_DeedType" id="_DeedType" value="" class="sharetxt" size="5"  />-->
<label for="email">Date Created</label>
                  <input type="text" name="_DeedDate" id="_DeedDate" value=""  class="text ui-widget-content ui-corner-all" />
                  <input type="hidden" name="DeedDate" id="DeedDate" value="" class="text ui-widget-content ui-corner-all" />
                    <input type="button" id="addDeedButton" name="addDeedButton" value="Add Deed"></div>
                  <label for="name">Name</label>
                  <?php
                                              $url = $this->createUrl("DocumentMaster/CustomerSearch");
                              $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                  'name'=>'customerSearch',
                                  'source'=>$url,
                                  //'source'=>$customerNames, //came from the controller.. the array we constructed of all names, arabic and english
                                  // additional javascript options for the autocomplete plugin
                                  'options'=>array(
                              'minLength'=>'3', // min chars to start search
                              'showAnim'=>'fold',
                              //focus option will tell what is displayed in field during the selection
                              'focus'=> 'js:function( event, ui ) {
                                  $( "#customerSearch" ).val( ui.item.CustomerNameArabic );
                                  return false;
                              }',
                              //select function will tell where go each field
                              'select'=>'js:function( event, ui ) {

                                 $("#newCustomer").attr("checked", false)
                                  $( "#_nationality" ).val(ui.item.Nationality);
                                  $( "#_customerID" ).val(ui.item.CustomerID);
                                  return false;
                              }'
                      ),
                                  'htmlOptions'=>array(
                                      'style'=>'height:20px;'
                                  ),
                              ));
                          ?>

                  <label for="email">Nationality</label>
                  <?php
                              $url = $this->createUrl("DocumentMaster/NationalitySearch");
                              $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                                  'name'=>'_nationality',
                                  'source'=>$url,
                                  // additional javascript options for the autocomplete plugin
                                  'options'=>array(
                                  'minLength'=>'3', // min chars to start search
                                  'showAnim'=>'fold',
                                  //select function will tell where go each field
                                  ),
                                  'htmlOptions'=>array(
                                      'style'=>'height:20px;'
                                  ),
                              ));
                          ?>

                  <label for="_share">Share</label>
                  <input type="text" name="_share" id="_share" value="" class="sharetxt" size="5"  />
                  <input type="hidden" name="_LandID" id="_LandID" class="text ui-widget-content ui-corner-all" />
                  <input type="text" name="previous_DeedID" id="previous_DeedID" class="text ui-widget-content ui-corner-all" />
                  <input type="hidden" name="deedType" id="deedType" class="text ui-widget-content ui-corner-all" />
                  <input type="hidden" name="_customerID" id="_customerID" value="new" class="text ui-widget-content ui-corner-all" />
  </fieldset>
  </form>
</div>
 <?  Yii::app()->clientScript->registerScript('input', '
        $("#customerSearch").data("autocomplete")._renderItem = function( ul, item ) {
        return $( "<li></li>" )
    .data( "item.autocomplete", item )
    .append( "<a>"+item.CustomerNameArabic + " - " + item.Nationality+"</a>")
    .appendTo( ul );
    };');?>
        
        
 <div id="addFine-form" title="Add new Fine">
  <p class="validateTips">All form fields are required.</p>
 
  <form id="fineForm" name="fineForm">
                <fieldset>
                  <label for="name"><span id="_landIDspan">land id</span>&nbsp; :LandID &nbsp; 
              <!--        <br> DeedID:&nbsp; <span id="_deedIDspan">deed id</span> --></label>
                   <input type="hidden" name="test" id="test" class="text ui-widget-content ui-corner-all" />
                      <input type="hidden" name="_LandID" id="_LandID" class="text ui-widget-content ui-corner-all" />
                      <input type="hidden" name="_DeedID" id="_DeedID" class="text ui-widget-content ui-corner-all" />
                  <label for="email">Mortgaged Amount</label>
                  <input type="text" name="AmountMortgaged" id="AmountMortgaged" value="" class="text ui-widget-content ui-corner-all" />
                  <label for="email">Type</label>

                  <input type="radio" name="Type" id="_isActive_active" checked="checked"   value="رهن" >&nbsp;رهن &nbsp;
                      <input type="radio" name="Type" id="_isActive_deactive" value= "حجز" >  &nbsp;  حجز  &nbsp; 

                  <label for="email">Type Details</label>
                  <input type="text" name="TypeDetail" id="TypeDetail" value="" class="text ui-widget-content ui-corner-all" />
                  <label for="email">Remarks</label>
                  <input type="text" name="Remarks" id="Remarks" value="" class="text ui-widget-content ui-corner-all" />
                  <label for="email">Date Created</label>
                  <input type="text" name="_DateCreated" id="_DateCreated" value=""  class="text ui-widget-content ui-corner-all" />
                  <input type="hidden" name="DateCreated" id="DateCreated" value="" class="text ui-widget-content ui-corner-all" />
                  <label for="email">Status</label>
                  <input type="radio" name="IsActive" id="_isActive_active" value="1" checked="checked">Active &nbsp;
                  <input type="radio" name="IsActive" id="_isActive_deactive" value="0" >Not Active

                       <input type="hidden" name="_test" id="_test" class="text ui-widget-content ui-corner-all" />

                </fieldset>
  </form>
  
  
</div>  
        </div>
        <div id="uploadButton" style="display: none">
            
            <div id="fileList"><strong>Land/Deed Files</strong></div>
            <form>
		<div id="queue"></div>
		Uploaded Files(Only Image files are allowed)<br><div id ="fileUploadList"></div><br>
                <input id="file_upload" name="file_upload" type="file" multiple="true">
	</form>

	<script type="text/javascript">//alert('http://localhost<?php print Yii::app()->baseUrl?>/index.php/documentMaster/uploadify');
		var index = 0;
                    var filesArray = new Array();
                    filesArray =  '['; 
                    function setFileArrayToNull(){filesArray=""; filesArray =  '[';}
                   function setFileArray(file, name){
                    
                    filesArray +='{ fileName:"'+file+'" , imageName:"'+name+'" },';
                    }
                    function getFileArray(){//alert(filesArray[1]["imageName"]);
                        filesArray = filesArray.replace(/(^,)|(,$)/g, "")
                        return filesArray+"]"}
                        <?php $timestamp = time();?>
		$(function() {
                    
                                      
                      
			$('#file_upload').uploadify({
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>',
                                        'deedID'    :   '',
                                        'landID'    :   ''
				},
                                'onUploadStart' : function(file) 
                                    {
                                        var deedID = $("#_deedID").val();
                                        var landID = $("#LandID").val();
                                        $('#file_upload').uploadify('settings','formData',{ 'deedID' : deedID, 'landID' : landID });
                                    },

                                    'onUploadSuccess' : function(file, data, response) {
//            alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
             $("#fileUploadList").append("<br><span>"+file.name+"</span>")
             setFileArray(file.name, data)
//                                        debugger
                                       
        },
                                'onQueueComplete' : function(queueData) {
                                        
                                         var deedID = $("#_deedID").val();
                                        var landID = $("#LandID").val();
//                                        debugger;
                                        var fileData = getFileArray()
                                        setFileArrayToNull()

                                        $.ajax({ 
                                                type: "POST",
                                                 dataType: "json",
                                                url:'DocumentMaster/AddFile', 
//                                                data: fileData,//"action=search&string="+$("#searchstring").val(),
                                                data:"&formData="+JSON.stringify({deedID:deedID,landID:landID,
                                                      fileData: fileData}),
                                                async:false,
                                                success: function(data) { 

                                                            $("#SearchForm").trigger('submit')
                                                            showMessage("All Files Uploaded Sucessfully");
                                                }        
                                       });
                                    },
				'swf'      : '<?php print Yii::app()->baseUrl . '/js/'?>uploadify.swf',
				'uploader' : '<?php print Yii::app()->baseUrl?>/js/uploadify.php'
//                                'uploader' : 'http://localhost<?php print Yii::app()->baseUrl?>/index.php/documentMaster/uploadify'       
			});
		});
	</script>
        <div id="divMarkUpdate" > 
            
            <input type="button" id="markUpdate" name="markUpdate" value="Mark Updated by Archive" width="5" height="5" />
        </div>
        </div>
        
        	
</body>
</html>

    
