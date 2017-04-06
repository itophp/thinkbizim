/**
 * chat js  || connect websocket
 * auther:junnn.com | wuyuezhong
 */
 var ing_user;//当前用户
 var now_user;
 var now_type;
//===================== websocter start ======================================

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


/**
 * Gets friend
 * Get the current buddy list
 */
 function getFriend()
 {


 }

 function showHistory(message)
 {
 	$("#user_conchat_user_"+message.from_id).append(message.html);
	$(".my_show").scrollTop($(".con_box").height()-$(".my_show").height());//让滚动滚到最底端
 }

 function showNewUser(message)
 {
 	//update online-status
 	$('#online-status'+message.from_id).text('在线');
 }

 function userOffLine(message)
 {
 	$('#online-status'+message.from_id).text('离线');
 }

 function showNewMessage(message)
 {
 	var t=new Date().toLocaleTimeString();//当前时间
 	$("#user_conchat_user_"+message.from_id).append('<div class="my_say_con"><font color=\"#76EE00\">'+message.from_name+t+"</font><p><font color=\"#333333\">"+message.msg+'</font></p></div>');
	$(".my_show").scrollTop($(".con_box").height()-$(".my_show").height());//让滚动滚到最底端

 }

 /**
  * sendMsg
  * Send a message to a friend or group
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


//===================== websocter end ==================================================



//===================== operation start ========================
//经过输入文本框的时候
$("#texterea").hover(
  function () {
    $(this).addClass("textarea2");
  },
  function () {
    $(this).removeClass("textarea2");
  }
);

//===================== operation end =========================


//===================== function start =========================


	

function hover_user($this){
  $($this).hover(
    function () {
     $(this).addClass("hover");
    },
    function () {
      $(this).removeClass("hover");
    }
  );
}

function title_newuser(id,user,img){

	  if($("#"+id).length<1){

	  $("#mid_top").append('<div id="'+id+'" class="list"><table border="0" cellspacing="0" cellpadding="0"><tr><td id="zi'+id+'" class="td_user td_user_click">'+user+'</td><td id="zino'+id+'" class="td_hide td_hide_click">X</td></tr></table></div>');

	  //创建完成后给事件
	  //alert('#'+id)
	  $('#'+id).click(function(){title_newuser(id,user,img); });//给按钮加事件
	  //关闭
	  $("#zino"+id).click(function(){delete_user(id,user,img); return false });//关闭打开的
	  
	  
	  }else{
	  $("#zino"+id).addClass("td_hide_click");//给自己加样式
	  $("#zi"+id).addClass("td_user_click");//给自己加样式
	  }
	  my_siblings("#"+id);//去掉兄弟样式
	  //创建内容框
	  my_user_con(user,id);
	  //创建头像
	  my_user_head(user,id,img);
	  ing_user=id;//当前用户
	  //alert(ing_user);
	  $("#right_mid").html("");//清空右边的内容
	  getHistory();
	  
}

//更新最近聊天的位置
function ing_my_user($this,arr,i,ing){
	var id="user";
	$("#"+id+i).remove();
	$($this).prepend('<li id="'+id+i+'">'+arr[0]+'</li>');
	$('#'+id+i).click(function(){title_newuser('title_'+id+ing,arr[0],arr[1]); });//给按钮加事件
	hover_user('#'+id+i);//给经过触发	
}

//创建右边的头像
function my_user_head(user,id,img){
	if($(".head"+id).length<1){
		if(!img){//头像为空的时候
			img="user_img/0.jpg";
		}
       $("#right_top").append('<div class="head'+id+'"><p><img src="'+img+'" alt="'+user+'" /></p>'+user+'<div>');
	   $(".head"+id).hide();//默认是隐藏，让它有一点效果
	}
	sibli_hide(".head"+id);
}

//隐藏兄弟头像
function sibli_hide($this){
     $($this).show(500,function(){$(".my_show").scrollTop($(".con_box").height()-$(".my_show").height());/*让滚动滚到最底端*/}).siblings().hide(500);//隐藏其他兄弟
}
//创建内容框
function my_user_con(user,id){
	if($("#user_con"+id).length<1){
	   $(".con_box").append('<div id="user_con'+id+'"><font color="#CCCCCC">请在下面文本框里输入你想要聊天的内容，与用户【'+user+'】聊天</font></div>');
	   $("#user_con"+id).hide();//默认隐藏，增加效果
	}
	sibli_hide("#user_con"+id);//隐藏兄弟
}

//去掉兄弟的样式
function my_siblings($this){
     $($this).siblings().children().children().children().children().removeClass("td_hide_click td_user_click");
}

//关闭打开的窗口
function delete_user(id,user,img){
	if(ing_user==id){
		if(confirm('你确定要关闭 '+user+' 聊天窗口吗？\n 注意哦，关闭后你跟 '+user+' 的聊天记录就不见了哦')){
	    //alert(id);
		//alert($("#user_con"+id).text());//内容
		//alert($(".head"+id).html());//头像
		$("#"+id).remove();//栏目栏目
		$("#user_con"+id).remove();//删除内容
		$(".head"+id).remove();//删除头像
		 //alert($(".list").length);//还有几个栏目
		 if($(".list").length>0){
			 var eq=$(".list").length-1;
			 //alert($(".list:eq("+eq+")").attr("id"));
			 var old_id=$(".list:eq("+eq+")").attr("id");
			 sibli_hide(".head"+old_id);//显示最后一个的头像
			 sibli_hide("#user_con"+old_id);//显示最后一个的内容
			 $("#zino"+old_id).addClass("td_hide_click");//给最后一个加样式
	         $("#zi"+old_id).addClass("td_user_click");//给最后一个加样式
			 ing_user=old_id;//给聊天框定位
			 //alert(ing_user);
			 
		 }else{
		     //alert("已经全部删除");
			 $(".dandan_liaotian").show(500)
		 };
		
	    }
	}else{
		title_newuser(id,user,img);
	}
}


function saysay(){
	 if($(".list").length<1){
		   alert("你还没选中跟哪个聊天，请点左边好友选中一个再聊");
		   return false;
		 }
	 
	  var t=new Date().toLocaleTimeString();//当前时间
	  if($("#texterea").val()){
	  $("#user_con"+ing_user).append('<div class="my_say_con"><font color=\"#0000FF\">'+user.name+t+"</font><p><font color=\"#333333\">"+trim2(trim($("#texterea").val()))+'</font></p></div>');
	  $("#right_mid").html($("#texterea").val());//右边显示刚发送的文字
	  $("#texterea").val("");
	  $(".my_show").scrollTop($(".con_box").height()-$(".my_show").height());//让滚动滚到最底端
	  //alert($(".con_box").height());
	  //alert($("#user_con"+ing_user+" > .my_say_con").length);//聊天记录的个数
	   var ing_id=ing_user.substring(10,ing_user.length);
	   //alert(ing_id);
	   /*if($("#usering"+ing_id).length<1){//创建最近聊天人
	       dandan.newuser('.ul_1',$arr_user[ing_id],'ing'+ing_id,ing_id);//创建最近聊天
	   }else{
		   ing_my_user('.ul_1',$arr_user[ing_id],'ing'+ing_id,ing_id);//更新最近聊天的位置   
	   }*/
      }else{
		alert("你输入的内容为空")  
	  }
	  $("#texterea").focus();//光标焦点
	}  

//替换所有的回车换行   
function trim2(content)   
{   
    var string = content;   
    try{   
        string=string.replace(/\r\n/g,"<br />")   
        string=string.replace(/\n/g,"<br />");         
    }catch(e) {   
        alert(e.message);   
    }   
    return string;   
} 	
//替换所有的空格
function trim(content)   
{   
    var string = content;   
    try{   
        string=string.replace(/ /g,"&nbsp;")        
    }catch(e) {   
        alert(e.message);   
    }   
    return string;   
} 	

function getSessionId(){
	
   var c_name = 'PHPSESSID';
   if(document.cookie.length>0){
      c_start=document.cookie.indexOf(c_name + "=")
      if(c_start!=-1){ 
        c_start=c_start + c_name.length+1 
        c_end=document.cookie.indexOf(";",c_start)
        if(c_end==-1) c_end=document.cookie.length
        return unescape(document.cookie.substring(c_start,c_end));
      }
   }
  }


//===================== function end ===============================