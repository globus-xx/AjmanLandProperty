<?php 
foreach($documentType->documentTypeMetas as $ii=>$one_meta){
?>
<div class="row">
  <?php 
    echo CHtml::label($one_meta['meta_option'], 'Document[documentMetas][][meta_value]');
    $time = time()+$ii;
    switch($one_meta['meta_type']):
      case 'string':
      case 'integer':
        echo CHtml::textfield('Document[documentMetas]['.$time.'][meta_value]');
      break;
      case 'text':
        echo CHtml::textArea('Document[documentMetas]['.$time.'][meta_value]');
      break;
      case 'date':
        echo CHtml::textfield('Document[documentMetas]['.$time.'][meta_value]', '', array('class'=>'datebox'));
      break;
    endswitch;
    echo CHtml::hiddenfield('Document[documentMetas]['.$time.'][documentTypeMetaId]', $one_meta['id']);
  ?>
</div>
<?php
}
?>