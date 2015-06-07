<?php
/**
 * 用户体系集成
 * @author shiming<siminily@gmail.com>
 * @date 2015-05-23
 *
 * 用户数据结构
 *-----------------------------------------------------------------------------------
 * 属性		|字段名   |		|数据类型	|	描述										    |
 *-----------------------------------------------------------------------------------
 * 环信ID	|username|	    |String	|	username是环信用户的唯一标识,在appkey的范围内唯一 	|
 *-----------------------------------------------------------------------------------
 * 用户密码	|password|	    |String	|	用户登录环信使用的密码                          | 
 *-----------------------------------------------------------------------------------
 */
class Users {
	private $easeapi;
	//构造函数
	public function __construct($easeapi) {
		$this->easeapi = $easeapi;
	}
	//授权注册单个用户
	public function register($username, $password, $nickname = null) {
		$params = array(
			'username' => $username,
			'password' => md5($password),
			'nickname' => isset($nickname)?$nickname:$username
			);
		return $this->easeapi->curl('/users', $params);
	}
	//获取单个用户
	public function getOne($username) {
		return $this->easeapi->curl('/users/'.$username, null, "GET");
	}
	//获取多个用户
	public function getSome($limit=10) {
		return $this->easeapi->curl('/users', 'limit='.$limit, "GET");
	}
	//删除单个用户
	public function deleteOne($username) {
		return $this->easeapi->curl('/users/'.$username, null, "DELETE");
	}
	//删除多个用户
	public function deleteSome($limit=10) {
		return $this->easeapi->curl('/users', 'limit='.$limit, "DELETE");
	}
	//修改用户密码
	public function modifyPassword($username, $newPassword) {
		return $this->easeapi->curl('/users/'.$username.'/password', array('newpassword' => $newPassword), "PUT");
	}
	//修改用户昵称
	public function modifyNickname($username, $nickname) {
		return $this->easeapi->curl('/users/'.$username, array('nickname' => $nickname), "PUT");
	}
	//添加好友
	public function addFriend($owner_username, $friend_username) {
		return $this->easeapi->curl('/users/'.$owner_username.'/contacts/users/'.$friend_username, null);
	}
	//删除好友
	public function deleteFriend($owner_username, $friend_username) {
		return $this->easeapi->curl('/users/'.$owner_username.'/contacts/users/'.$friend_username, null, "DELETE");
	}
	//查看好友
	public function getFriend($owner_username) {
		return $this->easeapi->curl('/users/'.$owner_username.'/contacts/users', null, "GET");
	}
	//查看黑名单
	public function getBlock($owner_username) {
		return $this->easeapi->curl('/users/'.$owner_username.'/blocks/users', null, "GET");
	}
	//加入黑名单
	public function addBlock($owner_username, $block_username = array()) {
		return $this->easeapi->curl('/users/'.$owner_username.'/blocks/users', array('usernames' => $block_username), null);
	}
	//解除黑名单
	public function deleteBlock($owner_username, $block_username) {
		return $this->easeapi->curl('/users/'.$owner_username.'/blocks/users/'.$block_username, null, "DELETE");
	}
	//查看用户在线状态
	public function checkOnline($username) {
		return $this->easeapi->curl('/users/'.$username.'/status', null, "GET");
	}
	//查询离线消息数
	public function getUnreadCount($owner_username) {
		return $this->easeapi->curl('/users/'.$owner_username.'/offline_msg_count', null, "GET");
	}
	//查询某条离线消息状态
	public function getUnreadStatus($username, $msg_id) {
		return $this->easeapi->curl('/users/'.$username.'/offline_msg_status/'.$msg_id, null, "GET");
	}
	//获取用户加入的群组 此方法我觉得放到这个类更恰当
	public function getUserGroups($username) {
		return $this->easeapi->curl('/users/'.$username."/joined_chatgroups", null, "GET");
	}
	//获取用户加入的聊天室 此方法我觉得放到这个类更恰当
	public function getUserRooms($username) {
		return $this->easeapi->curl('/users/'.$username."/joined_chatrooms", null, "GET");
	}
	//用户账号禁用
	public function deactivate($username) {
		return $this->easeapi->curl('/users/'.$username.'/deactivate', null);
	}
	//用户账号解禁
	public function activate($username) {
		return $this->easeapi->curl('/users/'.$username.'/activate', null);
	}
	//强制用户下线
	public function disconnect($username) {
		return $this->easeapi->curl('/users/'.$username.'/disconnect', null, "GET");
	}
}
