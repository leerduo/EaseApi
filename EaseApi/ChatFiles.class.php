<?php
/**
 * 文件上传下载
 * @author shiming<siminily@gmail.com>
 * @date 2015-05-23
 */

class ChatFiles {
	private $easeapi;
	//构造函数
	public function __construct($easeapi) {
		$this->easeapi = $easeapi;
	}
	//上传文件
	public function upload($params) {
		return $this->curl('/chatfiles', $params, array('restrict-access' => true));
	}
	//下载文件
	public function download($share_secret, $uuid) {
		return $this->curl('/chatfiles/'.$uuid, null, array('share_secret' => $share_secret, 'Accept' => 'application/octet-stream'));
	}
	//下载缩率图
	public function thumbnail($share_secret, $uuid) {
		return $this->curl('/chatfiles/'.$uuid, null, array('thumbnail' => true, 'share_secret' => $share_secret, 'Accept' => 'application/octet-stream'));
	}
	public function image() {
		return $this->curl('/chatfiles/'.$uuid, null, array('share_secret' => $share_secret, 'Accept' => 'application/octet-stream'));
	}
	public function curl($action, $params, $header = array(), $type = 'POST') {
		array_push($header, "Authorization:Bearer ".$this->easeapi->getToken());
		$curl_session = curl_init();
		curl_setopt($curl_session, CURLOPT_URL, $this->app_url.$action);
		curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl_session, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl_session, CURLOPT_USERAGENT, 'Avcall Server');
		curl_setopt($curl_session, CURLOPT_ENCODING, 'gzip');
		if(!empty($params)){
			$param = json_encode($params);
			curl_setopt($curl_session, CURLOPT_POSTFIELDS, $param);
		}
		curl_setopt ($curl_session, CURLOPT_TIMEOUT, 30);
		curl_setopt ($curl_session, CURLOPT_HTTPHEADER, $header);
		curl_setopt ($curl_session, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($curl_session, CURLOPT_CUSTOMREQUEST, $type);
		$result = curl_exec ($curl_session);
		curl_close($curl_session);
		return $result;
	}
}
