<?php
	define("SERVER", "localhost");
	define("DATABASENAME","test");
	define("TABLE_USERINFO","userinfo");
	define("USERNAME","root");
	define("PASSWORD","root");
	$con = mysql_connect(SERVER,USERNAME,PASSWORD);
	$json = "";
	if(!$con){
		$json = json_encode(array("state"=>-1,"msg"=>"连接出错！"));
		die($json);
	}
	mysql_select_db(DATABASENAME,$con);
	$userName = $_POST["userName"];
	$password = $_POST["password"];
// 	$userName = "test1";
// 	$password = "test1";
	$sql = "select * from userinfo where userName = '".$userName."' and password= '".$password."'";
	$result = mysql_query($sql);
	$response = mysql_fetch_array($result);
	if($response[0]!=""){
		$json = json_encode(array("state"=>0,"msg"=>"登陆成功!","userInfo"=>array("id"=>$response[0],"userName"=>$response[1],"password"=>$response[2],"role"=>$response[3])));
	}else{
		$json = json_encode(array("state"=>-1,"msg"=>"登陆失败！".mysql_error()));
	}
	echo $json;
?>