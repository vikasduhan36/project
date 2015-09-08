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
				
				//$('#user_'+event.connection.data).parent().fadeIn();
				//$("#no_user").fadeOut();
				
				var exp_id = $("#exp_id").text();
				onlineUserDetail(event.connection.data,exp_id);
            }
            
            OT.log(connectionCount + " connections." + event.connection.connectionId)
        },
        connectionDestroyed: function(event) {
            connectionCount--;
            OT.log(OtConnectionCount + " connections.");
			if (event.connection.connectionId != event.target.connection.connectionId) {
            	
				
				$('#user_'+event.connection.data).parent().hide();
				if($('#user_'+event.connection.data).length == 0)
				{
					$('#timer_'+event.connection.data).parent().prepend('<div class="v_blk_innr" id="user_'+event.connection.data+'" ></div>')
				}
				var s_id = $('#timer_'+event.connection.data).attr('alt');
				stopTimeTrack(s_id);
				
            }
			if(OtConnectionCount == 1)
			{
				$("#no_user").fadeIn();
			}
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
	
		
        
        var subscriberProps = {
            width: VIDEO_WIDTH,
            height: VIDEO_HEIGHT,
            insertMode: "replace"
        };
        subscribers[stream.streamId] = session.subscribe(stream, 'user_'+stream.connection.data, subscriberProps);
	
	
    
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
	
	if(signalType == 'signal:time_request')
	{
		//event.from.data
		var r = confirm($("#user_"+event.from.data).next("h6").text()+" has requested for more session time.\r\nClick ok to allow.");
		
		if(r)
		{
			session.signal({
				type: "time_allow",
				data: event.from.data
			});
			
			$.ajax({
				url:'handler.php',
				type:'post',
				data:{'action':'timeRequest','s_id':event.data},
				dataType:'json',
				success:function(result){
				}
			});
		
		}
		else
		{
			session.signal({
				type: "time_reject",
				data: event.from.data
			});
		}
		
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
			window.location.href = root+'exp_sessions.php';
		}
		
	});
	
});

function userTimer(user_id)                                                     
{
var sec = parseInt(document.getElementById('seconds_'+user_id).innerHTML);
					var min = parseInt(document.getElementById('minutes_'+user_id).innerHTML);
					var hrs = parseInt(document.getElementById('hours_'+user_id).innerHTML);
					
	var myVar=setInterval(function(){
    if(sec > 0){
        //document.getElementById('seconds_'+user_id).innerHTML = sec-1;
        sec--;
    }else{
        sec = 59;
       // document.getElementById('seconds_'+user_id).innerHTML = sec;
        if(min > 0){
            //document.getElementById('minutes_'+user_id).innerHTML = min-1;
            min--;
        }else{
            min = 59;
           // document.getElementById('minutes_'+user_id).innerHTML = min;
            if(hrs > 0){
             //   document.getElementById('hours_'+user_id).innerHTML = hrs-1;
                hrs--;
            }else{
                hrs = 23;
              //  document.getElementById('hours_'+user_id).innerHTML = hrs;
                if(days > 0){
                 //   document.getElementById('days_'+user_id).innerHTML = days-1;
                    days--;
                }
            }
        }
    }
 
        if((hrs==0)&&(min==0)&&(sec == 0))                                                                                                                   // session
        {
           // alert('User session finished.');
		   clearInterval(myVar);
		}	
	
	document.getElementById('timer_'+user_id).innerHTML	= preced_zero(hrs)+':'+preced_zero(min)+':'+preced_zero(sec);
     },1000);
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

function onlineUserDetail(user_id,exp_id)
{
	
	if($('#user_'+user_id).length > 0)
	{
		$('#user_'+user_id).parent().fadeIn();
		$("#no_user").hide();
		return false;
	}

	$.ajax({
		url:'handler.php',
		type:'post',
		data:{'action':'onlineUserDetail','user_id':user_id,'exp_id':exp_id,'for':'exp'},
		dataType:'json',
		success:function(result){
			if(result.status == 'success')
			{
				var html = '';
				
				var response = result.data;
				html += '<div class="v_blk_otr">';
            	html += '<div class="v_blk_innr" id="user_'+user_id+'" ></div>';
                html += '<h6>'+response.fname+' '+response.lname+'</h6>';
                html += '<span class="time_es" id="timer_'+user_id+'" alt="'+response.s_id+'" ></span>';
				html += '<span style="display:none;">';
				html += '<span id="days_'+user_id+'" class="tim" style="display:none;">'+response.timer.Days+'</span>';
				html += '<span id="hours_'+user_id+'" >'+response.timer.Hours+'</span>:';
				html += '<span id="minutes_'+user_id+'">'+response.timer.Minutes+'</span>: ';
				html += '<span id="seconds_'+user_id+'">'+response.timer.Seconds+'</span>';
				html += '</span>';
					
				
		
				html += '</div>';
			
				$("#no_user").fadeOut();
				$(".user_online_detail").append(html);
				var days = 0;
				var sec = parseInt(document.getElementById('seconds_'+user_id).innerHTML);
				var min = parseInt(document.getElementById('minutes_'+user_id).innerHTML);
				var hrs = parseInt(document.getElementById('hours_'+user_id).innerHTML);
				
				userTimer(user_id);
				
			}
		}
	
	});
}


function stopTimeTrack(s_id)
{
	$.ajax({
		url:'handler.php',
		type:'post',
		data:{'action':'stopTimeTrack','s_id':s_id},
		dataType:'json',
		success:function(result){
			
		}	
	});
}