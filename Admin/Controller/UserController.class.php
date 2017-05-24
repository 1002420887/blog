<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 用户制器
 */

class UserController extends CommonController{

	//用户列表
	function index(){
		$data  = D('User');
		
		$list  = $data->sel(null,15,'*','uid desc');

		$this->assign('pgnum',$list['num']);
		$this->assign('list',$list['list']);
		$this->assign('page',$list['page']);
		$this->display();
	}

	//添加用户
	function addUser(){

		if(IS_POST){
			$data   = M('User');

			$state  = I('state')==1 ? 1 : 0 ; 

			$arr    = array(
				'state' => $state,
				'sex'   => I('sex'),
				'uname' => I('uname'),
				'pwd'   => md5(I('pwd')),
				'name'  => I('name'),
				'tel'   => I('tel'),
				'qq'    => I('qq'),
				'email' => I('email'),
				);

			if($data->add($arr)){
				$this->ajaxReturn('succeed');
			}
			$this->ajaxReturn('error');
		}

		$this->display();
	}

	//修改用户
	function editUser(){
		$uData = M('User');
		$uid   = I('uid');

		if(IS_POST){

			$state = I('state') == 1 ? 1 : 0 ; 
			$pwd   = I('pwd');
			$uid   = I('uid');

			empty($uid) && $this->ajaxReturn('关键值不能为空');

			$arr    = array(
				'state' => $state,
				'sex'   => I('sex'),
				'uname' => I('uname'),
				'name'  => I('name'),
				'tel'   => I('tel'),
				'qq'    => I('qq'),
				'email' => I('email'),
				);

			if($pwd != '123456789'){	$arr['pwd'] = md5($pwd);	}

			if($uData->where('uid='.$uid)->edit($arr)){
				$this->ajaxReturn('succeed');
			}
			$this->ajaxReturn('error');
		}

		//信息
		$info = $uData->where('uid='.$uid)->find();

		$this->assign('info',$info);
		$this->display();
	}

	//禁用/启用用户
	function eidtSta(){
		$uid   = I('uid');
		$uData = M('User');

		$state = $uData->field('state')->where('uid = '.$uid)->find();

		$state = $state['state'] == 1 ? 0 : 1 ;

		if($uData->where('uid = '.$uid)->edit(array('state'=>$state))){
			$this->ajaxReturn('succeed');
		}
		$this->ajaxReturn('error');
	}

	//删除用户
	function delUser(){
		if(IS_POST){
			$uData = M('User');
			$uid   = I('uid');

			if($uData->where('uid='.$uid)->delete()){
				$this->ajaxReturn('succeed');
			}
			$this->ajaxReturn('error');
		}
	}

	//批量删除用户
	function delUsers(){
		if(IS_POST){
			$uData =  M('User');
			$idArr =  I('uid');

			is_array($idArr) || $this->ajaxReturn('请选择删除项');

			//开启事物
			$uData->startTrans();
			foreach ($idArr as $k => $v) {
				
				if(!$uData->where("uid=".$v)->delete()){

					//回滚事物
					$uData->rollback();
					$this->ajaxReturn('error');
				}
			}

			//提交事物
			$uData->commit();
			$this->ajaxReturn('succeed');
		}
	}
}