دخل رقم السند<!--<input type='text' id='landid'>-->
 <?php
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

<input type='button' value='اطبـــع' id='print' style='margin-top:10px;'>
<input type='button' value='اطـبع No GIS' id='printnogis' style='margin-top:10px;'>

<br><br>
<b>تحويل معاملة قديمة الى جديدة:<br><br></b>
رقم السند القديم:  <?php
				$url = $this->createUrl("DeedMaster/landsfind");
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'name'=>'oldlandid',
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
            ---> رقم السند الجديد<input type='text' id='newlandid'><input type='button' value='تحويل' id='convert'>


<script>
$('#print').click(function() { 
	
	var searchstring = $("#landid").val();
	
	var paramJSON = JSON.stringify(searchstring);
	
	$.post(
	'<?php echo $this->createUrl("deedMaster/getdeed")?>', //who will receive the ajax data and process it.. landresult action in contractsMaster controller
				{ data: paramJSON },
				function(data) //The function that will be called when data is sent back.
				{					
					var deedResult = JSON.parse(data); 
					console.log(deedResult);
					var url = '<?php echo $this->createUrl("contractsMaster/printmukhattat/"); ?>';
					url+="/"+deedResult;
					var contractPrint = window.open(url);
					
					$('#landid').val("");
					
				}
			)});
			
$('#printnogis').click(function() { 
	
	var searchstring = $("#landid").val();
	
	var paramJSON = JSON.stringify(searchstring);
	
	$.post(
	'<?php echo $this->createUrl("deedMaster/getdeed")?>', //who will receive the ajax data and process it.. landresult action in contractsMaster controller
				{ data: paramJSON },
				function(data) //The function that will be called when data is sent back.
				{					
					var deedResult = JSON.parse(data); 
					console.log(deedResult);
					var url = '<?php echo $this->createUrl("contractsMaster/printmukhattatnogis/"); ?>';
					url+="/"+deedResult;
					var contractPrint = window.open(url);
					
					$('#landid').val("");
					
				}
			)});
			
$('#convert').click(function() {
	
	var oldlandid = $('#oldlandid').val();
	var newlandid = $('#newlandid').val();
	var params = {
		oldlandid: oldlandid,
		newlandid: newlandid,
	}
	
	var paramJSON = JSON.stringify(params);
	
	$.post(
	'<?php echo $this->createUrl("contractsMaster/convert"); ?>',
	{ data: paramJSON },
	function(data)
	{
		var result = JSON.parse(data);
		console.log(result);
		$('#landid').val("");
		$('#oldlandid').val("");
		$('#newlandid').val("");
		if (result=='success')
			alert("تم التحويل");
	}
	)});

	
</script>

