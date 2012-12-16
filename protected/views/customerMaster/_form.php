<?php
/* @var $this CustomerMasterController */
/* @var $model CustomerMaster */
/* @var $form CActiveForm */

$countriesT = array();
$countries = array();
$lines = file('/var/www/AjmanLandProperty/protected/data/countries.csv', FILE_IGNORE_NEW_LINES);

foreach ($lines as $key => $value)
{
    $countriesT[] = str_getcsv($value);
    
}
foreach($countriesT as $key=>$value)
{
	$countries[] = $value[0];

}

?>

<div align="right" class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-master-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'CustomerNameArabic'); ?>
		<?php echo $form->textField($model,'CustomerNameArabic',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'CustomerNameArabic'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CustomerNameEnglish'); ?>
		<?php echo $form->textField($model,'CustomerNameEnglish',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'CustomerNameEnglish'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'HomeAddress'); ?>
		<?php echo $form->textField($model,'HomeAddress',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'HomeAddress'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'HomePhone'); ?>
		<?php echo $form->textField($model,'HomePhone',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'HomePhone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MobilePhone'); ?>
		<?php echo $form->textField($model,'MobilePhone',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'MobilePhone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DateofBirth'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model'=>$model,'attribute'=>'DateofBirth',
			'options'=>array(
				//'showAnim'=>'fold',
				'changeYear'=>'true',
				'changeMonth'=>'true',
				'yearRange'=>'-150:+0',
				),
			'htmlOptions'=>array(
				'style'=>'height:20px;',
				'dateFormat'=>'yy-mm-dd',
				),
			));
		?>
		<?php echo $form->error($model,'DateofBirth'); ?>
		
		<?php //echo $form->labelEx($model,'DateofBirth'); ?>
		<?php //echo $form->textField($model,'DateofBirth'); ?>
		<?php //echo $form->error($model,'DateofBirth'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Nationality'); ?>
		
		<?php
			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'name'=>'Nationality',
                    'model'=>$model,
                    'attribute'=>'Nationality',
                    'source'=>$countries, //came from the controller.. the array we constructed of all names, arabic and english
                    // additional javascript options for the autocomplete plugin
                    'options'=>array(
                        'minLength'=>'1',
                    ),
                    'htmlOptions'=>array(
                        'style'=>'height:20px;'
                    ),
                ));
		?>
		
		<?php //echo $form->DropDownList($model,'Nationality',$countries); ?>
		<?php echo $form->error($model,'Nationality'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Signature'); ?>
		<?php echo $form->textField($model,'Signature'); ?>
		<?php echo $form->error($model,'Signature'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DocumentType'); ?>
		<?php echo $form->DropDownList($model,'DocumentType',array('جواز'=>'جواز','الهوية الوطنية'=>'الهوية الوطنية', 'رخصة القيادة'=>'رخصة القيادة','رخصة تجارية'=>'رخصة تجارية')); ?>
		<?php echo $form->error($model,'DocumentType'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DocumentNumber'); ?>
		<?php echo $form->textField($model,'DocumentNumber',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'DocumentNumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IssuedOn'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model'=>$model,'attribute'=>'IssuedOn',
			'options'=>array(
				//'showAnim'=>'fold',
				'changeYear'=>'true',
				'changeMonth'=>'true',
				'yearRange'=>'-150:+30',
							
				),
			'htmlOptions'=>array(
				'style'=>'height:20px;',
				'dateFormat'=>'yy-mm-dd',
				),
			));
		?>
		
		<?php //echo $form->textField($model,'IssuedOn'); ?>
		<?php echo $form->error($model,'IssuedOn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ExpiresOn'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model'=>$model,'attribute'=>'ExpiresOn',
			'options'=>array(
				//'showAnim'=>'fold',
				'changeYear'=>'true',
				'changeMonth'=>'true',
				'yearRange'=>'-150:+30',
							
				),
			'htmlOptions'=>array(
				'style'=>'height:20px;',
				'dateFormat'=>'yy-mm-dd',
				),
			));
		?>
		<?php //echo $form->textField($model,'ExpiresOn'); ?>
		<?php echo $form->error($model,'ExpiresOn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EmailAddress'); ?>
		<?php echo $form->textField($model,'EmailAddress',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'EmailAddress'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Document'); ?>
		<?php echo $form->textField($model,'Document'); ?>
		<?php echo $form->error($model,'Document'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Photo'); ?>
		<?php echo $form->textField($model,'Photo'); ?>
		<?php echo $form->error($model,'Photo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CustomerType'); ?>
		<?php echo $form->DropDownList($model,'CustomerType',array('Regular'=>'عام','Investor'=>'مستثمر')); ?>
		<?php echo $form->error($model,'CustomerType'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'اضف' : 'حفض'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
