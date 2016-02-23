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
	?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
	</div><!-- header -->

	<div id="mainmenu">
	</div><!-- mainmenu -->

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Stefan Stretz - University Bamberg.<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>

</html>
