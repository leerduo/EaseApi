<?php
/**
 * 聊天室管理
 * @author shiming<siminily@gmail.com>
 * @date 2015-06-07
 *
 * 用户数据结构
 *-----------------------------------------------------------------------------------
 * 名称					| 类型	|	描述										    |
 *-----------------------------------------------------------------------------------
 * id					|String	|	聊天室D, 聊天室唯一标识符 ， 由环信服务器生成 	 	|
 *-----------------------------------------------------------------------------------
 * name					|String	|	聊天室名称 ，任意字符串                         | 
 *-----------------------------------------------------------------------------------
 * description			|String	|	聊天室描述 ，任意字符串                         | 
 *-----------------------------------------------------------------------------------
 * maxusers				|Integer|	聊天室成员上限，创建聊天室的时候设置，可修改			|
 *-----------------------------------------------------------------------------------
 * affilliations_count	|Integer|	现有成员总数 	                     			| 
 *-----------------------------------------------------------------------------------
 * affilliations		|Array	|	用户登录环信使用的密码                          | 
 *-----------------------------------------------------------------------------------
 * owner				|String	|	创建者id，例如：{"owner":"123456"}    			| 
 *-----------------------------------------------------------------------------------
 * member				|String	|	成员id，例如： {"member":"xc6xrnbzci"}        | 
 *-----------------------------------------------------------------------------------
 */
class ChatRooms {
	private $easeapi;
	//构造函数
	public function __construct($easeapi) {
		$this->easeapi = $easeapi;
	}
	//创建聊天室
	public function createRoom($name, $description, $owner, $maxusers = null, $members = null) {
		$params = array(
			'name' 			=> $name,
			'description' 	=> $description,
			'owner'			=> $owner,
			'maxusers'		=> $maxusers,
			'members'		=> $members
			);
		return $this->easeapi->curl('/chatrooms', $params);
	}
	//修改聊天室信息
	public function modifyRoom($chatroom_id, $name, $description, $maxusers) {
		$params = array(
			'name' 			=> $name,
			'description' 	=> $description,
			'maxusers'		=> $maxusers
			);
		return $this->easeapi->curl('/chatrooms/'.$chatroom_id, $params, "PUT");
	}
	//删除聊天室
	public function deleteRoom($chatroom_id) {
		return $this->easeapi->curl('/chatrooms/'.$chatroom_id, null, "DELETE");
	}
	//获取app中所有的聊天室
	public function getAllRooms() {
		return $this->easeapi->curl('/chatrooms', null, "GET");
	}
	//获取一个聊天室详情
	public function getOneRoom($chatroom_id) {
		return $this->easeapi->curl('/chatrooms/'.$chatroom_id, null, "GET");
	}
	//获取用户加入的聊天室 此方法我觉得应该放到Users.class.php里面
	public function getUserRooms($username) {
		return $this->easeapi->curl('/users/'.$username."/joined_chatrooms", null, "GET");
	}
}
