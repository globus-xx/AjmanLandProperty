<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<h1>مقدمة</h1>
<p id='here' style="visibility:hidden;"></p>


<link type="text/css" href="/AjmanLandProperty/css/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="/AjmanLandProperty/js/jquery-1.8.1.min.js"></script> 
<script type	='text/javascript'>
	
	$("body").keypress(function(event) {
		
		var x = String.fromCharCode(event.which);
		var y =$('#here').text();
		$('#here').text(y+x);
		console.log($('#here').text());
		if($('#here').text().search('موطني')>=0 || $('#here').text().search("l,'kd")>=0)
		{
			window.open('http://www.youtube.com/watch?v=S2GI-MSYO3Q');
			$('#here').text("");
		}
	});



</script>
