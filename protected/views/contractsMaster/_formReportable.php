<meta charset="UTF-8">
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'reportable-reportable-form',
        'enableAjaxValidation' => false,
    ));
    ?>



    <p class="note">الحقول المميزة بالعلامة  <span class="required">*</span> مطلوبة .     </p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title'); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->hiddenField($model, 'reportable_type'); ?>
    </div>

    <?php $data = $model->attributes; 
    ?>
    <?php 
        if(is_null($data['display'])){
            $display = null;
        }else{
            $display = Reportable::model()->objectToArray(json_decode($data['display'])); 
        }
    ?>


    <h2>  ما هي الحالات التي يجب ان يكون فيها التقرير معتمدا عليها</h2>
    <p>  تأكد و عدل كل حالات الحقول التي تريد تضمينها عند توليد التقرير</p>


    <?php
    $models = array('ContractsMaster', 'LandMaster', 'ContractsDetail', 'CustomerMaster');
    $condition = Reportable::model()->objectToArray(json_decode($data['conditions']));
    $models = array('ContractMaster' => 'ContractsMaster',
        'Buyer' => 'CustomerMaster',
        'Seller' => 'RealEstatePeople',
        'LandMaster' => 'LandMaster',
        'Buyer' => 'CustomerMaster',
        'Real Estate' => 'RealEstateOffices');

    foreach ($models as $model_name):
        // get the columns for the current models table
        $c = new $model_name();
        $columns = $c->getTableSchema()->columns;
        // loop through all the attributes for the ContractsMaster
        ?>
        <b> <?php echo $model_name; ?> حقول</b>

        <?php $attribs = $model_name::model()->attributeLabels(); ?>
        <?php $attribs = $model_name::model()->reportableFields(); ?>
        <?php
        if (!isset($edit)) {
            echo $this->renderPartial('_reportableFields', array('attribs' => $attribs, 'condition' => $condition,
                'defaults' => $defaults, 'display'=>$display, 'model' => $condition, 'the_model' => $model_name, 'columns' => $columns));
        }else{
            echo $this->renderPartial('_reportableFields', array('attribs' => $attribs, 'condition' => $condition,
                'defaults' => $defaults, 'display'=>$display, 'model' => $condition, 'the_model' => $model_name, 'columns' => $columns, 'edit' => "yes"));
        }
    endforeach;
    ?>	

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->


<script>
    $('#reportable-reportable-form').submit(function() {


        if ($("#Reportable_title").val() == "")
        {
            alert("من فضلك ادخل اسم التقرير !!!");
            return false;
        }

    });
</script>