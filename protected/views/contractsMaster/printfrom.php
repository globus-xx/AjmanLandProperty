دخل رقم العقد: <input type='text' id='contractid'>
<input type='button' value='اطبع' id='print'>

<script>
$('#print').click(function() { 
		
		var url = '<?php echo $this->createUrl("contractsMaster/Print/"); ?>';
		url+="/"+$('#contractid').val();
		var contractPrint = window.open(url);
		
		var searchstring = $("#contractid").val();
		var paramJSON = JSON.stringify(searchstring);
	
		$.post(
		'<?php echo $this->createUrl("deedMaster/getdeedfromcontract")?>', //who will receive the ajax data and process it.. landresult action in contractsMaster controller
					{ data: paramJSON },
					function(data) //The function that will be called when data is sent back.
					{					
						var deedResult = JSON.parse(data); 
						console.log(deedResult);
						var url = '<?php echo $this->createUrl("contractsMaster/printdeedcertificate"); ?>';
						url+="/"+deedResult;
						
						var url1 = '<?php echo $this->createUrl("contractsMaster/printmukhattat"); ?>';
						url1+="/"+deedResult;
						
						var mukhattat = window.open(url1);
						var contractPrint = window.open(url);
						
					}
		)
		});
</script>
