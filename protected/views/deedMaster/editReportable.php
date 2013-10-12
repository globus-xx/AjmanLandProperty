<h1>تعديل التقرير الخاص بالملكيات</h1>


<?php echo $this->renderPartial('_formReportable', array( 'model'=>$model, 'defaults'=>$defaults, 'edit' => 'yes')); ?>

<script type="text/javascript">
$(function(){
	$('.datebox').daterangepicker();
});
</script>