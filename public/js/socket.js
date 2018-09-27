
var server = require('http').Server();
var io = require('socket.io')(server);
var Redis = require('ioredis');
var redis = new Redis();

//redis.subscribe('test-channel');
redis.psubscribe('*'); //multiple channels

//redis.on('message', function(channel, message) {
redis.on('pmessage', function(subscribed, channel, message) { //multiple channels
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
     console.log('on');
});

server.listen(6379);
