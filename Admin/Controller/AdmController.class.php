<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 管理员制器
 */

class AdmController extends CommonController{

	//管理员管理
	function index(){
		$data  = D('Adm');
		
		$list  = $data->sel(null,15,'a.*,g.title','a.uid');

		$this->assign('pgnum',$list['num']);
		$this->assign('list',$list['list']);
		$this->assign('page',$list['page']);
		$this->display();
	}

	//添加管理员
	function addAdm(){
		$groD = M('Auth_group');

		if(IS_POST){
			$data   = M('Adm');
			$gaData = M('Auth_group_access');

			$state  = I('state')==1 ? 1 : 0 ; 

			$arr    = array(
				'gro'   => I('gro'),
				'state' => $state,
				'sex'   => I('sex'),
				'uname' => I('uname'),
				'pwd'   => md5(I('pwd')),
				'name'  => I('name'),
				'tel'   => I('tel'),
				'qq'    => I('qq'),
				'email' => I('email'),
				);

			empty($arr['gro']) && $this->ajaxReturn('请选择角色');
			
			$uid = $data->add($arr);

			

			if($uid){

				$gaArr = array(
					'uid' 	   => $uid,
					'group_id' => $arr['gro'],
					);
				$gaData->add($gaArr);
				$this->ajaxReturn('succeed');
			}
			$this->ajaxReturn('error');
		}

		//角色列表
		$gls = $groD->select();

		$this->assign('gls',$gls);
		$this->display();
	}

	//修改管理员
	function editAdm(){
		$aData = M('Adm');
		$groD  = M('Auth_group');
		$uid   = I('uid');

		if(IS_POST){

			$state = I('state') == 1 ? 1 : 0 ; 
			$pwd   = I('pwd');
			$uid   = I('uid');

			empty($uid) && $this->ajaxReturn('关键值不能为空');

			$arr    = array(
				'gro'   => I('gro'),
				'state' => $state,
				'sex'   => I('sex'),
				'uname' => I('uname'),
				'name'  => I('name'),
				'tel'   => I('tel'),
				'qq'    => I('qq'),
				'email' => I('email'),
				);

			if($pwd != '123456789'){	$arr['pwd'] = md5($pwd);	}

			if($aData->where('uid='.$uid)->edit($arr)){
				$this->ajaxReturn('succeed');
			}
			$this->ajaxReturn('error');
		}

		//信息
		$info = $aData->where('uid='.$uid)->find();

		//角色列表
		$gls = $groD->select();

		$this->assign('gls',$gls);
		$this->assign('info',$info);
		$this->display();
	}

	//禁用/启用管理员
	function eidtSta(){
		$uid   = I('uid');
		$aData = M('Adm');

		$state = $aData->field('state')->where('uid = '.$uid)->find();

		$state = $state['state'] == 1 ? 0 : 1 ;

		if($aData->where('uid = '.$uid)->edit(array('state'=>$state))){
			$this->ajaxReturn('succeed');
		}
		$this->ajaxReturn('error');
	}

	//删除管理员
	function delAdm(){
		if(IS_POST){
			$aData = M('Adm');
			$uid   = I('uid');

			if($aData->where('uid='.$uid)->delete()){
				$this->ajaxReturn('succeed');
			}
			$this->ajaxReturn('error');
		}
	}

	//批量删除管理员
	function delAdms(){
		if(IS_POST){
			$aData =  M('Adm');
			$idArr =  I('uid');

			is_array($idArr) || $this->ajaxReturn('请选择删除项');

			//开启事物
			$aData->startTrans();
			foreach ($idArr as $k => $v) {
				
				if(!$aData->where("uid=".$v)->delete()){

					//回滚事物
					$aData->rollback();
					$this->ajaxReturn('error');
				}
			}

			//提交事物
			$aData->commit();
			$this->ajaxReturn('succeed');
		}
	}
}