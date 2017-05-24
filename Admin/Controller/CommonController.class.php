<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 目录控制
 */

class CommonController extends Controller{

	protected $uid = null;

	//构造函数
	public function __construct(){
		//首先调用 父级 __construct
		parent::__construct();
		if(!session(C('WEB_SESSION'))){
			$this->redirect('Login/index');
		}

		//uid
		$this->uid = session(C('WEB_SESSION'))['uid'];

		//权限认证
		if(C('AUTH')){
			$are    = M('Auth_rule')->field('id')->where('name="'.CONTROLLER.'/'.ACTION.'"')->find();
			$aWhere = 'a.uid='.$this->uid.' and FIND_IN_SET('.$are['id'].',g.rules)';
			$aAdm   = D('Adm')->fin($aWhere,'*');
			$aAdm || die('您没有权限');
		}
	}

	//设置目录
	function menu(){

		$this->assign('str',8888);
		$this->display(C('__MODPUBLIC_').'/menu.html',true);
	}
}