<h1>نظام ادارة الملفات</h1>
 
<a id="fancybox-manual-b" href="javascript:;"></a>




<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/css/jquery.fancybox.css?v=2.1.4" media="screen" />
             
  <script type="text/javascript">      
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */                       
			                                   
                        $("#fancybox-manual-b").click(function() {  
				$.fancybox.open({                                    
                                        closeBtn : false,
                                        closeClick  : false, // prevents closing when clicking INSIDE fancybox
                                        helpers     : { 
                                            overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox
                                        },
                                        keys : {
                                            close  : null
                                        },
					href : '<?php echo Yii::app()->request->baseUrl;?>/index.php/Dms/process',
					type : 'iframe',
					padding : 5
				});
			});
                        
                        $("#fancybox-manual-b").trigger('click');                        
                });
  </script>




