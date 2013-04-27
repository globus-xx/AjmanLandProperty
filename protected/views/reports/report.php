<link rel="stylesheet" href="<?=Yii::app()->getBaseUrl()?>/js/jquery-ui.css" />
<script src="<?=Yii::app()->getBaseUrl()?>/js/jquery-ui.js"></script>

<style>
  h1 { padding: .2em; margin: 0; }
  #products { float:left; width: 500px; margin-right: 2em; }
  
  #cart { width: 200px; float: left; margin-top: 1em; }
  /* style the list to maximize the droppable hitarea */
  #cart ol { margin: 0; padding: 1em 0 1em 3em; }
  
   #cart2 { width: 200px; float: left; margin-top: 1em; }
  /* style the list to maximize the droppable hitarea */
  #cart2 ol { margin: 0; padding: 1em 0 1em 3em; }
  
   #cart3 { width: 200px; float: left; margin-top: 1em; }
  /* style the list to maximize the droppable hitarea */
  #cart3 ol { margin: 0; padding: 1em 0 1em 3em; }
  
  
  #cart_con{position: fixed;bottom:79px;right:413px;}
</style>

<script>
    var columns = [];
    var rows = [];
    var tables = [];
    var data = [];
    
    
  $(function() {
    $( "#catalog" ).accordion();
    $( "#catalog li" ).draggable({
      appendTo: "body",
      helper: "clone"
    });
    $( "#cart ol" ).droppable({
      activeClass: "ui-state-default",
      hoverClass: "ui-state-hover",
      accept: ":not(.ui-sortable-helper)",
      drop: function( event, ui ) {
        $( this ).find( ".placeholder" ).remove();    
                
          var str=ui.draggable.text();
          var n=str.split("_");                   
          
        $( "<li></li>" ).text(n[0]).appendTo( this );   
        
        
            var rowres=n[1]+"."+n[0];  
            if(!in_array(columns,rowres))
            columns.push(rowres);
            
            if(!in_array(tables,n[1]))
            tables.push(n[1]);
              
            drawtable();                                                             
      }
    }).sortable({
      items: "li:not(.placeholder)",
      sort: function() {
        // gets added unintentionally by droppable interacting with sortable
        // using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
        $( this ).removeClass( "ui-state-default" );
      }
    });
    
    
    
    $( "#cart2 ol" ).droppable({
      activeClass: "ui-state-default",
      hoverClass: "ui-state-hover",
      accept: ":not(.ui-sortable-helper)",
      drop: function( event, ui ) {
        $( this ).find( ".placeholder" ).remove();    
        
         var str=ui.draggable.text();
          var n=str.split("_");                   
        $( "<li></li>" ).text(n[0]).appendTo( this );   
        
            var rowres=n[1]+"."+n[0];      
              
            if(!in_array(rows, rowres))
            rows.push(rowres);
            
            if(!in_array(tables, n[1]))
            tables.push(n[1]);
            
        
            drawtable();
             
                                                     
      }
    }).sortable({
      items: "li:not(.placeholder)",
      sort: function() {
        // gets added unintentionally by droppable interacting with sortable
        // using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
        $( this ).removeClass( "ui-state-default" );
      }
    });
    
    
    
    
    $( "#cart3 ol" ).droppable({
      activeClass: "ui-state-default",
      hoverClass: "ui-state-hover",
      accept: ":not(.ui-sortable-helper)",
      drop: function( event, ui ) {
        $( this ).find( ".placeholder" ).remove();    
        
          var str=ui.draggable.text();
          var n=str.split("_");                   
        $( "<li></li>" ).text(n[0]).appendTo( this );   
                
                
            var rowres=n[1]+"."+n[0];      
              
            if(!in_array(data, rowres))
            data.push(rowres);
            
            if(!in_array(tables, n[1]))
            tables.push(n[1]);                                    
        
            drawtable();
                                                     
      }
    }).sortable({
      items: "li:not(.placeholder)",
      sort: function() {
        // gets added unintentionally by droppable interacting with sortable
        // using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
        $( this ).removeClass( "ui-state-default" );
      }
    });
    
    
    
    
    function drawtable()
  {
      
       $.ajax({ 
                                type: "POST",
				url:'Reports/Calulate', 
				data: "rows="+rows+"&tables="+tables+"&columns="+columns+"&data="+data,
                                async:false,
				success: function(data) { 
                                    
                                
					var Results = JSON.parse(data); 	
					console.log(Results);     
                                       
                                        $("#report_generation").html(Results);	
				}
                        });
          
  }
  
  
  
  function in_array(array, id) {
    for(var i=0;i<array.length;i++) {
        if(array[i] === id) {
            return true;
        }
    }
    return false;
}


  
  
  });
  
  


  

  </script>
  
  
  


<!--
<?php
/* @var $this ReportsController */
?>

<h1>اختر الجدول من فضلك</h1>
<ul>
<?
foreach($tables as $row)
{
//    echo $row->Tables_in_."$db"."<br>";
if(($row["Tables_in_".$db]=="customermaster")||($row["Tables_in_".$db]=="customermaster")||($row["Tables_in_".$db]=="landdetails")||($row["Tables_in_".$db]=="landfines")||($row["Tables_in_".$db]=="landmaster"))
{
    ?>
<li>
    
<?php echo CHtml::link($row["Tables_in_".$db],array('reports/OpenTable','table'=>$row["Tables_in_".$db])); ?>    
    
    </li>
    <a href="<?=Yii::app()->getBaseUrl()?>/index.php/reports/OpenTable/<?=$row["Tables_in_".$db]?>"><?=$row["Tables_in_".$db]?></a>
<?
}    
}
?>

</ul>-->






<div>
    </div>

<table style="direction:ltr;background: #eeeeee;" id="report_generation"  border="1">

</table>





<div id="products" style="direction: ltr;">
  <h1 class="ui-widget-header">Tables</h1>
  <div id="catalog">
      
<?

$connection=Yii::app()->db; 
           
foreach($tables as $row)
{   
?>
    <h2><a href="#"><?=$row["Tables_in_".$db]?></a></h2>
    <div>
      <ul>
<?
 $sql='SHOW COLUMNS FROM '.$row["Tables_in_".$db];                        
 $fields=$connection->createCommand($sql)->queryAll();
 foreach($fields as $row2)
{
?>
        <li><?=$row2["Field"]?>_<?=$row["Tables_in_".$db]?></li>        
<?
}
?>
        
      </ul>
    </div>
    
<?
}
?>
    
    
  </div>
</div>
 

<div id="cart_con">

<div id="cart" style="direction: ltr;">
  <h1 class="ui-widget-header">Columns</h1>
  <div class="ui-widget-content">
    <ol>
      <li class="placeholder">Add your items here</li>
    </ol>
  </div>
</div>

<div style="clear: both"></div>

<div id="cart2" style="direction: ltr;">
  <h1 class="ui-widget-header">Rows</h1>
  <div class="ui-widget-content">
    <ol>
      <li class="placeholder">Add your items here</li>
    </ol>
  </div>
</div>

<div style="clear: both"></div>

<div id="cart3" style="direction: ltr;">
  <h1 class="ui-widget-header">Data</h1>
  <div class="ui-widget-content">
    <ol>
      <li class="placeholder">Add your items here</li>
    </ol>
  </div>
</div>

</div>


