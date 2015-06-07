<?php
/**
 * 群组管理
 * @author shiming<siminily@gmail.com>
 * @date 2015-05-23
 *
 * 群组数据结构
 *-----------------------------------------------------------------------------------
 * 名称					| 类型	  |					描述								|
 *-----------------------------------------------------------------------------------
 * id					| String  |	群组ID, 群组唯一标识符 ， 由环信服务器生成 。			|
 *-----------------------------------------------------------------------------------
 * groupid				| String  |	群组ID, 和 id 一样，群组唯一标识符， 由环信服务器生成 。	|
 *-----------------------------------------------------------------------------------
 * name					| String  |	群组名称 ， 任意字符串								|
 *-----------------------------------------------------------------------------------
 * groupname			| String  |	群组名称 ， 任意字符串								|
 *-----------------------------------------------------------------------------------
 * description			| String  |	群组描述 ， 任意字符串								|
 *-----------------------------------------------------------------------------------
 * public				| Boolean |	群组类型： true 公开群，false 私有群					|
 *-----------------------------------------------------------------------------------
 * membersonly			| Boolean |	是否只有群成员可以进来发言，true 是 ， false 否		|
 *-----------------------------------------------------------------------------------
 * allowinvites			| Boolean |	是否允许群成员邀请别人加入此群。true允许，false只允许群主|
 *-----------------------------------------------------------------------------------
 * maxusers				| Integer |	群成员上限，创建群组的时候设置，可修改					|
 *-----------------------------------------------------------------------------------
 * affiliations_count	| Integer |	现有成员总数										|
 *-----------------------------------------------------------------------------------
 * affiliations			| Array	  |	现有成员列表, 包含了owner和member,例如：             |
 *-----------------------------------------------------------------------------------
 *“affiliations”:[{“owner”: “13800138001”},{“member”:”v3yarx”},{“member”:”xcbzci”}] |
 *-----------------------------------------------------------------------------------
 * owner				| String  |	群主的username， 例如：{“owner”: “13800138001”}	|
 *-----------------------------------------------------------------------------------
 * member				| String  |	群成员的username ， 例如： {“member”:”xc6xrnbzci”}	|
 *-----------------------------------------------------------------------------------
 */
class ChatGroups {
	private $easeapi;
	//构造函数
	public function __construct($easeapi) {
		$this->easeapi = $easeapi;
	}
	//获取所有的群组
	public function getAllGroup() {
		return $this->easeapi->curl('/chatgroups', null, "GET");
	}
	//获取群组详情
	public function getGroupDetail($group_id) {
		if (is_array($group_id)) {
			foreach ($group_id as $value) {
				$group_id = $group_id.','.$value;
			}
			$group_id = substr($group_id, 6);
		}
		return $this->easeapi->curl('/chatgroups/'.$group_id, null, "GET");
	}
	//创建群组
	public function createGroup($groupname, $desc, $public, $owner, $maxusers = 200, $approval = false, $members = null) {
		$params = array(
			'groupname' => $groupname,
			'desc' => $desc,
			'public' => $public,
			'owner' => $owner,
			'maxusers' => $maxusers,
			'approval' => $approval,
			'members'  => $members
			);
		return $this->easeapi->curl('/chatgroups', null);
	}
	//修改群组信息
	public function modifyGroup($group_id, $groupname, $description, $maxusers) {
		$params = array(
			'groupname' 	=> $groupname,
			'description'	=> $description,
			'maxusers'		=> $maxusers
			);
		return $this->easeapi->curl('/chatgroups/'.$group_id, $params, "PUT");
	}
	//删除群组
	public function deleteGroup($group_id) {
		return $this->easeapi->curl('/chatgroups/'.$group_id, null, "DELETE");
	}
	//获取群组成员
	public function getGroupMember($group_id) {
		return $this->easeapi->curl('/chatgroups/'.$group_id."/users", null, "GET");
	}
	//群组加人【单个】
	public function addGroupOne($group_id, $username) {
		return $this->easeapi->curl('/chatgroups/'.$group_id."/users/".$username, null);
	}
	//群组加人【批量】
	public function addGroupSome($group_id, $users) {
		$params = array(
			'usernames' => $users, //$users is array $users为用户数组
			);
		return $this->easeapi->curl('/chatgroups/'.$group_id."/users", null);
	}
	//群组减人
	public function deleteGroupMember($group_id, $username) {
		return $this->easeapi->curl('/chatgroups/'.$group_id."/users/".$username, null, "DELETE");
	}
	//用户参与的所有群组 此方法我觉得应该放到Users.class.php里面
	public function getUserGroups($username) {
		return $this->easeapi->curl('/users/'.$username."/joined_chatgroups", null, "GET");
	}
}
