<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="ar" dir="rtl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
            
	<link type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui-1.8.16.custom.css" rel="stylesheet" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
  <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.8.1.min.js"></script> 
  <script type ="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.3.custom.min.js"></script>

</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"></div>
	</div><!-- header -->

	<div id="mainMbMenu">
		<?php $this->widget('application.extensions.mbmenu.MbMenu',array(
			'items'=>array(
				//array('label'=>'Home', 'url'=>array('/site/index')),
                array('label'=>'العقود','url'=>array('/ContractsMaster'),
                'items'=>array(
					array('label'=>'ادارة العقود','url'=>array('/ContractsMaster/admin')),
					
					array('label'=>'عقد جديد','url'=>array('/ContractsMaster/index'),
						'items'=>array(
							array('label'=>'بيــع','url'=>array('/ContractsMaster/landsearch/id/0')),
							array('label'=>'وراثة','url'=>array('/ContractsMaster/landsearch/id/1')),
							array('label'=>'تنازل','url'=>array('/ContractsMaster/landsearch/id/2')),
							array('label'=>'وقف','url'=>array('/ContractsMaster/landsearch/id/3')),
							array('label'=>'هبة','url'=>array('/ContractsMaster/landsearch/id/4')),
							
						)),
					array('label'=>'طباعة عقد','url'=>array('/ContractsMaster/printfrom')),
					array('label'=>'تفصيل العقد','url'=>array('/ContractsDetail/admin')),
					array('label'=>'التقارير الخاصة','url'=>array('/ContractsMaster/Reportables')),
					array('label'=>'تقرير خاص جديد','url'=>array('/ContractsMaster/newReportable')),
                )),			
            
                array('label'=>'حجز/ رهن','url'=>array('/HajzMaster'),
					'items'=>array(
						array('label'=>'الحجز1','url'=>array('/HajzMaster/1')),
						array('label'=>'الحجز2','url'=>array('/HajzMaster/2')),
												
                )),	
            
                array('label'=>'الملكيات','url'=>array('/DeedMaster'),
					'items'=>array(
						array('label'=>'ملكية جديدة','url'=>array('/DeedMaster/create')),
						array('label'=>'طباعة ملكية','url'=>array('/DeedMaster/printfrom')),
						array('label'=>'تاريخ الطباعات','url'=>array('/DeedTracker/admin')),
						array('label'=>'تفصيل الملكية','url'=>array('/DeedDetails/admin')),
						array('label'=>'التقارير الخاصة','url'=>array('/DeedMaster/Reportables')),
						array('label'=>'تقرير خاص جديد','url'=>array('/DeedMaster/newReportable')),
                )),
            
                array('label'=>'مكاتب عقارية','url'=>array('/RealEstateOffices'),
					'items'=>array(
						array('label'=>'وسيط','url'=>array('/RealEstatePeople'),
							'items'=>array(
								array('label'=>'وسيط جديد','url'=>array('/RealEstatePeople/create')),
								array('label'=>'ادارة الوسطاء', 'url'=>array('/RealEstatePeople/admin')),
						)),
						array('label'=>'مكاتب','url'=>array('/RealEstateOffices'),
							'items'=>array(
								array('label'=>'مكتب جديد','url'=>array('/RealEstateOffices/create')),
								array('label'=>'ادارة المكاتب', 'url'=>array('/RealEstateOffices/admin')),
						)),
					)),
            
                array('label'=>'العملاء','url'=>array('/CustomerMaster'),
					'items'=>array(
								array('label'=>'زبون جديد','url'=>array('/CustomerMaster/create')),
								array('label'=>'ادارة الزبائن', 'url'=>array('/CustomerMaster/admin')),
                )),
            
                array('label'=>'أراضي','url'=>array('/LandMaster/update'),
					'items'=>array(
								array('label'=>'طباعة مخطط','url'=>array('/ContractsMaster/mukhattat')),
		)),
                
                array('label'=>'خدمة العملاء','url'=>array('/CustomerService'),                    
                     'items'=>array(
								array('label'=>'ادارة الرسائل','url'=>array('/Letters/temp/')),
                                                                array('label'=>'ادارة وجهات الرسائل','url'=>array('/destination/')),
                                                                array('label'=>'ادارة الرسائل الصادرة','url'=>array('/exportedletters/')),
								
                )),
              array('label'=>'نظام ادارة الملفات', 'url'=>array('/dms/'), 'items'=>array(
                 // array('label'=>'الوثائق', 'url'=>array('/document/')),                 
                  array('label'=>'انواع الوثائق', 'url'=>array('/documentTypes/')),
                  array('label'=>'اعدادات', 'url'=>array('/filesetting/update/1/')),
              )),

            
            	array('label'=>'دخول', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                
                array('label'=>'البيانات الشخصية ('.Yii::app()->user->name.')', 'url'=>array('/site/profile/'.Yii::app()->user->ID), 'visible'=>!Yii::app()->user->isGuest),                            
			
		array('label'=>'خروج '.'('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
              
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
        <?php echo Yii::app()->user->name."  ".date('D, d-M-Y'); ?><br>
		<h4>دائرة الاراضي و الاملاك, عجمان</h4>
		

	</div><!-- footer -->

</div><!-- page -->
<script language="text/javascript">
  $(function(){
    $(document).on('click', '.datebox', function(){
      console.log(this);
      $(this).datepicker().datepicker( "show" );;
    })
  });
</script>
</body>
</html>
