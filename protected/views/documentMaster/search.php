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

                          $( "#addOwner-form" ).dialog( "open" );
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
//                         $(".currentOwners tr" ).on("click", "#removeWithID", function(){alert("i")
////                       .click(function() {
//                            alert($(this).value+"ss")
//                            deleteOwner($(this).id);
//debugger
//                          $(this).closest('tr').remove();
//                        });


                          
 		});
		
	
        </script>
<div id="addOwner-form" title="Add new owner">
  <p class="validateTips">All form fields are required.</p>
 
  <form>
  <fieldset>
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
<!--    <input type="text" _customerNameArabic="name" id="_customerNameArabic" class="text ui-widget-content ui-corner-all" />-->
    <label for="email">Nationality</label>
    <input type="text" name="_nationality" id="_nationality" value="" class="text ui-widget-content ui-corner-all" />
    <input type="text" name="_share" id="_share" value="" class="text ui-widget-content ui-corner-all" />
    
    <input type="hidden" name="_customerID" id="_customerID" value="" class="text ui-widget-content ui-corner-all" />
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
</body>
</html>

    
