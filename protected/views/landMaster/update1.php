<h1>ابحث عن رقم السند القديم</h1>

رقم السند الجديد
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




<script type='text/javascript'>

$('#landid').keyup(function() { 
	
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
                                $('#LocationID').val(deedResult['LocationID']);
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
								$('#Remarks').val(deedResult['Remarks']);
                        }


</script>
<input type="hidden" id="LocationID">
<input type="hidden" id="AreaUnit">

------->   &nbsp;&nbsp;رقم سند القديم:<input type='text' id='Remarks'>
		
		<div id="LandInfo">
		
		<table>
		
		<tr style='visibility:hidden;'>
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
		
		<tr style='visibility:hidden;'><td>الطول: <input type='text' id='length' size=2px></td>
		<td>العرض: <input type='text' id='width' size=2px></td>
		
		<td>المساحة: <input type='text' id='TotalArea' size=3px></td>
		</tr>
		
		<tr style='visibility:hidden;'><td>شمالا:<input type='text' id='North' class='directions'></td>
		<td>جنوبا: <input type='text' id='South' class='directions'></td>
		<td>شرقا: <input type='text' id='East' class='directions'></td>
		<td>غربا: <input type='text' id='West' class='directions'></td></tr>
		
		</table>
	
		</div>
