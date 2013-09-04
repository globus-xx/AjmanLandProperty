<h1> اضافة تقرير خاص للعقود</h1>
<?php echo $this->renderPartial('_formReportable', array( 'model'=>$model, 'defaults'=>$defaults )); ?>

<script type="text/javascript">
$(function(){
	$('.datebox').datepicker();
});
</script>