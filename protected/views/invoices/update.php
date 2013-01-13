<?php
/* @var $this InvoicesController */
/* @var $model Invoices */

$this->breadcrumbs=array(
	'Invoices'=>array('index'),
	$model->InvoiceNo=>array('view','id'=>$model->InvoiceNo),
	'Update',
);

$this->menu=array(
	array('label'=>'List Invoices', 'url'=>array('index')),
	array('label'=>'Create Invoices', 'url'=>array('create')),
	array('label'=>'View Invoices', 'url'=>array('view', 'id'=>$model->InvoiceNo)),
	array('label'=>'Manage Invoices', 'url'=>array('admin')),
);
?>

<h1>Update Invoices <?php echo $model->InvoiceNo; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>