<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reportable-reportable-form',
	'enableAjaxValidation'=>false,
)); ?>
	<h1>Create Custom Report for Contracts</h1>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title'); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'reportable_type'); ?>
	</div>

	<h2>Include Fields in Report</h2>
	<p>Check all the fields that you want to include in this report</p>
	<?php 	$models = array('ContractsMaster','LandMaster','ContractsDetail','CustomerMaster');?>
	<?php foreach($models as $vv):?>
		<b><?php echo $vv;?> fields</b>
		<?php $attribs = $vv::attributeLabels();?>
		<div class="row">
			<?php foreach($attribs as $ii=>$vx):?>
				<?php echo CHtml::checkBox("Reportable[display][".$vv."][".$ii."]", true);?> 
				<?php echo $vx;?>
			<?php endforeach;?>
		</div>

	<?php endforeach;?>


	<h2>What conditions should be the report based upon</h2>
	<p>Check and set all the conditions for all the fields you want to include when generating this report</p>

	<?php 
	$models = array('ContractsMaster','LandMaster','ContractsDetail','CustomerMaster');
	foreach($models as $vv):
		// get the columns for the current models table
		$c = new $vv();
		$columns = $c->getTableSchema()->columns;
		// loop through all the attributes for the ContractsMaster
		?>
		<b><?php echo $vv;?> Model Fields</b>
		<?php $attribs = $vv::attributeLabels();?>
		<?php echo $this->renderPartial('_reportableFields', array('attribs'=>$attribs, 'defaults'=>$defaults, 'model'=>$vv, 'columns'=>$columns)); 
	endforeach;
	?>	
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
$(function(){
	$('.datebox').datepicker();
});
</script>