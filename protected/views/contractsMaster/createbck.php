<body onload="all()" dir="rtl">
<?php
/* @var $this ContractsMasterController */
/* @var $model ContractsMaster */

$this->breadcrumbs=array(
	'Contracts Masters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'قائمة العقود السابقة', 'url'=>array('index')),
	array('label'=>'إدارة العقود', 'url'=>array('admin')),
);
?>

<h1>عقد جديد</h1>

<div id="form-message"></div>
<div>
    <div style="padding-bottom:25px; font-size:1.3em;">

        <span>حدد نوع العقد</span>
        <select id="contractype" style='font-size:1.2em; width:100px;'>
                <option value="0">&nbsp;&nbsp;بيع</option>
                <option value="1">&nbsp;&nbsp;وراثة</option>
                <option value="2">&nbsp;&nbsp;تنازل</option>
                <option value="3">&nbsp;&nbsp;وقف</option>
                <option value="4">&nbsp;&nbsp;هبة</option>
        </select>
    </div>
 <div style='clear:both;'></div> 
    <div style="float:right;border:1px;width:25%;padding:0px; background-color: rgb(245,235,255);">
            <h3>الملاك</h3>
            <div style='height:27px;'></div>
            <div >
                    <div style='float:right'>&nbsp;</div>
                    <div style='float:right; width:80%'><input type="checkbox" id="selectall">الاسم</div>
                    <div style='float:right;'>النسبة</div>
         
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
                                            <div style='float:right;width:70%;'>" .$customerName. " </div>
                                            <div style='float:right;width:10%;'>".$customerShare. " </div>
                                 
                                    </div>";
                            echo "<div style='clear:both;'></div>";
                    }
            ?>
    </div>
    <div style="float:right;border:1px;width:37.5%; background-color: rgb(225,240,245);">
            <h3>المشترين</h3>

            <?php

                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'name'=>'buyers',
                    'source'=>$customerNames, //came from the controller.. the array we constructed of all names, arabic and english
                    // additional javascript options for the autocomplete plugin
                    'options'=>array(
                        'minLength'=>'1',
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
                            <div style='float:right;width:55%;'>الاسم</div>
                            <div style='float:right;width:15%;'>النسبة</div>
                            <div style='float:right;width:15%;'>الصفة</div>
                        </div>
                        <div style='clear:both;'></div>
                    </div>

            </div>
            
    </div>
    <div style="float:right;border:1px;width:37.5%; background-color: rgb(245,235,255);">
            <h3>المكاتب العقارية</h3>
        <?php

                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'name'=>'realstate',
                    'source'=>$realstateNames,
                    // additional javascript options for the autocomplete plugin
                    'options'=>array(
                        'minLength'=>'1',
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
                            <div style='float:right; width:70%;'>الاسم</div>
                            <div style='float:right; width:20%;'>بائع &nbsp;&nbsp;&nbsp;مشتري</div>
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
         <span id="sfeeamount"><input type="text" value=0.00 id="feeamount"></span>
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
		
		var total = 0;
		var deedId =  <?= $deedMaster->DeedID ?>; //YES - You can actually do that. echo a php to be asigned a value! crazy shit!
        var contractType = $("#contractype").val();
        var contractamount = $("#contractamount").val();
        var feeamount = $("#feeamount").val();
        var correctedamount = $("#correctedamount").val();
        var Remarks = $("#Remarks").val()
        var owners = new Array();
        var buyers  = new Array();
        var realstate = new Array();
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
        
        if (total>100 || total<100)
        {
			alert('The share total should be exactly 100!, Please ensure valid percentages');
			return;
		}
        $(".onerealstate").each(function() {
                if($(this).attr("id"))
                {
                        var stateid = $(this).attr("id");
                        stateid = stateid.replace("onerealstate", "");
                        var chkbuyer = "buyerstate" + stateid;
                        var chkseller = "sellerstate" + stateid;
                        var chkbuyerval = $("#" + chkbuyer).is(":checked") ? "1" : "0";
                        var chksellerval = $("#" + chkseller).is(":checked") ? "1" : "0";

                        var onestate = {
                                stateid: stateid,
                                isbuyer: chkbuyerval,
                                isseller: chksellerval
                            };
                        realstate.push(onestate);
                }
        });
        
        var params = {
                deedId: deedId,
                owners: owners,
                buyers:buyers,
                contractype:contractType,
                realstate:realstate,
                contractamount:contractamount,
                correctedamount:correctedamount,
                feeamount:feeamount,
                Remarks:Remarks,
                };
        
        
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
								
                        		var contractPrint = window.open(url);
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
            var realstatename = $("#realstate").val();
            if(!realstate) {return;}
            var paramJSON = JSON.stringify(realstatename);	
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
                                    $("#realstate").val("");
                                    var realstateResult = JSON.parse(data);
                                    insertRealstate(realstateResult);
                                    initRemoveItem();
                            }				             
			            }
		            );

    });

    function insertBuyer(customer)
    {
            var checker = "onebuyer" + customer.CustomerID;
            if($("#"+checker).html()) {return;}

            var html = "";
            html += " <div class='onebuyer' id='onebuyer"+customer.CustomerID+"'> ";
            html += "       <div> ";
            html += "           <div style='float:right; width:55%;'><a href='/AjmanLandProperty/index.php/customerMaster/"+customer.CustomerID+"'>"+customer.CustomerNameArabic+"</a></div> ";
            html += "           <div style='float:right; width:15%;'><input type='text' size='2' id='onebuyershare"+customer.CustomerID+"'/></div> ";
            html += "			<div style='float:right; width:20%;'><select id='buyertype'><option>المشتري</option><option>وكيل عام</option><option>وكيل خاص</option><option>وكيل الوكيل</option><option>وكيل ورثة</option></select></div>";
            html += "          <div style='float:right; width:10%;' class='removeitem' id='" + customer.CustomerID+ "'>&nbsp;</div>";
            html += "       </div> ";
            html += "       <div style='clear:both;'></div> ";
            html += " </div> ";
            $("#buyerscontainer").append(html);
    }

    function insertRealstate(realstate)
    {
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
            $("#realstatecontainer").append(html);
    }

    function initRemoveItem()
    {
            $(".removeitem").click(function() {
                    var container = $(this).parent().parent(); 
                    //console.log($(container).attr("id"));
                    $(container).remove();
            });
 
            
    }

      
</script>






