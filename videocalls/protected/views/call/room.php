<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - Room';
$this->breadcrumbs=array(
	'Room',
);

Yii::app()->clientScript->registerScriptFile(
	'http://simplewebrtc.com/latest.js'
);

?>

<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
$logoutLink =  Yii::app()->createUrl('/site/logout'); 
?>

<script language="javascript" type="text/javascript">
    var js_username = "<?php echo Yii::app()->user->name ?>";
</script>

<!-- Header -->
<div class=row>
	<div class="jumbotron col-md-10 col-md-offset-1 jumboheader">
			<h2>Welcome, <?php echo Yii::app()->user->name; ?></h2>
			<p class="lead">
					Would you like to call somebody?
			</p>
	</div>
</div>
<?php 

echo "<pre>";
var_dump($conversationPartners); 
echo "</pre>";

?>
<!-- Main -->
<div class=row">
	<div class="jumbotron col-md-10 col-md-offset-1">
	<p>Welcome to the WebRTC Demo</p>
        <video id="localVideo"></video>
        <div id="remoteVideos"></div>
	</div>
</div>		
	<!-- Footer -->
	<div class=row>
			<div class="jumbotron col-md-10 col-md-offset-1">
				<div class="col-md-3 col-md-offset-9">
				<!--TODO: replace hard-coded logout-->
					<a href='<?php echo $logoutLink; ?>';">You're not <?php echo Yii::app()->user->name; ?>?&nbsp;<span style="cursor:pointer" class="glyphicon glyphicon-log-out" alt="Bye!"></span></a>
				</div>
			</div>
	</div>	
	
</div>

<style>
    #remoteVideos video {
        height: 520px;
    }
    #localVideo {
        height: 150px;
    }
</style>

<h1>WebRTC</h1>

		
<script>
var webrtc = new SimpleWebRTC({
    // the id/element dom element that will hold "our" video
    localVideoEl: 'localVideo',
    // the id/element dom element that will hold remote videos
    remoteVideosEl: 'remoteVideos',
    // immediately ask for camera access
    autoRequestMedia: true
});

var roomName = getUrlParameter('roomId');

// we have to wait until it's ready
webrtc.on('readyToCall', function () {
    // you can name it anything
    webrtc.joinRoom(roomName);
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