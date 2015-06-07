<?php
/**
 * 发送消息
 * @author shiming<siminily@gmail.com>
 * @date 2015-05-23
 */

class Messages {
	private $easeapi;
	//构造函数
	public function __construct($easeapi) {
		$this->easeapi = $easeapi;
	}
	//发送文本消息
	public function sendTxtMsg($target_type = 'users', $target, $msg_type = 'txt', $msg_msg) {

	}
	//发送图片消息
	public function sendImgMsg($target_type = 'users', $target, $msg_type = 'img', $msg_msg) {
		
	}
	//发送语音消息
	public function sendAudioMsg($target_type = 'users', $target, $msg_type = 'audio', $msg_msg) {
		
	}
	//发送视频消息
	public function sendVideoMsg($target_type = 'users', $target, $msg_type = 'video', $msg_msg) {
		
	}
	//发送透传消息
	public function sendCmdMsg($target_type = 'users', $target, $msg_type = 'cmd', $msg_msg) {
		
	}
}

