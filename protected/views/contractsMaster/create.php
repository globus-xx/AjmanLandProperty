<body onload="all()" dir="rtl">
<?php
/* @var $this ContractsMasterController */
/* @var $model ContractsMaster */



$this->menu=array(
	array('label'=>'قائمة العقود السابقة', 'url'=>array('index')),
	array('label'=>'إدارة العقود', 'url'=>array('admin')),
);

?>


<h1>عقد جديد --- رقم سند <?php echo $deedMaster->LandID; ?></h1>


<div id="form-message"></div>
<div>
    <div style="padding-bottom:25px; font-size:1.3em;">

        <span>حدد نوع العقد</span>
        <select id="contractype" style='font-size:1.2em; width:100px;' disabled='disabled'>
                <option value="0">&nbsp;&nbsp;بيع</option>
                <option value="1">&nbsp;&nbsp;وراثة</option>
                <option value="2">&nbsp;&nbsp;تنازل</option>
                <option value="3">&nbsp;&nbsp;وقف</option>
                <option value="4">&nbsp;&nbsp;هبة</option>
        </select>
        <span>&nbsp;&nbsp;&nbsp;نوع الارض: </span>
        <select id="landtype" style='font-size:1.2em; width:100px;'>
			<option value='ارض خالية'>&nbsp;&nbsp;ارض خالية</option>
			<option value='فيلا'>&nbsp;&nbsp;فيلا</option>
			<option value='بناية'>&nbsp;&nbsp;بناية</option>
			<option value='شبرة'>&nbsp;&nbsp;شبرة</option>
			<option value='بيت عربي'>&nbsp;&nbsp;بيت عربي</option>
			<option value='محلات'>&nbsp;&nbsp;محلات</option>
		</select>
        </select>
        
        <script type='text/javascript'>
			var type = <?php echo $type; ?>;
			$('#contractype').val(type);
			console.log(type);
			$('#contracttype').attr('disabled',true);
		</script>
    
    </div>
 <div style='clear:both;'></div> 
    <div style="float:right;border:1px;width:25%;padding:0px; background-color: rgb(245,235,255);">
            <h3>الملاك</h3>
            <div style='height:27px;'></div>
            <div >
                    <div style='float:right'>&nbsp;</div>
                    <div style='float:right; width:80%; font-weight: 900;'><input type="checkbox" id="selectall">الاسم</div>
                    <div style='float:right; width:15%; font-weight: 900;'>النسبة</div>
         
            </div>
            <div style='clear:both;height:15px;'></div>

            <?php
                    $deedDetails = $deedMaster->deedDetails;
                    foreach($deedDetails as $deedowner)
                    {
                            $customerId       = $deedowner->customer->CustomerID;
                            $customerName = $deedowner->customer->CustomerNameArabic;
                            $customerShare = $deedowner->Share;
                            echo "<div>
                                            <div style='float:right;width:10%;'><input type='checkbox'/ id='".$customerId."' class='ownercheckbox'></div>
                                            <div style='float:right;width:70%;'><a target='_blank' href='".$this->createUrl('customerMaster/update/')."/".$customerId."'>" .$customerName. "</a></div>
                                            <div style='float:right;width:10%;'>".$customerShare. " </div>
                                 
                                    </div>";
                            echo "<div style='clear:both;'></div>";
                    }
            ?>
    </div>
    <div style="float:right;border:1px;width:37.5%; background-color: rgb(225,240,245);">
            <h3>المشترين</h3>

            <?php
				$url = $this->createUrl("contractsMaster/auto");
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'name'=>'buyers',
                    'source'=>$url,
                    //'source'=>$customerNames, //came from the controller.. the array we constructed of all names, arabic and english
                    // additional javascript options for the autocomplete plugin
                    'options'=>array(
                        'minLength'=>'4',
                    ),
                    'htmlOptions'=>array(
                        'style'=>'height:20px;'
                    ),
                ));
            ?>
            <input type="button" value="أضف" id="addbuyer"/>
            <div style="clear:both"></div>
            <div id="buyernotfound">الاسم غير موجود هل تريد اضافة اسم  جديد<input type="button" value="نعم" onclick="yesnewcustomer()"></div>
            <div style="clear:both"></div>
            <div id="buyerscontainer">
                    <div class="onebuyer">
                        <div>
                            <div style='float:right;width:55%; font-weight:900;'>الاسم</div>
                            <div style='float:right;width:15%; font-weight:900;'>النسبة</div>
                            <div style='float:right;width:15%; font-weight:900;'>الصفة</div>
                        </div>
                        <div style='clear:both;'></div>
                    </div>

            </div>
            
    </div>
    <div style="float:right;border:1px;width:37.5%; background-color: rgb(245,235,255);">
            <h3>وكيل او وسيط</h3>
        <?php
				$url = $this->createUrl("contractsMaster/autow");
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'name'=>'wakeels',
                    'source'=>$url,
                    // additional javascript options for the autocomplete plugin
                    'options'=>array(
                        'minLength'=>'4',
                    ),
                    'htmlOptions'=>array(
                        'style'=>'height:20px;'
                    ),
                ));
            ?>
            <input type="button" value="أضف" id="addrealstate"/>
            <div style="clear:both"></div>
            <div id="realstatenotfound">المكتب العقاري غير مسجل. يرجى التواصل مع قسم تنظيم المكاتب العقارية</div>
            <div style="clear:both"></div>
            <div id="realstatecontainer">
                    <div class="onerealstate">
                        <div> 
                            <div style='float:right; width:50%; font-weight:900;'>الاسم</div>
                            <div style='float:right; width:30%; font-weight:900;'>بائع &nbsp;&nbsp;&nbsp;مشتري</div>
                            <div style='float:right; width:10%; font-weight:900;'>صفة</div>
                        </div>
                        <div style='clear:both;'></div>
                    </div>

            </div>
    </div>

    <div style='clear:both;'></div>
    <div style="padding-top:30px;">
        <h3>المدفوعات </h3>
        <span>سعر العقار</span>
        <input type="text" value="0.00" id="contractamount"/>
        <span>السعر بعد التصحيح</span>
        <input type="text" value="0.00" id="correctedamount"/>
        <select id="feepercent">
                <option value="1">1%</option>
                <option value="2">2%</option>
                <option value="3">3%</option>
                <option value="4">4%</option>
                <option value="5">5%</option>
        </select>
        <span>الرسوم</span>
         <span id="sfeeamount"><input type="text" value=0.00 id="feeamount"></span><span>150 درهم ملكية,  100 درهم مخطط</span>
    </div>

     <div style='clear:both;'></div>
     <span>الملاحظات&nbsp;</span><input type="text" id="Remarks" />
     <div style="padding-top:30px;text-align:center;">
            <input type="button" value="حفظ و طباعة" id="createcontract"/>
    </div >

</div>

<style>
    #buyernotfound
    {
        color:red;
        display:none;
    }
    #realstatenotfound
    {
        color:red;
        display:none;
    }
    .removeitem
    {
        float:right;
        cursor:pointer;
        width:20px;
        background-image: url(/AjmanLandProperty/images/delete.png);
        background-repeat: no-repeat;
        background-position: center;
    }
    #form-message
     {
            display:none;
      }
</style>

<script type='text/javascript'>

	function yesnewcustomer()
	{
		window.open("/AjmanLandProperty/index.php/customerMaster/create");
		console.log("yes");
	}
	function yesnewrealestate()
	{
		window.open("/AjmanLandProperty/index.php/realEstateOffices/create");		
	}
	
	function all() //to default all owners checkboxes to checked all - this function is being called in the body at onload event... <body onload="all()">
	{
		$('.ownercheckbox').attr('checked','checked');
		$('#selectall').attr('checked', 'checked');
	}
	
	
	$("#selectall").click(function() {
		if($(this).is(":checked"))
		{
			$('.ownercheckbox').attr('checked','checked');

		}
		else
		{
			$('.ownercheckbox').removeAttr('checked');
		}
	});


    $("#createcontract").click(function() {
		
		var equals="no";
		var selected = 1;
		var total = 0;
		var deedId =  <?= $deedMaster->DeedID ?>; //YES - You can actually do that. echo a php to be asigned a value! crazy shit!
        var contractType = $("#contractype").val();
        var landType = $("#landtype").val();
        var contractamount = $("#contractamount").val();
        var feeamount = $("#feeamount").val();
        var correctedamount = $("#correctedamount").val();
        var Remarks = $("#Remarks").val()
        var owners = new Array();
        var buyers  = new Array();
        var realstate = new Array();
        var wakeel = new Array();
        $(".ownercheckbox").each(function() {
                if($(this).is(":checked"))
                {
                       owners.push($(this).attr("id"));
                }
                else
                {
                         var onebuyer = {
                                    buyerid:$(this).attr("id"),
                                    shareval:0,
                                    };
                        buyers.push(onebuyer);
                }
        });
        $(".onebuyer").each(function() {
                if($(this).attr("id"))
                {
                        var buyerid = $(this).attr("id");
                        buyerid = buyerid.replace("onebuyer", "");
                        var inputshare = "onebuyershare" + buyerid;
                        var sharevalue = $("#"+inputshare).val();
                        var onebuyer = {
                                    buyerid:buyerid,
                                    shareval:sharevalue,
                                    };
                        buyers.push(onebuyer);
                        sharevalue=sharevalue.replace('%','');
                        total += +(sharevalue.replace(/,/,'.'));
                        
                        
                }
        });   
        
        $(".onerealstate").each(function() {
                if($(this).attr("id"))
                {
                        var stateid = $(this).attr("id");
                        stateid = stateid.replace("onerealstate", "");
                        var chkbuyer = "buyerstate" + stateid;
                        var chkseller = "sellerstate" + stateid;
                        var chkbuyerval = $("#" + chkbuyer).is(":checked") ? "1" : "0";
                        var chksellerval = $("#" + chkseller).is(":checked") ? "1" : "0";
						if (chkbuyerval + chksellerval == 0)
						{
							selected = 0; 
							
						}
                        var onestate = {
                                stateid: stateid,
                                isbuyer: chkbuyerval,
                                isseller: chksellerval
                            };
                        realstate.push(onestate);
                }
        });
        
        $(".onewakeel").each(function() {
			
			if($(this).attr("id"))
			{
				var wakeelID = $(this).attr("id");
				wakeelID = wakeelID.replace("onewakeel","");
				var chkbuyer = "buyerstate" + wakeelID;
				var chkseller = "sellerstate" + wakeelID;
				var chkbuyerval = $("#" + chkbuyer).is(":checked") ? "1" : "0";
				var chksellerval = $("#" + chkseller).is(":checked") ? "1" : "0";
				var wakeeltype = "wakeeltype" + wakeelID;
				var type = $("#"+wakeeltype).val();
				var wakeelremarks = $("#wakeelremarks"+wakeelID).val();
				
				if (chkbuyerval + chksellerval == 0)
				{	
					selected =0; 
				}
				
				var onewakeel = {
					wakeelID: wakeelID,
					isbuyer: chkbuyerval,
					isseller: chksellerval,
					type: type,
					wakeelremarks: wakeelremarks,
										
					};
				
				wakeel.push(onewakeel);
				
				
			}
			
		});
	
	    if (total>100 || total<100 || selected==0)
        {
			if (total==111)
			{
				var equals = "yes";
				
			}
			else
			{
				alert('تأكد تحديد حصة أو حدد الجانبين في الوكيل أو الوسيط');
				return;
			}
			
		}
    	
        var params = {
                deedId: deedId,
                owners: owners,
                buyers:buyers,
                contractype:contractType,
                landtype:landType,
                realstate:realstate,
                wakeel:wakeel,
                contractamount:contractamount,
                correctedamount:correctedamount,
                feeamount:feeamount,
                Remarks:Remarks,
                equals:equals,
                };
        
        console.log(params.equals);
        var paramJSON = JSON.stringify(params);	
        $.post(
		            '<?php echo $this->createUrl("contractsMaster/createcontract")?>',
		            { data: paramJSON },
		            function(data)
		            {
                        var result = JSON.parse(data);
                        if(result.error==1)
                        {
                                allerrors = "";
                                var errors = result.message;
                                for(i in errors)
                                {
                                        allerrors += errors[i] + "<br/>";
                                }
                                $("#form-message").html(allerrors);
                                $("#form-message").css("display", "block");
                                $("#form-message").css("color", "red");
                        }
                        else
                        {
								var url = '<?php echo $this->createUrl("contractsMaster/Print/"); ?>';
								url+="/"+result.printout.ContractsID;
								
								var url1 = '<?php echo $this->createUrl("contractsMaster/printdeedcertificate/"); ?>';
								url1+="/"+result.newdeedid;
                        		
                        		var contractPrint = window.open(url);
                        		var deedCertificate = window.open(url1);
                        		location.href =   '<?php echo $this->createUrl("contractsMaster/admin")?>'
                        }             
		            }
	            );
    });
    
    $("#correctedamount").keyup(function() {
            computeFeeAmount();
    });

     $("#feepercent").change(function() {
            computeFeeAmount();
    });

    function computeFeeAmount()
    {
        var amount = $("#correctedamount").val();
        var percent = $("#feepercent").val();

        amount = parseFloat(amount);
        percent = parseFloat(percent);
        feeamount = amount * percent / 100;
        $("#feeamount").val(feeamount.toFixed(2));
    }


    $("#addbuyer").click(function() {
            var buyersname = $("#buyers").val();
            if(!buyersname) {return;}
            var paramJSON = JSON.stringify(buyersname);	
            $.post(
			            '<?php echo $this->createUrl("contractsMaster/searchbuyers")?>',
			            { data: paramJSON },
			            function(data)
			            {
                            if(data=="error")
                            {
                                    $("#buyernotfound").css("display", "block");
                            }
                            else
                            {
                                    $("#buyernotfound").css("display", "none");
                                     $("#buyers").val("");
                                    var customerResult = JSON.parse(data);
                                    insertBuyer(customerResult);
                                    initRemoveItem();
                            }				             
			            }
		            );

    });

     $("#addrealstate").click(function() {
            var wakeel = $("#wakeels").val();
            if(!wakeel) {return;}
            var paramJSON = JSON.stringify(wakeel);	
            $.post(
			            '<?php echo $this->createUrl("contractsMaster/searchrealstate")?>',
			            { data: paramJSON },
			            function(data)
			            {
                            if(data=="error")
                            {
                                    $("#realstatenotfound").css("display", "block");
                            }
                            else
                            {
                                    $("#realstatenotfound").css("display", "none");
                                    $("#wakeels").val("");
                                    var wakeelResult = JSON.parse(data);
                                    
                                    insertWakeel(wakeelResult);
                                    initRemoveItem();
                            }				             
			            }
		            );

    });

    function insertBuyer(customer)
    {
            var checker = "onebuyer" + customer.CustomerID;
            if($("#"+checker).html()) {return;}
			
			var contype = $('#contractype').val();
			console.log(contype);
			var custype = "";
			switch(contype)
			{
				case "0":
					custype = "مشتري";
					break;
				case "1":
					custype = "المورث";
					break;
				case "2":
					custype = "المتنازل له";
					break;
				case "3":
					custype = "موقوف له";
					break;
				case "4":
					custype = "موهوب له";
					break;
				default:
					custype = "مشتري";
			}
				
				
            var html = "";
            html += " <div class='onebuyer' id='onebuyer"+customer.CustomerID+"'> ";
            html += "       <div> ";
            html += "           <div style='float:right; width:55%;'><a target='_blank' href='/AjmanLandProperty/index.php/customerMaster/update/"+customer.CustomerID+"'>"+customer.CustomerNameArabic+"</a></div> ";
            html += "           <div style='float:right; width:15%;'><input type='text' size='2' id='onebuyershare"+customer.CustomerID+"'/></div> ";
            html += "			<div style='float:right; width:20%;'>"+custype+"</div>";
            html += "          <div style='float:right; width:10%;' class='removeitem' id='" + customer.CustomerID+ "'>&nbsp;</div>";
            html += "       </div> ";
            html += "       <div style='clear:both;'></div> ";
            html += " </div> ";
            $("#buyerscontainer").append(html);
    }

    function insertWakeel(result)
    {
            if (result.type=='wakeel')
            {
				console.log(result.type);
				var checker = "onewakeel" + result.wakeel['CustomerID'];
				if($("#"+checker).html()) { return; }
				
				var html = "";
				html += " <div class='onewakeel' id='onewakeel" + result.wakeel['CustomerID'] + "'> ";
				html += "	<div> ";
				html += "           <div style='float:right; width:50%;'><a target='_blank' href='/AjmanLandProperty/index.php/customerMaster/"+result.wakeel['CustomerID']+"'>"+result.wakeel['CustomerNameArabic']+"</a></div> ";
				html += "           <div style='float:right; width:10%;'><input type='checkbox'  id='sellerstate"+result.wakeel['CustomerID']+"'/></div> ";
				html += "           <div style='float:right; width:10%;'><input type='checkbox'  id='buyerstate"+result.wakeel['CustomerID']+"'/></div> ";
            	html += "			<div style='float:right; width:20%;'><select id='wakeeltype"+result.wakeel['CustomerID']+"'><option value='general wakeel'>وكيل عام</option><option value='special wakeel'>وكيل خاص</option><option value='wakeel of wakeel'>وكيل الوكيل</option><option value='inheritors wakeel'>وكيل ورثة</option><option value='owner of company'>مالك الرخصة</option><option value='inheritor'>وارث</option><option value='wali'>ولي</option></select></div>";
				html += "           <div style='float:right; width:10%;' class='removeitem' id='" + result.wakeel['CustomerID']+ "'>&nbsp;</div>";
				html += "			<div style='clear:both;'><input style='width:95%;' type='text' value='ادخل معلومات الوكالة' id='wakeelremarks"+result.wakeel['CustomerID']+"'/></div>";
				html += "       </div> ";
				html += "       <div style='clear:both;'></div> ";
				html += " </div> ";
				$("#realstatecontainer").append(html);
				
				
			}
			else
			{
				console.log(result.type);
				console.log(result.waseet['CardID']);
				console.log(result.waseet['RealEstateID']);
				var checker = "onerealstate" + result.waseet['CardID'];
				if($("#"+checker).html()) {return;}
            
				var html = "";
				html += " <div class='onerealstate' id='onerealstate"+result.waseet['CardID']+"'> ";
				html += "       <div> ";
				html += "           <div style='float:right;width:50%;'><a target='_blank' href='/AjmanLandProperty/index.php/RealEstatePeople/"+result.waseet['CardID']+"'>"+result.waseet['Name']+"</a></div> ";
				html += "           <div style='float:right; width:10%;'><input type='checkbox'  id='sellerstate"+result.waseet['CardID']+"'/></div> ";
				html += "           <div style='float:right; width:10%;'><input type='checkbox'  id='buyerstate"+result.waseet['CardID']+"'/></div> ";
				html += "			<div style='float:right; width:20%;'><select id='wakeeltype"+result.waseet['CardID']+"'><option value='waseet'>وسيط</option></select></div>";
				html += "          <div style='float:right; width:10%;' class='removeitem' id='" + result.waseet['CardID']+ "'>&nbsp;</div>";
				html += "       </div> ";
				html += "       <div style='clear:both;'></div> ";
				html += " </div> ";
				$("#realstatecontainer").append(html);
			}
			
            /*
            var checker = "onerealstate" + realstate.RealEstateID;
            if($("#"+checker).html()) {return;}
            
            var html = "";
            html += " <div class='onerealstate' id='onerealstate"+realstate.RealEstateID+"'> ";
            html += "       <div> ";
            html += "           <div style='float:right;width:70%;'>"+realstate.CommercialName+"</div> ";
            html += "           <div style='float:right; width:10%;'><input type='checkbox'  id='buyerstate"+realstate.RealEstateID+"'/></div> ";
            html += "           <div style='float:right; width:10%;'><input type='checkbox'  id='sellerstate"+realstate.RealEstateID+"'/></div> ";
            html += "          <div style='float:right; width:10%;' class='removeitem' id='" + realstate.RealEstateID+ "'>&nbsp;</div>";
            html += "       </div> ";
            html += "       <div style='clear:both;'></div> ";
            html += " </div> ";
            $("#realstatecontainer").append(html);*/
    }

    function initRemoveItem()
    {
            $(".removeitem").click(function() {
                    var container = $(this).parent().parent(); 
                    console.log($(container).attr("id"));
                    $(container).remove();
            });
 
            
    }

      
</script>






