var OtConnectionCount = 0;
var streamCount = 0;
var singleException = 0;
var is_signal = 0;
var subscriber;
var session = null;
var system_requirement = OT.checkSystemRequirements();
var connectionCount = 0;
var connection = "";
var myId = null;
var audio = "";

OT.setLogLevel(OT.DEBUG);
OT.on("exception", exceptionHandler);
if (system_requirement == 0) {} else {
    session = OT.initSession(apiKey, sessionId);
    session.on('sessionConnected', sessionConnectedHandler);
    session.on('sessionDisconnected', sessionDisconnectedHandler);
    session.on('connectionCreated', connectionCreatedHandler);
    session.on('connectionDestroyed', connectionDestroyedHandler);
    session.on('streamCreated', streamCreatedHandler);
    session.on('streamDestroyed', streamDestroyedHandler);
    session.on("signal", signalReceivedHandler);
    
    session.on({
        connectionCreated: function(event) {
            connectionCount++;
            if (event.connection.connectionId != event.target.connection.connectionId) {
            	myId = event.target.connection.connectionId;
            }
            
            OT.log(connectionCount + " connections." + event.connection.connectionId)
        },
        connectionDestroyed: function(event) {
            connectionCount--;
            OT.log(connectionCount + " connections.")
        },
        sessionDisconnected: function sessionDisconnectHandler(event) {
            if (event.reason == "networkDisconnected") {
                alert("Your network connection terminated.")
            }
        }
    });
    session.connect(token, function(error) {
        if (error) {} else {
            OtConnectionCount = 0
        }
    })
}

function startPublishing() {
    if (!publisher) {
    	if(type == "exp")
		{
    		  var publisherProps = {
    		            width: myCameraWidth,
    		            height: myCameraHeight,
    		            insertMode: "replace"
	           };
	        publisher = OT.initPublisher("myCamera", publisherProps);
		}
    	else
		{
    		
    	    VIDEO_HEIGHT = 150;
    	    VIDEO_WIDTH = 221;
    	    var publisherProps = {
    	        width: VIDEO_WIDTH,
    	        height: VIDEO_HEIGHT,
    	        insertMode: "replace"
    	    };
    	    publisher = OT.initPublisher("subVideo", publisherProps);
		}
        session.publish(publisher);
        publisher.on({
            streamCreated: function(event) {
                streamcount++;
                //$('#timerView').show()
            },
            streamDestroyed: function(event) {},
            accessDialogOpened: function accessDialogOpenedHandler(event) {},
            accessDialogClosed: function(event) {},
            accessAllowed: function(event) {},
            accessDenied: function accessDeniedHandler(event) {}
        })
    }
}

function stopPublishing() {
    if (publisher) {
        session.unpublish(publisher)
    }
    publisher.destroy()
}

function disconnect() {
    session.disconnect()
}

function addStream(stream) {
    if (stream.connection.connectionId == session.connection.connectionId) {
        return
    }
	if(stream.connection.data == "exp")
	{
		$('#myCamera').prepend('<div id="' + stream.connection.connectionId + '"></div>');
        
        var subscriberProps = {
            width: VIDEO_WIDTH,
            height: VIDEO_HEIGHT,
            insertMode: "replace"
        };
        subscribers[stream.streamId] = session.subscribe(stream, stream.connection.connectionId, subscriberProps);
	}
	else
	{
		$('#user').prepend('<div class="small_screen" id="' + stream.connection.connectionId + '">&nbsp;</div>');
	    VIDEO_HEIGHT = 150;
	    VIDEO_WIDTH = 221;
	    var subscriberProps = {
	        width: VIDEO_WIDTH,
	        height: VIDEO_HEIGHT,
	        insertMode: "replace"
	    };
	    subscribers[stream.streamId] = session.subscribe(stream, stream.connection.connectionId, subscriberProps);
	}
	
    
}

function sessionConnectedHandler(event) {
    connectionCount = 1;
    startPublishing()
}

function connectionCreatedHandler(event) {
    for (var i = 0; i < event.connection.length; i++) {
        connection = event.connection[i];
        connection[connection.connectionId] = {};
        connection[connection.connectionId].connection = connection;
        connection_id = session.connection.connectionId
    }
    OtConnectionCount++;
    is_signal = 0;
    if (OtConnectionCount == 1) {} else {}
    connectionCount++
}

function streamCreatedHandler(event) {
    console.log(JSON.stringify(event.stream));
    addStream(event.stream);
    streamcount++;
    if (event.stream.connection.connectionId != event.target.connection.connectionId) {
        var connected_user = event.stream.connection.connectionId
    } else {}
}

function connectionDestroyedHandler(event) {
    OtConnectionCount--;
    if (is_signal != 1) {} else {}
}

function streamDestroyedHandler(event) {
    if (is_signal != 1) {} else {}
}

function sessionDisconnectedHandler(event) {
    publisher.destroy()
}

function exceptionHandler(event) {
    if (event.code == 1500) {
        if (singleException == 0) {
            alert('We can not connect your camera/mic. \n Please make sure your camera/mic is not being used somewhere else.')
        }
        singleException++
    } else {
        forceDisconnect()
    }
}

function turnOffMyVideo() {
    publisher.publishVideo(false);
    publisher.publishAudio(false)
}

function turnOnMyVideo() {
    publisher.publishVideo(true);
    publisher.publishAudio(true)
}

function turnOffMyAudio() {
    publisher.publishAudio(false)
}

function turnOnMyAudio() {
    publisher.publishAudio(true)
}

function call_disconnect() {
    disconnect()
}

function forceDisconnect() {
    session.signal();
}

function signalReceivedHandler(event) {
    is_signal = 1
    
    var signalType = event.type;
	if(signalType == 'signal:textChat')
	{
		/*var display = '<tr class="lastText"><td>'+event.from.data+'</td><td>'+event.data+'</td></tr>';
		$('.lastText:last').after(display);*/
		
		var textType = "lft";
		//alert(event.from.connectionId+' / '+myId);
		if(event.from.connectionId == myId)
		{
			textType = "rt txtrt";
		}
		var name = "user";
		if(event.from.data)
		{
			name = event.from.data;
		}
		var display = '<li><h5 class="'+textType+'">'+name+'</h5>';
			display += '<p class="'+textType+'">'+event.data+'</p></li>';
	
		$('#noUser').append(display);
		$('.user_chat').scrollTop($('.user_chat')[0].scrollHeight);
	}
	
}



