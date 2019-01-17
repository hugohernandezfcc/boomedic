var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var Redis = require('ioredis'); 
var redis = new Redis(6379, '127.0.0.1');
server.listen(6379);
io.on('connection', function (socket) {
 
  console.log("client connected");

  redis.subscribe('test-channel');
 
  redis.on("test-channel", function(channel, data) {
    console.log("mew message add in queue "+ data['message'] + " channel");
    socket.emit(channel, data);
  });
 
  socket.on('disconnect', function() {
    redis.quit();
  });
 
});