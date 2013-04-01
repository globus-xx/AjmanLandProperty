<h1>حدث بيانات الارض </h1>

<?php

$locationsT = array();
$locations = array();
$lines = file('/var/www/AjmanLandProperty/protected/data/locations.csv', FILE_IGNORE_NEW_LINES);

foreach ($lines as $key => $value)
{
    $locationsT[] = str_getcsv($value);
    
}
foreach($locationsT as $key=>$value)
{
	$locations[] = $value[0];

}
                $url = $this->createUrl("DeedMaster/landsfind");
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'name'=>'landid',
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


<input type='button' value='حدث' id='update'>

<script type='text/javascript'>

$('#update').click(function() { 
	
	var searchstring = $("#landid").val();
	var paramJSON = JSON.stringify(searchstring);
	
	$.post(
	'<?php echo $this->createUrl("landMaster/getland")?>', //who will receive the ajax data and process it.. landresult action in contractsMaster controller
				{ data: paramJSON },
				function(data) //The function that will be called when data is sent back.
				{					
					var deedResult = JSON.parse(data); 
					console.log(deedResult['LocationID']);
					fillinfo(deedResult);
				}
			)});

			function fillinfo(deedResult)
                        {
                              /*  $('#LocationID').val(deedResult['LocationID']);
                                $('#location').val(deedResult['location']);
                                $('#Plot_No').val(deedResult['Plot_No']);
                                $('#Piece').val(deedResult['Piece']);
                                $('#Land_Type').val(deedResult['Land_Type']);
                                $('#length').val(deedResult['length']);
                                $('#width').val(deedResult['width']);
                                $('#TotalArea').val(deedResult['TotalArea']);
                                $('#AreaUnit').val(deedResult['AreaUnit']);
                                $('#North').val(deedResult['North']);
                                $('#South').val(deedResult['South']);
                                $('#East').val(deedResult['East']);
                                $('#West').val(deedResult['West']);
								$('#Remarks').val(deedResult['Remarks']);*/
								$('#RemarksValuation').val(deedResult['RemarksValuation']);
                        }


</script>
<input type="hidden" id="LocationID">
<input type="hidden" id="AreaUnit">
<h3>بيانات الارض</h3>
		
		<div id="LandInfo">
		
		<table>
		
		<!--<tr>
		<td>المنطقة:<?php
			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'name'=>'location',
                    //'model'=>$model,
                    //'attribute'=>'Nationality',
                    'source'=>$locations, //came from the controller.. the array we constructed of all names, arabic and english
                    // additional javascript options for the autocomplete plugin
                    'options'=>array(
                        'minLength'=>'1',
                    ),
                    'htmlOptions'=>array(
                        'style'=>'height:20px;'
                    ),
                ));
		?></td>
		<td>الحوض: <input type='text' id='Plot_No' size=1px></td>
		<td>القطعة: <input type='text' id='Piece' size=3px></td>
		</tr>
		
		<tr><td>الطول: <input type='text' id='length' size=2px></td>
		<td>العرض: <input type='text' id='width' size=2px></td>
		
		<td>المساحة: <input type='text' id='TotalArea' size=3px></td>
		</tr>
		
		<tr><td>شمالا:<input type='text' id='North' class='directions'></td>
		<td>جنوبا: <input type='text' id='South' class='directions'></td>
		<td>شرقا: <input type='text' id='East' class='directions'></td>
		<td>غربا: <input type='text' id='West' class='directions'></td></tr>
		
		<tr>
		<td>ملاحظة: <input type='text' id='Remarks'></td>-->
		<tr>
		<td>ملاحظة لجنة التثمين: <input type='text' id='RemarksValuation'></td>
		</tr>
		
		</table>
	
		</div>
		
<input type='button' value='حفظ' id='save'>

<script type='text/javascript'>

	$('.directions').keyup(function(event) {
		
		if (event.keyCode==219)
		{
			var dID = "#" + event.target.id;
			console.log($(dID).val());
			$(dID).val($(dID).val()+"ار");
		}
		
		if (event.keyCode==65)
		{
			var dID = "#" + event.target.id;
			$(dID).val($(dID).val()+"ارع");
		}
		
		if (event.keyCode==83)
		{
			var dID = "#" + event.target.id;
			$(dID).val($(dID).val()+"كة");
		}
	});

	$('#save').click(function() { 
		/*var landid = $('#landid').val();
		var LocationID = $('#LocationID').val();
		var location = 	$('#location').val();
		var Plot_No =$('#Plot_No').val();
		var Piece = $('#Piece').val();
		console.log(Piece);
		var Land_Type =	$('#Land_Type').val();
		var len = $('#length').val();
		var width =	$('#width').val();
		var TotalArea =	$('#TotalArea').val();
		var AreaUnit =	$('#AreaUnit').val();
		var North =	$('#North').val();
		var South =	$('#South').val();
		var East = $('#East').val();
		var West = $('#West').val();        
		var Remarks = $('#Remarks').val();*/
		var RemarksValuation = $('#RemarksValuation').val();
		
		var params = {
			/*landid: landid,
			LocationID: LocationID,
			location: location,
			Plot_No: Plot_No,
			Piece: Piece,
			Land_Type: Land_Type,
			len: len,
			width: width,
			TotalArea: TotalArea,
			AreaUnit: AreaUnit,
			North: North,
			South: South,
			East: East,
			West: West,
			Remarks: Remarks,*/
			RemarksValuation: RemarksValuation,
		}

		console.log(params['Piece']);
        	var paramJSON = JSON.stringify(params);

        $.post(
        '<?php echo $this->createUrl("landMaster/tathmeen")?>', //who will receive the ajax data and process it.. landresult action in contractsMaster controller
                                { data: paramJSON },
                                function(data) //The function that will be called when data is sent back.
                                {
                                        var saveresults = JSON.parse(data); 
                                        alert("تم حفظ معلومات الارض");
					window.location.href='<?php echo $this->createUrl("CustomerMaster/admin"); ?>';
                                }
                        )});


</script>

