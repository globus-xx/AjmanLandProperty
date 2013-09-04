رقم السند
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
<br><br>
<div id="tohide">
الجهة الطالبة: <?php echo CHtml::dropDownList('department','',array('التصرفات العقارية'=>'التصرفات العقارية','الشؤون القانونية'=>'الشؤون القانونية','خدمة المتعاملين'=>'خدمة المتعاملين','الشؤون الهندسية'=>'الشؤون الهندسية','لجنة التثمين والمصالحة'=>'لجنة التثمين والمصالحة','شؤون
المكاتب'=>'شؤون
المكاتب','مكتب المدير العام'=>'مكتب المدير العام','مدير ادارة الشؤون العقارية'=>'مدير ادارة الشؤون العقارية')); ?>

&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;المستلم:  <?php echo CHtml::dropDownList('receiver','',array('ahmad'=>'ahmad','bravo'=>'badf','sfsdf'=>'asfdsf','asdfdasf'=>'afsdf',)); ?>
<input type="hidden" id="fileid">
</div>

<div id="fileinfo">
    
</div>

<br><br>
<input type='button' id="send" value="خروج">
<input type='button' id="receive" value="إستلام">

<script type='text/javascript'>

$('#send').hide();
$('#receive').hide();
$('#fileinfo').hide();
$('#tohide').hide();

$('#landid').bind('dblclick',function() {
	
		var LandID = $("#landid").val();
		var jLandID = JSON.stringify(LandID);	 
       
		$.post(
			'<?php echo $this->createUrl("fileTracker/checkfile")?>', 
			{ data: jLandID },
			function(data) 
			{
		        result = JSON.parse(data); 
                console.log(result[0]['DateTime']);
                console.log(result[0]['Department']);
                console.log(result[0]['UserIDgiver']);
                console.log(result[0]['UserIDreceiver']);
                console.log(result[0]['id']);
                
				if(result!='none')
                {
                    $('#tohide').hide();
                    $('#send').hide();
                    $('#receive').show();

                    $('#fileinfo').html("<b>giver</b>&nbsp;&nbsp;&nbsp;"+result[0]['UserIDgiver']+"&nbsp;&nbsp;&nbsp;&nbsp;<b>Receiver</b>&nbsp;&nbsp;&nbsp;"+result[0]['UserIDreceiver']+"&nbsp;&nbsp;&nbsp;&nbsp;<b>Department</b>&nbsp;&nbsp;&nbsp;"+result[0]['Department']+"&nbsp;&nbsp;&nbsp;&nbsp;<b>Date</b>&nbsp;&nbsp;&nbsp;"+result[0]['DateTime']);
                    $('#fileid').val(result[0]['id']);
                    $('#fileinfo').show();

                }
                else
                {
                    $('#tohide').show();
                    $('#send').show();
                    $('#receive').hide();
                    $('#fileinfo').hide();
                    
                }
			}
		);
		
	});
    
$("#send").click(function() {
    var r=confirm("Are you sure?");
    if (r==true)
        {
            console.log("sent");

            var department= $('#department').val();
            var receiver = $('#receiver').val();
            var landid = $('#landid').val();
            

            params = {
                department: department,
                receiver: receiver,
                landid: landid,
                
            }
            
            var paramJSON = JSON.stringify(params);	
            $.post(
		            '<?php echo $this->createUrl("fileTracker/send")?>',
		            { data: paramJSON },
		            function(data)
		            {
                        return;
                    }
            );
                
            window.location.reload();
        }
    else
        {
            console.log('cancelled');
        }
});



$("#receive").click(function() {
    var r=confirm("Are you sure?");
    if (r==true)
        {
            var department= $('#department').val();
            var receiver = $('#receiver').val();
            var landid = $('#landid').val();
            var id = $('#fileid').val();
            
            params = {
                department: department,
                receiver: receiver,
                landid: landid,
                id: id,
            }
            
            var paramJSON = JSON.stringify(params);	
            $.post(
		            '<?php echo $this->createUrl("fileTracker/receive")?>',
		            { data: paramJSON },
		            function(data)
		            {
                        return;
                    }
            );
            
            
            window.location.reload();
        }
    else
        {
            console.log('cancelled');
        }
});
</script>
