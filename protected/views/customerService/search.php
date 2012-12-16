<html>
	
<style>

table, th, td
{
	border: 1px solid black;
}

</style>
<body dir='rtl'>
	
	<span id='searchmsg'>دخول الأراضي ID، اسم العميل، رقم الجوال، البلد أو المنطقة لمزيد من العمل &nbsp;</span>
	
	  <?php

		$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'name'=>'searchstring',
			'source'=>$autocomplete, //came from the controller.. the array we constructed of all names, arabic and english
			// additional javascript options for the autocomplete plugin
			'options'=>array(
				'minLength'=>'4',
			),
			'htmlOptions'=>array(
				'style'=>'height:20px;'
			),
		));
	?>
	
	<br><br>
	
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
		
		$("#searchstring").keyup(function() 
		{
			var searchstring = $("#searchstring").val();

			if (searchstring.length<4)
			{
				return;
			}

			var paramJSON = JSON.stringify(searchstring);	 //ensuring that info sent to the server is stringed!
			
			$.post(
				'CustomerService/Search', 
				{ data: paramJSON },
				function(data) 
				{
					var Results = JSON.parse(data); 	
					console.log(Results);
					//LAND ID entered and only 1 returned LAND ID	
					if (Results[0]['LandID'])
					{
						$('#landresult').show();
						$('#customerresult').hide(); 
						$('#areasearch').hide();
						$('#countryresult').hide(); 
						console.log(Results);
						displayLandInfo(Results);
						
					}	
					
					//One particular customer-name found
					if (Results.length ==1 && Results[0]['CustomerID'])
					{
						$('#landresult').hide();
						$('#customerresult').show(); 
						$('#areasearch').hide();
						$('#countryresult').hide(); 
						console.log(Results);
						displayCustomerInfo(Results);
					}
					
					//A country was entered, and a list of customers belonging to the country are returned
					if (Results.length >1 && Results[0]['CustomerID'])
					{
						$('#landresult').hide();
						$('#customerresult').hide(); 
						$('#areasearch').hide();
						$('#countryresult').show(); 
						console.log(Results);
						displayCountryInfo(Results);
						
					}
						
				}
			);

		});
		
		function displayLandInfo(result)
		{
			$('#landid').text(result[0]['LandID']);
			
			//****************************Land Info Table*****************************************
			var landstr = "<tr><td>"+result[0]['location']+"</td>	<td>Plot No: "+result[0]['Plot_No']+"</td><td>Piece No: "+result[0]['Piece']+"</td><td>Total Area: "+result[0]['TotalArea']+"</td></tr><tr><td>شمالا: "+result[0]['North']+"</td><td>جنوبا: "+result[0]['South']+"</td><td>شرقا: "+result[0]['East']+"</td><td>غربا: "+result[0]['West']+"</td></tr>";
						
			$('#landinfo').empty();
			$('#landinfo').html('<tbody></tbody>');
			$('#landinfo').find('tbody').append(landstr);
			//*************************************************************************************
			
			//*************************Current Owners**********************************************
			
			var currentowners = "<tr><td>ID</td><td>Omar</td><td>Palestine</td><td>100%</td></tr>"
								
			$('#currentowners').empty();
			$('#currentowners').html('<tbody><th>customer ID</th>	<th>Customer Name</th>	<th>Nationality</th>	<th>Share</th></tbody>');
			$('#currentowners').find('tbody').append(currentowners);
			
		}
		
		function displayCustomerInfo(result)
		{
		}
		
		function displayCountryInfo(result)
		{
		}
	</script>

</html>


