<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 登录页
 */

class LoginController extends Controller{

	//登录
	function index(){
		
		if(IS_POST){
			$data  = M('Adm');
			$uname = I('uname');
			$pwd   = md5(I('pwd'));

			if($info = $data->where('uname="'.$uname.'" and pwd="'.$pwd.'"')->find()){

				//存入session
				$arr = array(
					'uid'   => $info['uid'],
					'uname' => $info['uname'],
					);
				session(C('WEB_SESSION'),$arr);

				//更新状态
				$loginArr = array(
					'this_login' => time(),
					'last_login' => $info['this_login'],
					'this_ip'    => $_SERVER['REMOTE_ADDR'],
					'last_ip'    => $info['this_ip'],
					);
				$data->where('uid='.$info['uid'])->edit($loginArr);
				$data->where('uid='.$info['uid'])->setInc('num');

				$this->ajaxReturn('succeed');
			}
			$this->ajaxReturn('error');
		}

		$this->display();
	}

	//退出登录
	function loginOut(){
		session(C('WEB_SESSION'),null);
	}
}