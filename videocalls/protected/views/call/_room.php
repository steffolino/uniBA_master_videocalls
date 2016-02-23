<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Room';
$this->breadcrumbs=array(
	'Room',
);

 // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");         

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    }
/*
Yii::app()->clientScript->registerScriptFile(
	//only when connected to internet
	//'http://simplewebrtc.com/latest.js'
);
*/
/*
	$baseUrl = Yii::app()->baseUrl; 
	$cs = Yii::app()->getClientScript();
	//$cs->registerScriptFile($baseUrl.'/js/Fullscreen/jquery.fullscreen-min.js');
//	$cs->registerScriptFile($baseUrl.'/js/SimpleWebRTC/simplewebrtc.bundle.js');
*/
?>

<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
$logoutLink =  Yii::app()->createUrl('/site/logout'); 
?>

<script language="javascript" type="text/javascript">
    var js_username = "<?php echo Yii::app()->user->name ?>";
	// var js_visavisName = "<?php echo $visavis->username ?>";
</script>

<div id="opacLayer" class="modal fadein hidden" style="background-color:#222222;">
</div>

<!-- Header -->
<div class=row>
	<div id="jumboHeader" class="alert alert-warning col-md-12 well">
		<h4 style="text-align:center;"> Hallo <?php echo strToUpper(Yii::app()->user->name); ?>. Sie telefonieren mit <?php echo strtoupper($visavis->username); ?>
		</h4>
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
						<!--video id="localVideo" style="display:hidden;" height="400px" width="100%"></video-->
						<div height:="320px" id="remotes" class="col-md-12"></div>
					</div>
						<!--div id="remoteVideos" height="320px" width="75%"></div-->
					<div id ="videoRight" class="col-md-6 pull-right" style="background-color:#fefefe; color:#111111; height:100%; display:none;">
						<blockquote id="videoRight_infoText">
						<?php
							foreach ($visavis->ownUserStories as $userDescriptionClass) {
								echo "<p class='spickerP' style='font-size:24px'>".$userDescriptionClass->userStory."</p>";
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
					<div id="hangUpBtn" class="btn btn-lg btn-danger col-md-10 col-md-offset-1" style="cursor:pointer"><i class="fa fa-lg fa-phone-square fa-rotate-180"></i>&nbsp;Auflegen</div>
				</div>
				<div id="fullscreenBtnDiv" class="col-md-4">
					<div id="fullscreenBtn" class="btn btn-lg btn-primary col-md-10 col-md-offset-1" style="cursor:pointer"><i class="fa fa-lg fa-arrows-alt"></i> Gro&szlig;es Bild</div>
				</div>
				<div id="smallScreenBtnDiv" class="col-md-4 hidden">
					<div id="smallScreenBtn" class="btn btn-lg btn-primary col-md-10 col-md-offset-1" style="cursor:pointer"><i class="fa fa-lg fa-bars"></i> Kleines Bild</div>
				</div>
				<div id="infoBtnDiv" class="col-md-4">
					<div id="infoBtn" class="btn btn-lg btn-success col-md-10 col-md-offset-1" style="cursor:pointer"><i style="align:center" class="fa fa-lg fa-info-circle"></i> Spickzettel</div>
				</div>
			</div>
		</div>
</div>	

<style>
.localVideo {
	display:none;
}
video {
	width:100%;
}

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

//TODO: export to extra js file
$(document).ready(function() {
	console.log("welcome");
	//goToCallButton
	 $("#goToCallButton").on('click', function (e) {
		 console.log("goToCall");
		 e.preventDefault();
		 if(typeof(js_notID) != 'undefined') {
			setInvitationToCompleted(js_notID);
		 }
		 if($("#waitingContainer")) {
			 var mediaPlayer = $("#player2");
			 mediaPlayer.prop('src', "");
			console.log(mediaPlayer);
			$("#waitingContainer").slideUp('slow');
			$("#roomContainer").fadeIn('slow');
			$(".modal-backdrop").fadeOut('fast');
		} 
	 });

 	$("#doit").on('click', function() {
		remoteVideoAppendedCallback();
	});


	$("#infoBtn").on('click', function () {
		$("#videoRight").slideToggle('slow');
	});
	
	$("#hangUpBtn").on('click', function () {
		window.location = "index.php?r=site/index&leftCall=" + js_visavisName;
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
		//$("#localVideo").css({'height': '100%'});
		$("#remotes").css({'height': '100%'});
		$("#jumboHeader").hide().addClass('hidden');
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
		//$("#localVideo").css({'height': '320px'});
		// $("#remotes").css({'height': '320px'});
		$("#jumboHeader").show().removeClass('hidden');
		$("#room_footer").removeClass('footFully');
		$("#videoRight").removeClass('hidden');
		$(".jumbotron").removeClass('jumboFully');
		$("#opacLayer").hide().addClass('hidden');
//		$(document.body).css('overflow','auto');
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
</script>
	<!-- XIRSYS STUFF FOR WEBRTC -->
    <script src="js/xsdk-master/thirdparty/simplewebrtc.bundle.js"></script>
    <script src="js/xsdk-master/examples/xirsys_connect.js"></script>
    <script src="js/xsdk-master/lib/xirsys.core.js"></script>
    <script src="js/xsdk-master/lib/xirsys.api.js"></script>
    <script src="js/xsdk-master/lib/xirsys.simplewebrtc.js"></script>
    <script>
	
    // create webrtc connection
	var roomHost = getUrlParameter('host');
	var roomGuest = getUrlParameter('guest');
	var roomName = roomHost+roomGuest;


	var webrtc = (xirsysConnect.secure === true)
		? new $xirsys.simplewebrtc(xirsysConnect.token_url, xirsysConnect.ice_url, xirsysConnect.room_url)
		: new $xirsys.simplewebrtc();
		console.log("connectState: "+xirsysConnect.secure);
	var connectionProperties = xirsysConnect.data;
	console.log(xirsysConnect.data);
	webrtc.connect(
		connectionProperties,
		{
			localVideoEl: 'localVideo', // the id/dom element to hold "our" video
			remoteVideosEl: 'remoteVideos', // the id/dom element to hold remote videos // Should this be 'remotes' instead?
			autoRequestMedia: true, // immediately ask for camera access
			debug: false,
			detectSpeakingEvents: false,
			autoAdjustMic: false
		}
	);

//OLD below
/*var webrtc = new SimpleWebRTC({
    // the id/element dom element that will hold "our" video
    localVideoEl: 'localVideo',
    // the id/element dom element that will hold remote videos
    remoteVideosEl: 'remoteVideos',
    // immediately ask for camera access
    autoRequestMedia: true
});
*/
	// we have to wait until it's ready
	webrtc.on('readyToCall', function () {
		// you can name it anything
		console.log('joining room: videocalls-room');
		//not working when entering numbers --> constant name --> only 1 connection at a time
		if (roomName) webrtc.joinRoom('videocalls-room');
	});

     webrtc.on('videoAdded', function (video, peer) {
			console.log('video added', peer);
			 var remotes = document.getElementById('remotes');
			 if (remotes) {
				 var d = document.createElement('div');
				 d.className = 'videoContainer col-md-12';	
				 d.id = 'container_' + webrtc.getDomId(peer);
				 d.appendChild(video);
				 video.onclick = function () {
					 video.style.width = (video.videoWidth * 0.5) + 'px';
					 video.style.height = (video.videoHeight * 0.5) + 'px';
				 };
				 remotes.appendChild(d);
				 remoteVideoAppendedCallback();
			}
     });
     webrtc.on('videoRemoved', function (video, peer) {
         console.log('video removed ', peer);
         var remotes = document.getElementById('remotes');
         var el = document.getElementById('container_' + webrtc.getDomId(peer));
         if (remotes && el) {
             remotes.removeChild(el);
			 changeNotificationHeader();
         }
     });

	 // local p2p/ice failure
	webrtc.on('iceFailed', function (peer) {
		var pc = peer.pc;
		console.log('had local relay candidate', pc.hadLocalRelayCandidate);
		console.log('had remote relay candidate', pc.hadRemoteRelayCandidate);
	});

	// remote p2p/ice failure
	webrtc.on('connectivityError', function (peer) {
		var pc = peer.pc;
		console.log('had local relay candidate', pc.hadLocalRelayCandidate);
		console.log('had remote relay candidate', pc.hadRemoteRelayCandidate);
	});
	 
	 function remoteVideoAppendedCallback() {
		 console.log("remoteVideoAppended");
		 $("#answerModal").modal('show');
		 //Clear notification
	 }
	 
	 function changeNotificationHeader () {
		 $(".greeting").val(js_visavisName + ' hat aufgelegt.');
	 }
	 
	 function setInvitationToCompleted(notID) {
	$.ajax(
		{
			url: 'index.php?r=call/markNotAsCompleted',
			data: {notID : notID}			
		})
		.fail(function(error) {
			console.log("Notification Error: " + error);
		})
		.done(function(data) {
			console.log('notification '+data+ ' marked as completed');
		});
}
</script>