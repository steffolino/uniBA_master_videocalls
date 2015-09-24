<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
$logoutLink =  Yii::app()->createUrl('/site/logout'); 

$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/pollForNotifications.js');
/*$cs->registerCssFile($baseUrl.'/css/bootstrap-material-design/dist/css/material-fullpalette.css');
$cs->registerScriptFile($baseUrl.'/css/bootstrap-material-design/dist/js/material.js');
$cs->registerCssFile($baseUrl.'/css/bootstrap-material-design/dist/css/ripples.css');
$cs->registerCssFile($baseUrl.'/css/bootstrap-material-design/dist/css/roboto.css');
$cs->registerScriptFile($baseUrl.'/css/bootstrap-material-design/dist/js/ripples.js');
*/

//echo Yii::app()->getGlobalState('slideShow');
?>

<script language="javascript" type="text/javascript">
/*	$(document).ready(function () {
		$.material.init('.btn', '.well', '.jumbotron');
		$.material.ripples('.btn');	
	});
*/
    var js_username = "<?php echo Yii::app()->user->name ?>";
</script>

<!-- Header -->
<div class=row>
	<div class="jumbotron alert alert-warning col-md-12 jumboHeader">
				<h4  style="text-align:center;">Hallo <?php echo strToUpper(Yii::app()->user->name); ?>.
						<?php
						if(isset($_GET['leftCall'])) {
							echo "Sie haben soeben den Anruf mit ". strtoupper(htmlspecialchars($_GET['leftCall'])) . ' beendet.';					
						} else {
							echo "M&ouml;chten Sie jemanden anrufen?";
						}
						?>
					</h4>
	</div>
</div>
<?php 
/*
echo "<pre>";
var_dump($currentUser); 
echo "</pre>";
*/
?>
<!-- Main -->
<div class="row">
	<div class="jumbotron col-md-12 _col-md-offset-1 shadow-z-1"  style="background-color:#fafafa;">
			<?php 
					echo "<div class='row'>";
					//BIGGER MODALS
					if(sizeOf($currentUser[0]['contacts']) < 4) {
						$colMdSize = 4;
					//MEDIUM SIZE MODALS
					} else if (sizeOf($currentUser[0]['contacts']) < 5) {
						$colMdSize = 3;
					//ONLY IMAGES AND NAMES
					} else {
						$colMdSize = 2;						
					}
					foreach($currentUser[0]['contacts'] as $contact) {
								echo 
								"<div class='col-sm-6 col-md-".$colMdSize."' style='min-width:20%;'>
									<div class='thumbnail  shadow-z-1' style='_height:400px'>
									<img class='img-circle' src='images/userImages/user".$contact['contactID'].".jpg' style='max-height:180px;' alt=".$contact['contactName']['username'].">
									<div class='caption'>
										<h3 style='text-align:center'>".strToUpper($contact['contactName']['username'])."</h3>";
											echo "<div style='_height:110px'><p>";
											echo "<ul>";
											//var_dump($contact['contactStories']);
											/*foreach($contact['contactStories'] as $contactStory) {
												echo "<li>".$contactStory['userStory']."</li>";
											}
											echo "</ul>";
											*/
											echo "</p></div>";
										echo "<div class='modal-footer call-modal-footer' style='text-align:center;'><p>";
										if($colMdSize < 3) {
											echo TbHtml::button('Anrufen', array(
												'color' => TbHtml::BUTTON_COLOR_PRIMARY,
												'size' => TbHtml::BUTTON_SIZE_LARGE,
												'data-toggle' => 'modal',
												'data-target' => '#call'.$contact['contactName']['username'].'Modal',
											));
										} else {
											echo TbHtml::button('Anrufen', array(
												'color' => TbHtml::BUTTON_COLOR_PRIMARY,
												'size' => TbHtml::BUTTON_SIZE_LARGE,
												'data-toggle' => 'modal',
												'data-target' => '#call'.$contact['contactName']['username'].'Modal',
											));											
										}
										//<a href='".Yii::app()->createUrl('site/invite', array('contactID'=>$contact['contactID']))."' class='btn btn-primary' role='button' data-toggle='>Call ".strToUpper($contact['contactName']['username'])."</a>
										echo "</p></div>";
									echo "</div>
									</div>
								</div>";

								// Modals --> One modal for every contact ---> performance?!
								$this->widget('bootstrap.widgets.TbModal', array(
									'id' => 'call'.$contact['contactName']['username'].'Modal',
									'header' => 'M&ouml;chten Sie '.strToUpper($contact['contactName']['username']).' anrufen?',
									'content' => "<div style='margin-left:auto; margin-right:auto; width:25%;'><img class='img-circle'  src='images/userImages/user".$contact['contactID'].".jpg' style='max-height:160px;' alt=".$contact['contactName']['username']."></div>",
									'footer' => array(
										TbHtml::button('Ja', array('data-dismiss' => 'modal', 'submit'=>'index.php?r=call/invite&contactID='.$contact['contactID'], 'color' => TbHtml::BUTTON_COLOR_PRIMARY, 'size' => TbHtml::BUTTON_SIZE_LARGE)),
										TbHtml::button('Nein', array('data-dismiss' => 'modal',  'size' => TbHtml::BUTTON_SIZE_LARGE)),
									 ),
								));


					}
			echo "</div>";
			?>
	</div>
</div>
	
	<!-- START OF Invitation Modal -->
	<div class="modal fade" id="invitationModal">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title">Eingehender Anruf</h4>
		  </div>
		  <div class="modal-body">
			<p id="invitationText"></p>
		  </div>
		  <div class="modal-footer">
			<button id="rejectButton" type="button" class="btn btn-default btn-lg" data-dismiss="modal">Anruf ablehnen</button>
			<a id="answerButton" type="submit" class="btn btn-primary btn-lg">Anruf annehmen</a>
			<input id="hidden_notificationID" type=hidden />
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- END OF Invitation Modal -->

	<?php
	if(isset($_GET['leftCall'])) {	
		echo '<div class="row">
			<div class="jumbotron col-md-12 alert">
				<a role="button" style="color:#222222;" class="btn btn-default pull-right" href="'.$logoutLink.'">Logout</a>
			</div>
		</div>';
	}
	?>
<style>
.thumbnail {
	transition: box-shadow 0.75s;
	-webkit-transition: box-shadow 0.75s;
}
.thumbnail:hover,.thumbnail:focus {
	box-shadow: 0 24px 17px 0 rgba(0, 0, 0, 0.4), 0 18px 20px 0 rgba(0, 0, 0, 0.38);
}
</style>	