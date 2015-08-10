<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<!--HEader -->
<div class=row>
	<h1>Login</h1>
</div>

<!-- Main -->
<div class="form">
<div class=jumbotron>
	<?php $form=$this->beginWidget('TbActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>
		<div class="row">
			<div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
				<?php echo $form->labelEx($model,'username'); ?>
				<?php echo $form->textField($model,'username'); ?>
				<?php echo $form->error($model,'username'); ?>
			</div>
		</div>
		
		<br/>
		
		<!-- Main Content -->
		<div class="row buttons">
			<div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
				<?php echo TbHtml::submitButton('Yes, that\'s me!', array('color'=> TbHtml::BUTTON_COLOR_PRIMARY, 'size' => TbHtml::BUTTON_SIZE_DEFAULT, 'block'=>true)); ?>
			</div>
		</div>
		
		<!-- Header / Notifications -->
		<div class="row footer">
		</div>
</div>
<?php $this->endWidget(); ?>
</div><!-- form -->


<!-- Footer -->

