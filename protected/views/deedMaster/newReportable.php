<h1>Create Custom Report for Contracts</h1>
<?php echo $this->renderPartial('_formReportable', array( 'model'=>$model, 'defaults'=>$defaults )); ?>

<script type="text/javascript">
$(function(){
	$('.datebox').datepicker();
});
</script>