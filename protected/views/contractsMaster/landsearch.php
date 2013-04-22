<?php
/* @var $this ContractsMasterController */
/* @var $dataProvider CActiveDataProvider  */


$this->menu=array(
	array('label'=>'إدارة العقود', 'url'=>array('admin')),
);
?>

<h2 align="right">عقد جديد - <?php echo $contract_type; ?></h2>
<!--<p align="right"><i>Please enter any one owner name in Arabic or English or his/her Mobile number in order to view their current land ownerships</i><p>-->
<p align="right"> يرجى ادخال اسم المالك باللغة العربية او رقم الهاتف المتحرك او رقم سند الملكية<br>
للبحث عن سند ملكية سابق
</p>
<div align="right">
<input type="text" value="" id="searchstring"/>

</div> <!-- Place where the table of results will be rendered, this is rendered using the js function fillsearchresult -->

<div class="searchresult">

    <table id="tableresult">
    </table>

</div>

<style>
.itemrecord
{
    cursor:pointer;
}
.itemrecord:hover
{
    background-color:rgb(100,200,250);
}
.hajzrecord
{
	cursor:pointer;
}
.hajzrecord
{
	background-color: rgb(255,150,150);
}
</style>

<script type='text/javascript'>

    $("#searchstring").keyup(function() {
        //console.log("testing only"); //puts something out in the java-script console which can be accessed from the web-browser

        var searchstring = $("#searchstring").val();
        if (searchstring.length<4)
        {
        	return;
    	}
	    var paramJSON = JSON.stringify(searchstring);	 //ensuring that info sent to the server is stringed!
		console.log(searchstring);
		$.post(
			'<?php echo $this->createUrl("contractsMaster/landresult")?>', //who will receive the ajax data and process it.. landresult action in contractsMaster controller
			{ data: paramJSON },
			function(data) //The function that will be called when data is sent back.
			{
				console.log("i came back");
                
                var customerResult = JSON.parse(data); 

                fillSearchResult(customerResult); //call this function
                initItemrecord(); //and this function ...
                
				 
			}
		);

    });


    function fillSearchResult(searchResult)
    {

            var ctr = 0;
            $("#tableresult").empty();
            $("#tableresult").html("<tr bgcolor='khaki')><td>رقم سند</td><td>رقم الملكية</td><td>ألملاك</td><td>الموانع</td></tr>");

            for(i in searchResult) //loop thruogh returned results from controller (coming from ajax above)
            {
                ctr+=1;
                 var resultObj = searchResult[i];
                
                 var landId = resultObj.LandId;
                 var deedId = resultObj.DeedId;
                 var customer = resultObj.CustomerNameArabic;
                
                if(resultObj.hajzDetails == null)
                {
                        var hajz = "--";
                        $("#tableresult").find("tbody").append("<tr class='itemrecord'  id='"+deedId+"'><td>"+landId+"</td><td>"+deedId+"</td><td>"+customer+"</td><td>--</td></tr>"); 
                }
                else
                { 
                      var hajz=resultObj.hajzDetails;
                      var hajzID = resultObj.hajzID[0];
                     
                      $("#tableresult").find("tbody").append("<tr class='hajzrecord'  id='"+deedId+"'><td>"+landId+"</td><td>"+deedId+"</td><td>"+customer+"</td><td id='hajzclick'><a href='/AjmanLandProperty/index.php/hajzMaster/"+hajzID+"'>"+hajz+"</a></td></tr>"); 
				} 	  
             
               
            }
            
    }

/* We're calling this function after the table has been rendered, then to add a click functionality on the class=itemrecord. 
You couldn't have done this before as the table didn't exist. */
    function initItemrecord()
    {		
            $(".itemrecord").click(function() {
                
                var c_type=<?php echo $ctype; ?>;
                var deedId = $(this).attr("id"); //get deedID from html-ID of clicked row .. this refers to the clicked portion of itemrecord
                console.log("clicking row...." + deedId); //debugging purposes only
                location.href =   '<?php echo $this->createUrl("contractsMaster/create")?>' + "/id/" + deedId + "/type/" + c_type; 
                //pass the deedID to a new location now.. above as can be seen, the create action ..with the appropriate id.. 
            });
    }
</script>





















