<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	
	<?php 	
		//yiistrap stuff
		Yii::app()->bootstrap->register(); 

		$baseUrl = Yii::app()->baseUrl; 
		$cs = Yii::app()->getClientScript();
		$cs->registerCssFile($baseUrl.'/css/font-awesome.min.css');
		$cs->registerScriptFile($baseUrl.'/js/cleanupOldNots.js');
			
	?>
	<!-- blueprint CSS framework -->
	<?php /*
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
	*/
	?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<?php 
		/*<div id="logo"><?php echo CHtml::encode(Yii::app()->name); 
		?>
		</div> 
		*/
		?>
	</div><!-- header -->

	<div id="mainmenu">

		
		<?php 
/*		
		$this->widget('bootstrap.widgets.TbNavbar', array(
		'color' => TbHtml::NAVBAR_COLOR_INVERSE,
        //'brandLabel' => 'Title',
        'display' => null, // default is static to top
        'items' => array(
            array(
                'class' => 'bootstrap.widgets.TbNav',
                'items' => array(
					array('label'=>'Home', 'url'=>array('/site/index')),
					array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
					array('label'=>'Contact', 'url'=>array('/site/contact')),
					array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
					array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                ),
            ),
        ),
    )); 
	*/
	?>
	</div><!-- mainmenu -->
	<?php /*
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
	*/ ?>
	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Stefan Stretz - University Bamberg.<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>

</html>
