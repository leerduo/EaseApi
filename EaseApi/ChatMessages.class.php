<?php
/**
 * 导出聊天记录
 * @author shiming<siminily@gmail.com>
 * @date 2015-05-23
 */

class ChatMessages {
	private $easeapi;
	//构造函数
	public function __construct($easeapi) {
		$this->easeapi = $easeapi;
	}
	//导出聊天记录
	public function export_chat_record($username, $sql = '') {
		$sql = "SELECT * WHERE timestamp>strtotime('-7 days')";
		return $this->easeapi->curl('/chatmessages', null, "GET");
	}
}
