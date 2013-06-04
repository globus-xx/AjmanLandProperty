<?php
/* @var $this CustomerMasterController */
/* @var $model CustomerMaster */



$this->menu=array(
	array('label'=>'قائمة المتعاملين', 'url'=>array('index')),
	array('label'=>'اضافة متعامل جديد', 'url'=>array('create')),
	array('label'=>'تحديث بيانات المتعامل', 'url'=>array('update', 'id'=>$model->CustomerID)),
	array('label'=>'حذف المتعامل ', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CustomerID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'إدارة المتعاملين', 'url'=>array('admin')),
);
?>

<h1>عرض بيانات المتعامل #<?php echo $model->CustomerID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CustomerID',
		'CustomerNameArabic',
		'CustomerNameEnglish',
		'HomeAddress',
		'HomePhone',
		'MobilePhone',
		'DateofBirth',
		'Nationality',
		'Signature',
		'DocumentType',
		'DocumentNumber',
		'IssuedOn',
		'ExpiresOn',
		'EmailAddress',
		'Document',
		'Photo',
		'CustomerType',
	),
)); ?>

<div id="placeholder-for-documentable-form">
	</div>
	<script type="text/javascript">
$(function(){
	$.ajax({
        url:'<?php echo Yii::app()->request->baseUrl;?>/index.php/Documentable/View',
        data:{documentableType:'customer', documentableId:<?php echo $model->CustomerID;?>}
      }).done(function(response){
        $('#placeholder-for-documentable-form').html(response);
      });

})
</script>
