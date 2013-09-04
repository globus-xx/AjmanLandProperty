<?php 
if(!$documentType):
    return;
    endif;
    foreach($documentType->documentTypeMetas as $ii=>$one_meta){
?>
<div class="row">
  <?php 
      
    $value = '';
    
    
    if(isset($_model_document_metas)){
      foreach($_model_document_metas as $ii=>$vv):
        
        if($one_meta->id==$vv['documentTypeMetaId']){
          $value = $vv['meta_value'];
        }
      endforeach;
    }

    echo CHtml::label($one_meta['meta_option'], 'Document[documentMetas][][meta_value]');
    $time = time()+$ii;
    switch($one_meta['meta_type']):
      case 'string':
      case 'integer':
        echo CHtml::textfield('Document[documentMetas]['.$time.'][meta_value]', $value);
      break;
      case 'text':
        echo CHtml::textArea('Document[documentMetas]['.$time.'][meta_value]', $value);
      break;
      case 'date':
        echo CHtml::textfield('Document[documentMetas]['.$time.'][meta_value]', $value, array('class'=>'datebox'));
      break;
    endswitch;
    echo CHtml::hiddenfield('Document[documentMetas]['.$time.'][documentTypeMetaId]', $one_meta['id']);
  ?>
</div>
<?php
}
?>