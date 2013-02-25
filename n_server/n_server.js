
/**
 * Module dependencies.
 */
var app = require('http').createServer();

var socketio = require('socket.io');
var clients = {};
var users = {};
var io = socketio.listen(app, { log: false });

io.sockets.on('connection', function (socket) {
	socket.on('username', function(username){
 		users[username] = socket.id;
		clients[socket.id] = socket;
		console.log(username + " is online, sid: " +　users[username]);
	});
	socket.on('reply_to', function(username){
		var socket = clients[users[username]];
		socket.emit('message', {type:0});//type: 0 -- new reply , 1 -- update of subscribe
		console.log("reply_to: " +　username + " sid: " + users[username]);
	});
	socket.on('update_subscribe', function(){
		var socket = clients[users[username]];
		socket.emit('message', {type:1});//type: 0 -- new reply , 1 -- update of subscribe
		console.log("update_subscribe: " +　username + " sid: " + users[username]);
	});
});


app.listen(8889, function(){
  	console.log("Server listening on port %d.", app.address().port);
});
