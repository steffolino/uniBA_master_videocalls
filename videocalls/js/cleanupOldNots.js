
var CLEANUPINTERVALTIME = 3000;

$(document).ready(function () {

	 setInterval(function() {
			cleanupOldNots();
		}, CLEANUPINTERVALTIME);
	
	
});

function cleanupOldNots () {
	
		//var currentTime = $.now();
	
		$.ajax(
		{
			url: 'index.php?r=call/cleanupOldNots',		
		})
		.fail(function(error) {
			console.log("Error while cleaning: "+error);
		})
		.success(function(data) {
			console.log("cleanup result: "+data);
		});

}