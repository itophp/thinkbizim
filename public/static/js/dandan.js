$(function (){
/*
作者：mr yang
网站：www.seejoke.com
email:admin@seejoke.com
*/	



   window['dandan']={}
   var ing_user;//当前用户
   //浏览器
   function liulanqi(){
	  var h=$(window).height();
	  var w=$(window).width();
	  $("#top").width(w);
	  $("#foot").html(h);
	 
	  $(".box").height(h-135);
	  $("#mid_con").height(h-255);
	  $(".right_box").height(h-134);
	  $("#mid_say textarea").width(w-480);
	  
	  if($(".box").height()<350){
		$(".box").height(350)
		 }
	  if($("#mid_con").height()<230){
		 $("#mid_con").height(230)
		  }
	  if($(".right_box").height()<351){
		 $(".right_box").height(351)
		  }
	  if($("#mid_say textarea").width()<320){
		  $("#mid_say textarea").width(320)
		  }
	 
/*	 if($("#mid_foot").width()<400){
		 $("#mid_foot").width(400)
		 }  */
		  
	  	  
		  
	  if(w<=800){
		  $("#top").width(800);
		  $("#body").width(800)
		   }else{
		  $("#body").css("width","100%")  
		}	  
	  //$("#top").html(b_h);
	  
	  $(".my_show").height($("#mid_con").height()-30);//显示的内容的高度出现滚动条
	  //$(".my_show").scrollTop($(".con_box").height()-$(".my_show").height());//让滚动滚到最底端.在这里不加这句了，没多用，可能还卡
	  
	  //右边的高度
	  r_h=$(".right_box").height()-40*3;
	  $("#right_top").height(r_h*0.25)
	  $("#right_mid").height(r_h*0.45)
	  $("#right_foot").height(r_h*0.3)
	  
   }
   window['dandan']['liulanqi']=liulanqi;
   
 //时间
function mytime(){
   var now=(new Date()).getHours();
    if(now>0&&now<=6){
	  return "午夜好";
    }else if(now>6&&now<=11){
	  return  "早上好";
    }else if(now>11&&now<=14){
	  return "中午好";
    }else if(now>14&&now<=18){
	  return "下午好";
   }else{
	  return "晚上好";
   }
}
window['dandan']['mytime']=mytime;   
   
   
   
   
//触发浏览器   
$(window).scroll( function() { dandan.liulanqi();  } );//滚动触发
$(window).resize(function(){ dandan.liulanqi(); return false; });//窗口触发
//alert("??????")
dandan.liulanqi();


//ctrl+回车
    $("body").bind('keyup',function(event) {   
         if(event.ctrlKey&&event.keyCode==13){  
         	myenter();
        }
		if(!event.ctrlKey&&event.keyCode==13){
			if( sendMsg() ){
				saysay();
			}else{
				alert('sending failed!!!');
			}         	
		}
    }); 
//发送按钮 
    $("#mid_sand").click(function (){
           	saysay();					   
    })
			 
function myenter(){
    //回车键的时候换行，留以后可以有用
}

//显示个数
function user_geshu(){
     var length1=$(".ul_1 > li").length;
     var length2=$(".ul_2 > li").length;
     $(".n_geshu_1").text(length1);
     $(".n_geshu_2").text(length2);	
}
user_geshu()
//alert(length1)

//点击展开会员
$(".h3").click(function (){
	 $(this).toggleClass("click_h3").next(".ul").toggle(600);
});

//过滤所有的空格
function kongge(content)   
{   
    return content.replace(/^\s\s*/, '').replace(/\s\s*$/, '');   
} 
window['dandan']['kongge']=kongge;



/*******************************************************************************************/
//创建新用户
function newuser($this,arr,i,ing){
	var id="user";
	
	//alert(ing)
	if(ing!=undefined){//创建最近聊天
	   //alert("最近聊天为真");
	   $($this).prepend('<li id="'+id+i+'">'+arr[0]+'</li>');
	   $('#'+id+i).click(function(){title_newuser('title_'+id+ing,arr[0],arr[1]); });//给按钮加事件
	}else{//创建好友
	  $($this).append('<li id="'+id+i+'">'+arr[0]+'</li>');
	  $('#'+id+i).click(function(){title_newuser('title_'+id+i,arr[0],arr[1]); });//给按钮加事件
	}
	hover_user('#'+id+i);//给经过触发	
	user_geshu();//更新人数
}
window['dandan']['newuser']=newuser;

//欢迎
$("#top").html('<br />&nbsp;&nbsp;'+dandan.mytime()+','+user.name+',欢迎你的到来！！');

})