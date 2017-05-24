<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 登录页
 */
class LoginController extends Controller{

	//登陆
	function login(){

		if(IS_POST){
			$uData = M('user');

			$arr = array(
				'uname' => I('uname'),
				'pwd'   => md5(I('pwd')),
				);

			empty($arr['uname']) && $this->ajaxReturn('请输入用户名');
			empty($arr['pwd'])      && $this->ajaxReturn('请输入密码');

			if($info = $uData->where('uname = "'.$arr['uname'].'" and pwd = "'.$arr['pwd'].'"')->find()){

				$sessionArr['uid']   = $info['uid'];
				$sessionArr['user']  = $info['uname'];
				$sessionArr['pname'] = $info['pname'];
				session(C('WEB_SESSION'),$sessionArr);
				$IP                  = $_SERVER['REMOTE_ADDR'];
				$date                = date('Y-m-d H:i:s',time());
				$last_loginData      = $uData->field('this_login')->where('uid = '.$info['uid'])->find();
				$arr['last_login']   = $last_loginData['this_login'];
				$arr['last_ip']      = $IP;
				$arr['this_login']   = $date;
				//更新管理员信息
				$uData->where('uid = '.$info['uid'])->setField($arr);
		
				$this->ajaxReturn('succeed');
			}else{
				$this->ajaxReturn('账号或密码错误');
			}
		}
		
		$this->display();
	}

	// //QQ登陆
	// function qqlogin(){
 //    	$qqobj  = new QQLogin();
	// 	$result = $qqobj->getUsrOpenid();
	// 	$openid = $result['openid'];

	// 	if($openid){
	// 		$uData = M('user');
	// 		$info  = $uData->where('qqopenid="'.$openid.'"')->find();
			
	// 		//未找到，新用户 注册
	// 		if(!$info){
	// 			$uInfo = json_decode($qqobj->getUsrInfo(),true);

	// 			$imgurl = empty($uInfo['figureurl_qq_2']) ? $uInfo['figureurl_qq_1'] : $uInfo['figureurl_qq_2'] ;

	// 			$arr   = array(
	// 					'pname'    => $uInfo['nickname'],
	// 					'sex'      => $uInfo['gender'],
	// 					'birth'    => $uInfo['year'],
	// 					'imgurl'   => $imgurl,
	// 					'city'     => $uInfo['city'],
	// 					'province' => $uInfo['province'],
	// 					'qqopenid' => $openid,
	// 				);
				
	// 			if(!$uData->add($arr)){
	// 				$this->ajaxReturn('登陆失败');
	// 			}
	// 			$info = $uData->where('qqopenid="'.$openid.'"')->find();
	// 		}

	// 		$sessionArr['uid']   = $info['uid'];
	// 		$sessionArr['user']  = $info['uname'];
	// 		$sessionArr['pname'] = $info['pname'];
	// 		session(C('WEB_SESSION'),$sessionArr);
	// 		$IP                  = $_SERVER['REMOTE_ADDR'];
	// 		$date                = date('Y-m-d H:i:s',time());
	// 		$last_loginData      = $uData->field('this_login')->where('uid = '.$info['uid'])->find();
	// 		$arr['last_login']   = $last_loginData['this_login'];
	// 		$arr['last_ip']      = $IP;
	// 		$arr['this_login']   = $date;
	// 		//更新用户信息
	// 		$uData->where('uid = '.$info['uid'])->setField($arr);

	// 		GO(U('Index/index'));		
	// 	}
	// }

	// //调用QQ登陆
	// function QLogin(){
	// 	$qqobj = new QQLogin();
	// 	$qqobj->getAuthCode();
	// }

	// //注册
	// function reg(){

	// 	if(IS_POST){
	// 		$uData = M('user');
	// 		$sData = M('send');

	// 		$mobile = I('uname');
	// 		$pwd    = I('pwd');
	// 		$pwd1   = I('pwd1');
	// 		$code   = I('code');

	// 		preg_match("/^1[34578]\d{9}$/", $mobile) || $this->ajaxReturn('号码不对');

	// 		$pwd == $pwd1    || $this->ajaxReturn('两次输入密码不一样');

	// 		if(strlen($pwd) < 5){
	// 			$this->ajaxReturn('密码太简单');
	// 		}

	// 		if($uData->where('mobile = '.$mobile)->find()){
	// 			$this->ajaxReturn('手机号已经被注册');
	// 		}

	// 		$re = $sData->field('time')->where('mobile = '.$mobile.' and code = '.$code)->find();
	// 		if($re && time()-$re['time'] < 1800){

	// 			$arr = array(
	// 				'uname' => $mobile,
	// 				'tel'   => $mobile,
	// 				'pwd'	=> md5($pwd),
	// 				);

	// 			if($uData->add($arr)){
	// 				$this->ajaxReturn('succeed');
	// 			}
	// 			$this->ajaxReturn('注册失败');
	// 		}
	// 		$this->ajaxReturn('验证码错误');
	// 	}
	// 	$this->display();
	// }

	// //发送验证码
	// function send(){
	// 	$uData  = M('user');
	// 	$sData  = M('send');
	// 	$mobile = I('mobile');
	// 	$edit   = I('edit');

	// 	preg_match("/^1[34578]\d{9}$/", $mobile) || $this->ajaxReturn('号码不对');

	// 	if($edit != 1){
	// 		if($uData->where('mobile = '.$mobile)->find()){
	// 			$this->ajaxReturn('此号已经被注册');
	// 		}
	// 	}

	// 	$code   = $this->code();
	// 	$re     = send($mobile,$code);

	// 	$arr = array(
	// 		'time'   => time(),
	// 		'code'   => $code,
	// 		'mobile' => $mobile,
	// 		);

	// 	if($sData->where('mobile = '.$mobile)->find()){
	// 		$sData->where('mobile = '.$mobile)->setField($arr);
	// 	}else{
	// 		$sData->add($arr);
	// 	}

	// 	$this->ajaxReturn($re);
	// }

	// //生成验证码
	// function code(){
	// 	return mt_rand(1,9).mt_rand(1,9).mt_rand(1,9).mt_rand(1,9);
	// }

	// // 退出
	// public function loginOut(){
	// 	session(C('WEB_SESSION'),null);
	// 	echo 'success';
	// }
}