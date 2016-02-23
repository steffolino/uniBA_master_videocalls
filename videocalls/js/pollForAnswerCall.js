
var POLLINGTIME = 15000;
var HANGUPTIMEOUT = 6000000;

$(document).ready(function () {

	//TODO: employ timeout
	hangUpTimeout();	

	var inviteeID = getUrlParameter('guest');

	if(inviteeID !== null) {
			 setInterval(function() {
				pollForAnswerCall(inviteeID);
				console.log("polling for ID "+ inviteeID);
			}, POLLINGTIME);
			//console.log(js_username);

	} else {
		console.log("Username not set");
	}

	$("#answerModal").on('hide.bs.modal', function () {
		// var notID = $("#answerModal #hidden_notificationID").val();
		// markNotAsAccepted(notID);
		// console.log("dismissed");
	});
	$("#rejectModal").on('hide.bs.modal', function () {
		var notID = $("#rejectModal #hidden_notificationID").val();
		// markNotAsRejected(notID);
		console.log("dismissed");
	});

/*	
	$("#goBackButton").on('click', function (e) {
		e.preventDefault();
		var notID = $("#rejectModal #hidden_notificationID").val();
		markNotAsCompleted(notID);
	});
	*/
});

function hangUpTimeout () {
	var t = setTimeout(function(){
		$("#noAnswerModal").modal('show');
		console.log("ey no answer");
	}, HANGUPTIMEOUT);
	
}

function markNotAsCompleted(notID) {
	
		$.ajax(
		{
			url: 'index.php?r=call/markNotAsCompleted',
			data: {notID : notID}			
		})
		.fail(function(error) {
			console.log("Notification Error");
		})
		.done(function(data) {
			console.log('notification '+data+ ' marked as completed');
			window.history.back();
		});
	
}


function pollForAnswerCall (inviteeID) {
	
	$.ajax(
		{
			url: 'index.php?r=call/pollNotificationsInviter',		
			data: {guestID : inviteeID}
		})
		.fail(function(error) {
			console.log("Notification Error");
		})
		.success(function(data) {
			if(data !== "no notifications") {
				var dataArr = $.parseJSON(data);
				console.log(dataArr);
				
				//Already gotten a response from invitee
				if(dataArr['notAnswer'] !== 'unread') {
					if(dataArr['notAnswer'] === 'yes') {
						//REDIRECT TO CHATROOM
						console.log("call answered ... join?");
						$("#answerModal").modal('show');
						//send2Stage_AnswerTrue();
						//IMPLEMENT MODAL TO INFORM USER ON ACCEPTED CALL --> THEN REDIRECT
					} else {
						//REDIRECT TO HOME
						$("#rejectModal").modal('show');
						console.log("call rejected ... going home");
					}
					
					//markNotificationAsCompleted(dataArr['notID']);

				//What to do? Invitee has not yet read the call invitation
				} else {
						console.log("not answered yet");
				}
			} else {
				//probably a mistake
				console.log("no unread nots");
			}
		});
	
}

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