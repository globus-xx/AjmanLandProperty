<?php
$this->breadcrumbs=array(
	'Filesettings'=>array('index'),
	'Create',
);

?>

<h1>انشاء اعداد</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>