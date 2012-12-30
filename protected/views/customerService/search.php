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
#letterTable {
    background-color: #80CFFF;
}
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
            
            <div id='previouslandresult'>123</div>
            <div id='fines'></div>
            <div id='previousowner'></div>
		
		<div id='customerresult'>
			Loading...
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
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/search.js'); ?>

    
<table style="width:400px;" id="letterTable">
    <tr><td>من فضلك ادخل المعلومات التالية لتوليد رسالة:</td></tr>
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
        <select name="letterid" style="width:155px;height:23px;" >  
                   
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
        <input type="submit" name="stype" value="التالي" onclick="return EmptyTextbox()"></td></tr>

</table>

</form>
        
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
//						displayCustomerInfo(Results);
                                                diplayUserDetails(Results[0]['CustomerID'], 0)
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
                                                 $('#letterTable').show();	

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
 		});
		
	
        </script>


</body>
</html>


