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
$userId = $_POST["userId"];


$sql = "select name,time,misstime from projectTime where userId = '".$userId."'";
$result = mysql_query($sql);
$projects = array();
$i = 0;
while($row=mysql_fetch_array($result,MYSQL_ASSOC)){
	$projects[$i] = $row;
	$i++;
}
		if($projects[0]!=""){
			$json = json_encode(array("state"=>0,"msg"=>"","projects"=>$projects));
		}else{
			$json = json_encode(array("state"=>-1,"msg"=>"没有记录！","projects"=>$projects));
		}
	
	echo $json;
?>