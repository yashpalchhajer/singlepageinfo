var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis();
redis.subscribe('test-channel',function(err,count){

});

redis.on('message',function(){
    console.log('Message recieved');
    message = JSON.parse(message);
    io.emit(channel + ' : ' + message.event, message.data);
});
http.listen(3000,function(){
    console.log('Listen : 3000');
});
