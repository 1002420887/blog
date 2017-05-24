<?php
namespace Admin\Controller;
use Think\Controller;
header("Content-Type: text/html;charset=utf-8");
class IndexController extends CommonController{

	//模板公共
	function index(){
		
		$this->display();
	}

	//上传文件
	function upfile(){

		$obj = new Upload('files',__ROOT__.'/');

		P($obj->upload());
	}

	//首页
	function my(){
		$aData = M('Adm');
		$info   = $aData->where('uid='.$this->uid)->find();
		$host   = $_SERVER['HTTP_HOST'];
		$pcname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		$ip     = gethostbyname($_SERVER['SERVER_NAME']);
		$port   = $_SERVER["SERVER_PORT"];
		$ctime  = ini_get("max_execution_time");
		$sdir   = $_SERVER['DOCUMENT_ROOT'];
		$time   = date('Y-m-d H:i:s',time());
		$ven    = phpversion();
		$dir    = __FILE__;
		$os     = PHP_OS;

		$this->assign('ip',$ip);
		$this->assign('os',$os);
		$this->assign('ven',$ven);
		$this->assign('dir',$dir);
		$this->assign('port',$port);
		$this->assign('sdir',$sdir);
		$this->assign('time',$time);
		$this->assign('ctime',$ctime);
		$this->assign('pcname',$pcname);
		$this->assign('info',$info);
		$this->assign('host',$host);
		$this->display();
	}

	function phpInfo(){
		phpInfo();
	}

	//test
	function test(){

		$this->display();
	}
}