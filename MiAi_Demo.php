<?php
//小米AI音箱 自定义技能Php版本Demo

//初始化基本变量
$exit = false;   //用户主动退出
$session = array();  //session基本量
$data = null;  //返回数据
$mic = true; //麦克风是否启用

//取得小米大脑POST数据（json格式）
//这个地方是你对小爱音箱说的话在小米大脑服务器转发的json字符串
$get = file_get_contents('php://input');
//解析json成数组
$arr = json_decode($get,true);
//取得用户意图语句
$data = $arr['request']['intent']['query'];
//取得用户请求类型
$type = $arr['request']['type'];

if($arr['request']['no_response']){
  $data = "主人，你怎么不理小水滴了啊，你还在嘛";
}


if($type == 0){
  $data = "欢迎使用小水滴，在这里我可以帮你完成一些简单的生活服务。";
}
if($type == 2){
  $data = "你要离开了吗，主人，小水滴期待下次遇见哦！";
  $mic = false;
}


$res = array(
   'open_mic' => $mic,
   'to_speak'=> array(
      'type' => 0,
      'text' => $data
   )
);

$response = array(
  'version'  => '1.0',
  'session_sttributes' => $session,
  'response' => $res,
  'is_session_end'=>$exit
  );

echo json_encode($response);
