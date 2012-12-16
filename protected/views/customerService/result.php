<html>
	
<style>

table, th, td
{
	border: 1px solid black;
}

</style>
<body dir='rtl'>

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
		
		<div id='customerresult'>
			Info for Customer Name: Omar Ali Ibrahim
		</div>
		
		<div id='areasearch'>
			List of Lands in a certain area
		</div>
		
		<div id='countryresult'>
			List of customers of a country
		</div>
	
	</div>
	
</body>

	<script type='text/javascript'>
		
		//Hide all on-load
		$('#landresult').hide(); 
		$('#customerresult').hide(); 
		$('#areasearch').hide();
		$('#countryresult').hide(); 
		
	</script>
</html>
