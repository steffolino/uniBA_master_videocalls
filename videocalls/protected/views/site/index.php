<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
$logoutLink =  Yii::app()->createUrl('/site/logout'); 

$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/pollForNotifications.js');
?>

<script language="javascript" type="text/javascript">
    var js_username = "<?php echo Yii::app()->user->name ?>";
</script>

<!-- Header -->
<div class=row>
	<div class="jumbotron col-md-12 jumboheader">
		<div class="row">
			<div class="col-md-3">
				<div class=well>
					<h2  style="text-align:center;">Hallo <?php echo strToUpper(Yii::app()->user->name); ?></h2>
				</div>
			</div>
			<div class="col-md-6 alert-info">
				<h2 style="text-align:center">
					<?php
					if(isset($_GET['leftCall'])) {
						echo "Sie haben soeben den Anruf mit ". strtoupper(htmlspecialchars($_GET['leftCall'])) . ' beendet.';					
					} else {
						echo "M&ouml;chten Sie jemanden anrufen?";
					}
					?>
				</h2>
			</div>
			<div class="col-md-3" style="margin-top: 12px; text-align:right;">
				<div class=well>
					<a  type="button" class="btn btn-primary btn-lg" href='<?php echo $logoutLink; ?>'>Sie sind nicht <?php echo strToUpper(Yii::app()->user->name); ?>?</a>
				</div>
			</div>
		</div>
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
	<div class="jumbotron col-md-12 _col-md-offset-1">
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
									<div class='thumbnail' style='_height:400px'>
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
										TbHtml::button('Nein, doch nicht', array('data-dismiss' => 'modal',  'size' => TbHtml::BUTTON_SIZE_LARGE)),
									 ),
								));


					}
			echo "</div>";
			?>
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
		
	<!-- Footer >
	<!--div id="room_footer" class=row>
		<div class="jumbotron col-md-12 _col-md-offset-1">
			<div class=row>
				<div id="hangUpBtnDiv" class="col-md-4">
					<div id="hangUpBtn" class="btn btn-lg btn-danger col-md-10 col-md-offset-1" style="cursor:pointer"><i class="fa fa-2x fa-phone-square"> Hang up</i></div>
				</div>
				<div id="fullscreenBtnDiv" class="col-md-4">
					<div id="fullscreenBtn" class="btn btn-lg btn-primary col-md-10 col-md-offset-1" style="cursor:pointer"><i class="fa fa-2x fa-arrows-alt"> Fullscreen</i></div>
				</div>

				<div id="infoBtnDiv" class="col-md-4">
					<div id="infoBtn" class="btn btn-lg btn-success col-md-10 col-md-offset-1" style="cursor:pointer"><i style="aling:center" class="fa fa-2x fa-info-circle"> Info</i></div>
				</div>
			</div>
		</div>
</div>	

	
</div-->