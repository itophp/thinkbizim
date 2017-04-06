/* 
* @Author: anchen
* @Date:   2017-04-06 15:27:47
* @Last Modified by:   anchen
* @Last Modified time: 2017-04-06 15:28:02
*/

function listenEvent()
{
    //ws websocket open
    ws.onopen = function(e){
        //connect success!
        console.log("connect junim server success.");
        //send login data
        msg = new Object();
        msg.cmd = 'login';
        msg.sessid = getSessionId();
        msg.id = user.id;
        msg.name = user.name;
        msg.avatar = user.avatar;
        msg.secretToken = user.secretToken;
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
                client_id = user.id;
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
                userOffLine(message);
                break;
        }
    }

}
