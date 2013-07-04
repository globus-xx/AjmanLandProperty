<div class="row">
    <div class="span50">
        <?php echo $form->labelEx($model,'meta_option'); ?>
        <?php echo $form->textField($model,'meta_option'); ?>
        <?php echo $form->error($model,'meta_option'); ?>
        <?php if($model->id!=null):?>
        <?php echo $form->hiddenField($model,'id'); ?>
        <?php endif;?>
    </div>
    <div class="span50">
        <?php echo $form->labelEx($model,'meta_type'); ?>
        <?php echo $form->dropDownList($model,'meta_type', array('string'=>'String','integer'=>'Integer','text'=>'Text','date'=>'Date')); ?>
        <?php echo $form->error($model,'meta_type'); ?>
    </div>
</div>
<hr/>