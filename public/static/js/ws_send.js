/* 
* @Author: wuyuezhong
* @Date:   2017-04-06 15:25:42
* @Last Modified time: 2017-04-06 15:28:43
*/

/**
  * sendMsg
  * Send a message to a friend or group
  * 用户输入发送消息
  */
  function sendMsg()
  {
    var msg = {};

    content = $('#texterea').val();

    if (typeof content == "string") {
        content = content.replace(" ", "&nbsp;");
    }

    if (!content) {
        return false;
    }
    //set msg
    msg.cmd = 'message';
    msg.from = client_id;
    //get Get received ID
    chatArr = ing_user.split('_');
    chatId = chatArr['2'];
    //get end
    msg.to = chatId;
    msg.type = chatArr['2'];
    msg.msg = content;
    //send  
    if( ws.send(JSON.stringify(msg)) == false){
        return false;
    }else{
        return true;
    }
  }

/**
 * [getHistory description]
 * @return {[type]} [description]
 * 获取当前好友的历史记录
 */
  function getHistory()
  {
    var msg = {};

    //set msg
    msg.cmd = 'getHistory';
    msg.from = client_id;
    //get Get received ID
    chatArr = ing_user.split('_');
    chatId = chatArr['2'];
    msg.to = chatId;
    msg.type = 1;
    if( ws.send(JSON.stringify(msg)) == false){
        return false;
    }else{
        return true;
    }
  }

  /**
 * [addFriend description]
 * 添加好友申请
 */
 function addFriend(id)
 {
    var msg = {};

    //操作命令
    msg.cmd = 'addFriend';
    //发送方
    msg.from = client_id;
    //添加的用户ID
    chatArr = ing_user.split('_');
    chatId = chatArr['2'];
    msg.to = chatId;
    if( ws.send(JSON.stringify(msg)) == false){
        return false;
    }else{
        return true;
    }

 }


 /**
  * 获取用户基本信息
  */
 function getOpenInfo(id,name)
 {
     var msg = {};
     //定义命令
     msg.cmd = 'getOpenInfo';
     //定义获取用户ID
     msg.to = id;
     //发送
     if( ws.send(JSON.stringify(msg)) == false){
         return false;
     }else{
         layer.ready(function(){
             layer.open({
                 type: 1,
                 title: name,
                 shadeClose: true,
                 //shade: false,
                 maxmin: true, //开启最大化最小化按钮
                 area: ['700px', '400px'],
                 content: '<div id="openinfo_"'+id+'>正在获取用户信息...</div>',
             });
         });
     }
 }