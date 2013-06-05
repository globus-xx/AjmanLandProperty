<div id="placeholder-for-documentable-form">
</div>
<script type="text/javascript">
$(function(){
$.ajax({
    url:'<?php echo Yii::app()->request->baseUrl;?>/index.php/Documentable/View',
    data:{documentableType:'<?php echo $documentableType;?>', documentableId:<?php echo $documentableId;?>}
  }).done(function(response){
    $('#placeholder-for-documentable-form').html(response);
  });

})
</script>