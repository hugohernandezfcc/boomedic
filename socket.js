var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis({
  connectTimeout: 10000
})

redis.subscribe('testone', function () {
    console.log('Redis: test subscribed');
});

redis.on('message', function(channel, message) {
    console.log('Redis: Message on ' + channel + ' received!');
    console.log(message);
});

io.on('connection', function(socket){
    console.log('a user connected');
    socket.on('disconnect', function(){
        console.log('user disconnected');
    });
});


http.listen(6379, function(){
    console.log('listening on *:6379');
});
