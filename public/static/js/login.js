var ws = '';
var client_id = '';

$(document).ready(function () {
    //使用原生WebSocket
    if (window.WebSocket || window.MozWebSocket)
    {
        ws = new WebSocket(junim.server);
    }
    //使用flash websocket
    else if (junim.flash_websocket)
    {
        WEB_SOCKET_SWF_LOCATION = "/static/flash-websocket/WebSocketMain.swf";
        $.getScript("/static/flash-websocket/swfobject.js", function () {
            $.getScript("/static/flash-websocket/web_socket.js", function () {
                ws = new WebSocket(junim.server);
            });
        });
    }
    //使用http xhr长轮循
    else
    {
        ws = new Comet(junim.server);
    }
    listenEvent();
});

function listenEvent()
{
	//ws websocket open
	ws.open = function(e){
		//connect success!
		console.log("connect webim server success.");
		//send login data
		msg = new Object();
		msg.cmd = 'login';
		msg.name = user.nickname;
		msg.avatar = user.avatar;
		//send
		ws.send(JSON.stringify(msg));
	}

	ws.onmessage = function(e){
		//alert(e.data);
		//get websocket data
		var message = JSON.parse(e.data);
		var cmd = message.cmd;
		switch(cmd){
			case 'login':
				console.log('connect junim server success.');
				client_id = JSON.parse(e.data).fd;
				//get history
				ws.send(JSON.stringify({cmd : 'getHistory'}));
				//get online
				ws.send(JSON.stringify({cmd : 'getOnline'}));
				break;
			case 'getHistory':
				//show history list
				showHistory(message);
				break;
			case 'getOnline':
				//show online user
				showOnline(message);
				break;
			case 'newUser':
				//show new login user
				showNewUser(message);
				break;
			case 'newMessage':
				//show new message
				showNewMessage(message);
				break;
			case 'offLine':
				//show offline user
				//Modify friends online status
				ModifyUserStatus();
				break;
		}
	}

}