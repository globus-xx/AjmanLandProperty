<?php
/* @var $this ContractsMasterController */
/* @var $model ContractsMaster */
?>

<h1>العقد</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Title',
		'LetterText',
       
            array(               // related city displayed as a link
            'label'=>'Convert',
            'type'=>'raw',
            'value'=>CHtml::link(CHtml::encode("convert to .docx file"),
                                 array('convert','id'=>$model->LetterID)),
        ),
		
            
            array(               // related city displayed as a link
            'label'=>'Open in html',
            'type'=>'raw',
            'value'=>CHtml::link(CHtml::encode("Open in Html File"),
                                 array('open','id'=>$model->LetterID)),
        ),
            
	),
   
    
));


?>
