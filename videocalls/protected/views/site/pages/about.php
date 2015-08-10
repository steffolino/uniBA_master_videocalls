<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
/*
Yii::app()->clientScript->registerScriptFile(
   // Yii::app()->baseUrl.'/js/SimpleWebRTC/simplewebrtc.js'
);
*/
Yii::app()->clientScript->registerScriptFile(
	'http://simplewebrtc.com/latest.js'
);


?>

<style>
    #remoteVideos video {
        height: 520px;
    }
    #localVideo {
        height: 150px;
    }
</style>

<h1>WebRTC</h1>
<p>Welcome to the WebRTC Demo</p>
        <video id="localVideo"></video>
        <div id="remoteVideos"></div>
		
<script>
var webrtc = new SimpleWebRTC({
    // the id/element dom element that will hold "our" video
    localVideoEl: 'localVideo',
    // the id/element dom element that will hold remote videos
    remoteVideosEl: 'remoteVideos',
    // immediately ask for camera access
    autoRequestMedia: true
});
// we have to wait until it's ready
webrtc.on('readyToCall', function () {
    // you can name it anything
    webrtc.joinRoom('videocalls');
});
</script>