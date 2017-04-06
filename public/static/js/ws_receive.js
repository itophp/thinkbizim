/* 
* @Author: wuyuezhong
* @Date:   2017-04-06 15:26:19
* @Last Modified time: 2017-04-06 15:28:39
*/

/**
 * [showHistory description]
 * @param  {[type]} message [description]
 * @return {[type]}         [description]
 * 显示当前好友的历史记录，信息由websocket提供
 */
 function showHistory(message)
 {
    $("#user_conchat_user_"+message.from_id).append(message.html);
    $(".my_show").scrollTop($(".con_box").height()-$(".my_show").height());//让滚动滚到最底端
 }


/**
 * [showNewUser description]
 * @param  {[type]} message [description]
 * @return {[type]}         [description]
 * 显示最新上线的好友=======好友上线通知
 */
 function showNewUser(message)
 {
    //update online-status
    $('#online-status'+message.from_id).text('在线');
 }

/**
 * [userOffLine description]
 * @param  {[type]} message [description]
 * @return {[type]}         [description]
 * 好友下线通知
 */
 function userOffLine(message)
 {
    $('#online-status'+message.from_id).text('离线');
 }

/**
 * [showNewMessage description]
 * @param  {[type]} message [description]
 * @return {[type]}         [description]
 * 显示最新发送过来的消息
 */
 function showNewMessage(message)
 {
    var t=new Date().toLocaleTimeString();//当前时间
    $("#user_conchat_user_"+message.from_id).append('<div class="my_say_con"><font color=\"#76EE00\">'+message.from_name+t+"</font><p><font color=\"#333333\">"+message.msg+'</font></p></div>');
    $(".my_show").scrollTop($(".con_box").height()-$(".my_show").height());//让滚动滚到最底端

 }