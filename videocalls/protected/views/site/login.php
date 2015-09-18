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
<!-- Header -->
<div class=row>
	<div class="jumbotron jumboHeader alert alert-info col-md-12">
				<h4  style="text-align:center;">Willkommen. Bitte geben Sie Ihren Namen ein.
				</h4>
	</div>
</div>

<!-- Main -->
<div class=row>
	<div class="jumbotron col-md-12">
	<div class="form">
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
					<br/>
					<?php echo "<div class='pull-right'>"; ?>
					<?php echo $form->labelEx($model,'slideShow'); ?>
					<?php echo $form->checkBox($model, 'slideShow')."</div>";?>
				</div>
			</div>
			
			<br/>
			
			<!-- Main Content -->
			<div class="row buttons">
				<div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
					<?php echo TbHtml::submitButton('Ja, das bin ich.', array('color'=> TbHtml::BUTTON_COLOR_PRIMARY, 'size' => TbHtml::BUTTON_SIZE_LARGE, 'block'=>true)); ?>
				</div>
			</div>
			
			<!-- Header / Notifications -->
			<div class="row footer">
			</div>
	</div>
	<?php $this->endWidget(); ?>
	</div><!-- form -->
</div>

<!-- Footer -->
