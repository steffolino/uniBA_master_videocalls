<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Room';
$this->breadcrumbs=array(
	'Room',
);
/*
Yii::app()->clientScript->registerScriptFile(
	//only when connected to internet
	//'http://simplewebrtc.com/latest.js'
);
*/

	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	$cs->registerScriptFile($baseUrl.'/js/Fullscreen/jquery.fullscreen-min.js');
	$cs->registerScriptFile($baseUrl.'/js/SimpleWebRTC/simplewebrtc-latest.js');
?>

<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
$logoutLink =  Yii::app()->createUrl('/site/logout'); 
?>

<script language="javascript" type="text/javascript">
    var js_username = "<?php echo Yii::app()->user->name ?>";
</script>

<?php
foreach($conversationPartners as $participant) {
	if($participant->username !== Yii::app()->user->name) {
			$visavis = $participant;
	}
}
?>
<div id="opacLayer" class="modal fadein hidden" style="background-color:#222222;">
</div>

<!-- Header -->
<div class=row>
	<div class="jumbotron col-md-12 jumboheader">
			<div class=row>
				<div class="col-md-3">
					<div class="well">
						<h2 style="text-align:center;">Hallo <?php echo strToUpper(Yii::app()->user->name); ?></h2>
					</div>
				</div>
				<div class="col-md-6 alert-info">
					<h2 style="text-align:center">
						Sie telefonieren mit <?php echo strtoupper($visavis->username); ?>
					</h2>
				</div>
			</div>
	</div>
</div>
<?php 


?>
<!-- Main -->
<div class="row">
	<div class="jumbotron col-md-12">
		<div class="row">
			<div class="col-md-12">
				<div class=row style="border:1px solid #222222; background-color:#222222;">
					<!--div id="videoLeft" class="col-md-2">
						<p>test left</p>
					</div-->
					<div id="videoCenter" class="col-md-6">
						<video id="localVideo" height=auto width="100%"></video>
						<!--div id="remoteVideos"></div-->
					</div>
					<div id ="videoRight" class="col-md-6" style="background-color:#fefefe; height:100%; display:none;">
						<blockquote id="videoRight_infoText">
						<?php
							foreach ($visavis->ownUserStories as $userDescriptionClass) {
								echo "<p>".$userDescriptionClass->userStory."</p>";	
							}
						?>
						</blockquote>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>		




<!-- Footer -->
<div id="room_footer" class=row>
		<div class="jumbotron col-md-12 _col-md-offset-1">
			<div class=row>
				<div id="hangUpBtnDiv" class="col-md-4">
					<div id="hangUpBtn" class="btn btn-lg btn-danger col-md-10 col-md-offset-1" style="cursor:pointer"><i class="fa fa-2x fa-phone-square fa-rotate-180"></i><i class="fa fa-2x">&nbsp;Auflegen</i></div>
				</div>
				<div id="fullscreenBtnDiv" class="col-md-4">
					<div id="fullscreenBtn" class="btn btn-lg btn-primary col-md-10 col-md-offset-1" style="cursor:pointer"><i class="fa fa-2x fa-arrows-alt"> Gro&szlig;es Bild</i></div>
				</div>
				<div id="smallScreenBtnDiv" class="col-md-4 hidden">
					<div id="smallScreenBtn" class="btn btn-lg btn-primary col-md-10 col-md-offset-1" style="cursor:pointer"><i class="fa fa-2x fa-bars"> Kleines Bild</i></div>
				</div>
				<div id="infoBtnDiv" class="col-md-4">
					<div id="infoBtn" class="btn btn-lg btn-success col-md-10 col-md-offset-1" style="cursor:pointer"><i style="aling:center" class="fa fa-2x fa-info-circle"> Spickzettel</i></div>
				</div>
			</div>
		</div>
</div>	

<style>
.footFully {
	left: 13.5%;
	padding: 5px 0px;
	width: 75%;
	bottom: 5px;
	position: fixed;
	z-index: 9999;
}

.jumboFully {
	padding: 0px !important;
	margin: 0px !important;
	z-index: 1051;
}

#room_footer .jumboFully {
	background-color:transparent;
}

</style>
			
<script>

    var js_visavisName = "<?php echo $visavis->username ?>";

//TODO: export to extra js file
$(document).ready(function() {
	$("#infoBtn").on('click', function () {
		$("#videoRight").slideToggle('slow');
	});
	
	$("#hangUpBtn").on('click', function () {
		window.location = "index.php?r=site/index&leftCall="+js_visavisName;
	});
	
	$("#fullscreenBtn").on('click', function () {
		console.log("fullscreen");
		$("#videoCenter").removeClass('col-md-6'); // standard
		$("#videoCenter").addClass('col-md-10 col-md-offset-1'); // standard
		$("#smallScreenBtnDiv").removeClass('hidden col-md-4');
		$("#smallScreenBtnDiv").addClass('col-md-6');
		$("#hangUpBtnDiv").removeClass('col-md-4');
		$("#hangUpBtnDiv").addClass('col-md-6');
		$("#fullscreenBtnDiv").addClass('hidden');
		$("#infoBtnDiv").addClass('hidden');		
		$("#localVideo").css({'height': '100%'});
		$(".jumboheader").addClass('hidden');
		$("#room_footer").addClass('footFully');
		$("#videoRight").addClass('hidden');
		$(".jumbotron").addClass('jumboFully');
		$("#opacLayer").show().removeClass('hidden');
		$(document.body).css('overflow','hidden');
		$(document).scrollTop(0);
	});
	
	$("#smallScreenBtn").on('click', function () {
		$("#videoCenter").addClass('col-md-6'); // standard
		$("#videoCenter").removeClass('col-md-10 col-md-offset-1'); // standard
		$("#smallScreenBtnDiv").addClass('hidden col-md-4');
		$("#smallScreenBtnDiv").removeClass('col-md-6');
		$("#hangUpBtnDiv").addClass('col-md-4');
		$("#hangUpBtnDiv").removeClass('col-md-6');
		$("#fullscreenBtnDiv").removeClass('hidden');		
		$("#infoBtnDiv").removeClass('hidden');		
		$("#localVideo").css({'height': 'auto'});
		$(".jumboheader").removeClass('hidden');
		$("#room_footer").removeClass('footFully');
		$("#videoRight").removeClass('hidden');
		$(".jumbotron").removeClass('jumboFully');
		$("#opacLayer").hide().addClass('hidden');
		$(document.body).css('overflow','auto');
		$(document).scrollTop(0);
	});
});

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

var webrtc = new SimpleWebRTC({
    // the id/element dom element that will hold "our" video
    localVideoEl: 'localVideo',
    // the id/element dom element that will hold remote videos
    remoteVideosEl: 'remoteVideos',
    // immediately ask for camera access
    autoRequestMedia: true
});

var roomHost = getUrlParameter('host');
var roomGuest = getUrlParameter('guest');
var roomName = roomHost+roomGuest;

// we have to wait until it's ready
webrtc.on('readyToCall', function () {
    // you can name it anything
    webrtc.joinRoom(roomName);
});


</script>