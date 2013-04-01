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

<input type='button' value='معاينة قبل الطباعة' id='printview'>
<?php if(Yii::app()->User->ID==7 OR Yii::app()->User->ID==23 OR Yii::app()->User->ID==16) { echo "<input type='button' value='اطبع' id='print'>"; } ?>
<input type='button' value='اطبع السابق' id='printold'>

<script>
	
$('#printview').click(function() { 

var searchstring = $("#landid").val();
var paramJSON = JSON.stringify(searchstring);

$.post(
'<?php echo $this->createUrl("deedMaster/getdeed")?>', //who will receive the ajax data and process it.. landresult action in contractsMaster controller
			{ data: paramJSON },
			function(data) //The function that will be called when data is sent back.
			{					
				var deedResult = JSON.parse(data); 
				console.log(deedResult);
				var url = '<?php echo $this->createUrl("deedMaster/Printview/"); ?>';
				url+="/"+deedResult;
				var contractPrint = window.open(url);
			}
		)});

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
					var url = '<?php echo $this->createUrl("deedMaster/Print/"); ?>';
					url+="/"+deedResult;
					var contractPrint = window.open(url);
				}
			)});

$('#printold').click(function() { 
	
	var searchstring = $("#landid").val();
	var paramJSON = JSON.stringify(searchstring);
	
	$.post(
	'<?php echo $this->createUrl("deedMaster/getdeedold")?>', //who will receive the ajax data and process it.. landresult action in contractsMaster controller
				{ data: paramJSON },
				function(data) //The function that will be called when data is sent back.
				{					
					var deedResult = JSON.parse(data); 
					console.log(deedResult);
					console.log(deedResult.length);
					var url = '<?php echo $this->createUrl("deedMaster/Printold/"); ?>';
					url+="/"+deedResult[deedResult.length-1];
					var contractPrint = window.open(url);
				}
			)});


</script>
