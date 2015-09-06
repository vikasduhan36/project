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
var archiveID = null;
var is_archiving = 0;
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
    
    session.on('archiveStarted', function(event) {
    	$('#startArchive').hide();
    	$('#stopArchive').show();
    	is_archiving = 1;
    	  archiveID = event.id;
    	});

    session.on('archiveStopped', function(event) {
    	$('#startArchive').show();
    	$('#stopArchive').hide();
    	console.log('************');
    	console.log(JSON.stringify(event));
    	console.log('************');
    	archiveID = null;
    	});
    
    session.on({
        connectionCreated: function(event) {
            connectionCount++;
            if (event.connection.connectionId != event.target.connection.connectionId) {
            	myId = event.target.connection.connectionId;
            }
            
            OT.log(connectionCount + " connections." + event.connection.connectionId);
			
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
    	 var publisherProps = {
    		            width: myCameraWidth,
    		            height: myCameraHeight,
    		            insertMode: "replace"
	           };
    	if(type == "exp")
		{
    		 
	        publisher = OT.initPublisher("mainvideo", publisherProps);
		}
    	else
		{
    		
	        publisher = OT.initPublisher("smallvideo", publisherProps);
		}
        session.publish(publisher);
        publisher.on({
            streamCreated: function(event) {
                streamcount++;
                $('#timerView').show()
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
		
        
        var subscriberProps = {
            width: VIDEO_WIDTH,
            height: VIDEO_HEIGHT,
            insertMode: "replace"
        };
        subscribers[stream.streamId] = session.subscribe(stream, 'mainvideo', subscriberProps);
	}
	else
	{
	    var subscriberProps = {
	        width: VIDEO_WIDTH,
	        height: VIDEO_HEIGHT,
	        insertMode: "replace"
	    };
	    subscribers[stream.streamId] = session.subscribe(stream, 'user_'+stream.connection.data, subscriberProps);
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
	
	if(signalType == 'signal:time_allow' && my_id == event.data)
	{
		alert('Expert has allowed you to participate more time in this session.');
		clearInterval(myVar);
		newTimer('sess_timer')
	}
	else if(signalType == 'signal:time_reject' && my_id == event.data)
	{
		alert('Expert has denied you to participate more time in this session.');
		clearInterval(myVar);
		window.location.href = root+'session_complete.php?id='+s_id;
	}
}

$(document).ready(function(){

	$("#audio_control").click(function(){
		var $this = $(this);
		if($this.hasClass("active"))
		{
			turnOnMyAudio();
		}
		else
		{
			turnOffMyAudio();
		}
		$this.toggleClass("active");
	});
	
	$("#video_control").click(function(){
		var $this = $(this);
		if($this.hasClass("active"))
		{
			turnOnMyVideo();
		}
		else
		{
			turnOffMyVideo();
		}
		$this.toggleClass("active");
	});
	
	$("#end_session").click(function(){
		var r = confirm("Are you sure you want to end this session.");
		if(r)
		{
			window.location.href = root+'session_complete.php?id='+s_id;
		}
		
	});
	
});

function myTimer(user_id)                                                     
{
    if(sec > 0){
        document.getElementById('seconds_'+user_id).innerHTML = preced_zero(sec-1);
        sec--;
    }else{
        sec = 59;
        document.getElementById('seconds_'+user_id).innerHTML = preced_zero(sec);
        if(min > 0){
            document.getElementById('minutes_'+user_id).innerHTML = preced_zero(min-1);
            min--;
        }else{
            min = 59;
            document.getElementById('minutes_'+user_id).innerHTML = preced_zero(min);
            if(hrs > 0){
                document.getElementById('hours_'+user_id).innerHTML = preced_zero(hrs-1);
                hrs--;
            }else{
                hrs = 23;
                document.getElementById('hours_'+user_id).innerHTML = preced_zero(hrs);
                if(days > 0){
                    document.getElementById('days_'+user_id).innerHTML = preced_zero(days-1);
                    days--;
                }
            }
        }
    }
 
        if((hrs==0)&&(min==0)&&(sec == 0))                                                                                                                   // session
        {
			clearInterval(myVar);
			var r = confirm("Your session time has been completed. \r Do you want to request Expert for more time?");
			if(r)
			{
			session.signal({
				type: "time_request",
				data: my_id
			});
			}
			else
			{
			window.location.href = root+'session_complete.php?id='+s_id;
			}
		}	
     
}
function preced_zero(value)
{
	if(value < 10)
	{
		return "0"+value;
	}
	else
	{
		return value;
	}
}

function newTimer(element)
{
     var el = document.getElementById(element);
    el.innerHTML = "<span>00</span>:<span>01</span>";
	var seconds_timer = 0;
	var minutes_timer = 0;
	
        newTimer = setInterval(function() {
             
            if(seconds_timer == 60)
            {
                minutes_timer++;
                seconds_timer = 0;
            }
            if(minutes_timer > 0) 
            {
                var minute_text = "0"+minutes_timer;
            } 
            else
            {
                var minute_text = "00";
            }
            var second_text = seconds_timer;
            if(seconds_timer<10)
            {
                seconds_timer="0"+seconds_timer;
            }
            if(minutes_timer<9)
            {
                el.innerHTML = "<span>0"+minutes_timer + '</span>:<span>' + seconds_timer+'</span>';
            }
            else
            {
                el.innerHTML = "<span>"+minutes_timer + '</span>:<span>' + seconds_timer+'</span>';
            }
            seconds_timer++;
        }, 1000);
     
}
