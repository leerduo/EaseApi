<?php
function __autoload($className) {
	include_once "./EaseApi/".$className.'.class.php';
}
//替换成自己的
$client_id		= "YXA6wDs-MARqEeSO0VcBzaqg5A";
$client_secret 	= "YXA6JOMWlLap_YbI_ucz77j-4-mI0JA";
$org_name		= "easemob-playground";
$app_name		= "test1";

$easeapi 		= new EaseApi($client_id, $client_secret, $org_name, $app_name);
echo "access_token:".$easeapi->getToken();
echo '<hr/>';

$users			= new Users($easeapi);
$messages		= new Messages($easeapi);
$chatMessages	= new ChatMessages($easeapi);
$chatFiles 		= new ChatFiles($easeapi);
$chatGroups		= new ChatGroups($easeapi);
$chatRooms 		= new ChatRooms($easeapi);

//var_dump($users->getOne('jianguo'));
var_dump($users->getSome());
//var_dump($users->register("shiming", "123456"));
//var_dump($users->deleteOne('shiming'));
//var_dump($users->checkOnline('jianguo'));
//var_dump($users->getUserGroups('jianguo'));
//var_dump($users->getUserRooms('jianguo'));

//其他的自己测试下，我没有全部测试，有问题欢迎给我发邮件。
