
var POLLINGTIME = 10000;

$(document).ready(function () {

	if(js_username !== null) {
			 setInterval(function() {
				pollForNotifications(js_username);
				console.log("polling");
			}, POLLINGTIME);
			//console.log(js_username);

	} else {
		alert("Username not set");
	}

	$("#invitationModal").on('hide.bs.modal', function () {
		var notID = $("#invitationModal #hidden_notificationID").val();
		markNotAsRead(notID);
		console.log("dismissed");
	});
		
});

function markNotAsRead(notID) {
	
		$.ajax(
		{
			url: 'index.php?r=site/markNotAsRead',
			data: {notID : notID}			
		})
		.fail(function(error) {
			alert("Notification Error: " + error);
		})
		.done(function(data) {
			console.log('notification '+data+ ' marked as read');
		});
	
}

function pollForNotifications (username) {
	
	$.ajax(
		{
			url: 'index.php?r=site/pollNotifications',
			data: {username : username}
			
		})
		.fail(function(error) {
			alert("Notification Error: " + error);
		})
		.success(function(data) {
			if(data !== "no notifications") {
				var dataArr = $.parseJSON(data);
				//console.log(data);
				$("#invitationModal #invitationText").html(dataArr['notText']);
				$("#invitationModal #answerButton").prop("href", dataArr['notLink']);
				$("#invitationModal #hidden_notificationID").prop("value", dataArr['notID']);
				$("#invitationModal").modal('show');
			} else {
				console.log("no nots");
			}
		});
	
}