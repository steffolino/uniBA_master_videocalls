// Ident and secret should ideally be passed from a server for security purposes.
// If serverAuthentication is true then you should remove these two values.

 var xirsysConnect = {
 	secure : false,
 	data : {
 		domain : 'videocalls.stef90210.bplaced.net',
 		application : 'videocalls-app',
 		room : 'videocalls-room',
 		ident : 'stef',
 		secret : '79e27446-5b92-11e5-b718-5b48a002eb05'
 	}
 };

//Secure method
// var xirsysConnect = {
	// secure : true,
	// token_url : 'https://service.xirsys.com/signal/token',
	// ice_url : 'https://service.xirsys.com/ice',
	// room_url : 'https://service.xirsys.com/room',
	// data : {
		// domain : 'www.xirsys.com',
		// application : 'default',
		// room : 'default'
	// }
// };

