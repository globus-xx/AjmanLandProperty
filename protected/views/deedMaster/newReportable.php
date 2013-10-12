<h1>اضافة تقرير خاص بالملكيات</h1>

<?php echo $this->renderPartial('_formReportable', array( 'model'=>$model, 'defaults'=>$defaults )); ?>

<script type="text/javascript">
$(function(){
	$('.datebox').daterangepicker();
});
</script>