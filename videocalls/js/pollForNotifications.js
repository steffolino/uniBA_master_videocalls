
var POLLINGTIME = 10000;

$(document).ready(function () {

	if(js_username !== null) {
			 setInterval(function() {
				pollForNotifications(js_username);
				console.log("polling for "+js_username);
			}, POLLINGTIME);
	} else {
		alert("Username not set");
	}

	$("#answerButton").on('click', function () {
		var notID = $("#invitationModal #hidden_notificationID").val();
		setInvitationToAccepted(notID);
	});

	$("#rejectButton").on('click', function () {
		var notID = $("#invitationModal #hidden_notificationID").val();
		setInvitationToRejected(notID);
	});
	
	$("#invitationModal").on('hide.bs.modal', function () {
		var notID = $("#invitationModal #hidden_notificationID").val();
		console.log("dismissed");
	});
		
});

function setInvitationToAccepted(notID) {
	$.ajax(
		{
			url: 'index.php?r=call/setInvitationToAccepted',
			data: {notID : notID}			
		})
		.fail(function(error) {
			alert("Notification Error: " + error);
		})
		.done(function(data) {
			console.log('notification '+data+ ' marked as accepted');
		});
}

function setInvitationToRejected(notID) {
	$.ajax(
		{
			url: 'index.php?r=call/setInvitationToRejected',
			data: {notID : notID}			
		})
		.fail(function(error) {
			alert("Notification Error: " + error);
		})
		.done(function(data) {
			console.log('notification '+data+ ' marked as rejected');
		});
}


function pollForNotifications (username) {
	
	$.ajax(
		{
			url: 'index.php?r=call/pollNotificationsInvitee',
			data: {username : username}
			
		})
		.fail(function(error) {
			alert("Notification Error: " + error);
		})
		.success(function(data) {
			if(data !== "no notifications") {
				var dataArr = $.parseJSON(data);
				console.log(data);
				$("#invitationModal #invitationText").html(dataArr['notText']);
				$("#invitationModal #answerButton").prop("href", dataArr['notLink']);
				$("#invitationModal #hidden_notificationID").prop("value", dataArr['notID']);
				$("#invitationModal").modal('show');
			} else {
				console.log("no nots");
			}
			
		});
	
}