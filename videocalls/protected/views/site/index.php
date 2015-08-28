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
	<div class="jumbotron col-md-12 _col-md-offset-1 jumboheader">
		<div class="row">
			<div class="col-md-6">
				<h2>Welcome, <?php echo Yii::app()->user->name; ?></h2>
				<p class="lead">
					<?php
					if(isset($_GET['leftCall'])) {
						echo "You just left the call with ". strtoupper(htmlspecialchars($_GET['leftCall']));					
					} else {
						echo "Would you like to call somebody?";
					}
					?>
				</p>
			</div>
			<div class="col-md-3 col-md-offset-3" style="margin-top: 30px">
					<a  type="button" class="btn btn-primary" href='<?php echo $logoutLink; ?>';">You're not <?php echo Yii::app()->user->name; ?>?&nbsp;<span style="cursor:pointer" class="glyphicon glyphicon-log-out" alt="Bye!"></span></a>
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
<div class=row">
	<div class="jumbotron col-md-12 _col-md-offset-1">
			<?php 
					echo "<div class='row'>";
					foreach($currentUser[0]['contacts'] as $contact) {
								echo 
								"<div class='col-sm-6 col-md-4'>
									<div class='thumbnail' style='height:430px'>
									<img class='img-circle' src='images/userImages/user".$contact['contactID'].".jpg' style='max-height:160px;' alt=".$contact['contactName']['username'].">
									<div class='caption'>
										<h3 style='text-align:center'>".strToUpper($contact['contactName']['username'])."</h3>";
											echo "<div style='height:130px'><p><ul>";
											//var_dump($contact['contactStories']);
											foreach($contact['contactStories'] as $contactStory) {
												echo "<li>".$contactStory['userStory']."</li>";
											}
											echo "</ul></p></div>";
										echo "<div class='modal-footer'><p>";
										echo TbHtml::button('Call '.strToUpper($contact['contactName']['username']), array(
											'color' => TbHtml::BUTTON_COLOR_PRIMARY,
											//'size' => TbHtml::BUTTON_SIZE_LARGE,
											'data-toggle' => 'modal',
											'data-target' => '#call'.$contact['contactName']['username'].'Modal',
										));
										//<a href='".Yii::app()->createUrl('site/invite', array('contactID'=>$contact['contactID']))."' class='btn btn-primary' role='button' data-toggle='>Call ".strToUpper($contact['contactName']['username'])."</a>
										echo "</p></div>";
									echo "</div>
									</div>
								</div>";

								// Modals --> One modal for every contact ---> performance?!
								$this->widget('bootstrap.widgets.TbModal', array(
									'id' => 'call'.$contact['contactName']['username'].'Modal',
									'header' => 'Do you really want to call  '.strToUpper($contact['contactName']['username']),
									'content' => "<div style='margin-left:auto; margin-right:auto; width:25%;'><img class='img-circle'  src='images/userImages/user".$contact['contactID'].".jpg' style='max-height:160px;' alt=".$contact['contactName']['username']."></div>",
									'footer' => array(
										TbHtml::button('Yes', array('data-dismiss' => 'modal', 'submit'=>'index.php?r=call/invite&contactID='.$contact['contactID'], 'color' => TbHtml::BUTTON_COLOR_PRIMARY)),
										TbHtml::button('No', array('data-dismiss' => 'modal')),
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
			<h4 class="modal-title">Incoming Call</h4>
		  </div>
		  <div class="modal-body">
			<p id="invitationText"></p>
		  </div>
		  <div class="modal-footer">
			<button id="rejectButton" type="button" class="btn btn-default" data-dismiss="modal">Reject</button>
			<a id="answerButton" type="submit" class="btn btn-primary">Answer Call</a>
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