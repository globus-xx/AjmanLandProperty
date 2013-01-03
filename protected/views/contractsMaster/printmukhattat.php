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

<script>
$('#print').click(function() { 
	
	var searchstring = $("#landid").val();
	
	
	var params = {
		landid: searchstring,
		
	}
	
	var paramJSON = JSON.stringify(params);
	
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
	
</script>

