<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 权限控制器
 */

class AuthController extends CommonController{

	//权限列表
	function auth(){
		$data  = D('Auth_rule');
		
		$field = '*,concat(pid,",",id) as path';
		$order = 'path,id';
		
		$list  = $data->sel(null,15,$field,$order);

		$this->assign('pgnum',$list['num']);
		$this->assign('list',$list['list']);
		$this->assign('page',$list['page']);
		$this->display();
	}

	//添加权限
	function addAuth(){
		$rData = D('Auth_rule');
		$id    = I('id');

		if(IS_POST){

			$ajax  = I('ajax') ? 1 : 0 ;
			$menu  = I('menu') ? 1 : 0 ;

			//处理 上级ID
			$fStr  = I('fid');
			$fArr  = explode(',', $fStr);
			$fid   = end($fArr);

			$arr   = array(
				'name'  => I('name'),	//标示
				'url'   => I('url'),	//url
				'title' => I('title'),	//标题
				'fid'   => $fid,		//上级ID
				'pid'   => $fStr,		//排序规则
				'icon'  => I('icon'),	//图标
				'sort'  => I('sort'),	//排序
				'ajax'  => $ajax,		//是否 ajax
				'menu'  => $menu,    	//是否为目录
				);

			if($rData->add($arr)){
				$this->ajaxReturn('succeed');
			}
			$this->ajaxReturn('error');
		}

		$field = '*,concat(pid,",",id) as path';
		$order = 'path,id';

		//上级权限
		$cls = $rData->selA(null,$field,$order);

		$this->assign('id',$id);
		$this->assign('cls',$cls);
		$this->display();
	}

	//修改权限
	function editAuth(){
		$rData =  D('Auth_rule');
		$id    =  I('id');

		if(IS_POST){
			$id   =  I('id');
			$icon =  I('icon');

			$ajax  = I('ajax') ? 1 : 0 ;
			$menu  = I('menu') ? 1 : 0 ;

			//处理 上级ID
			$fStr  = I('fid');
			$fArr  = explode(',', $fStr);
			$fid   = end($fArr);

			$arr   = array(
				'name'  => I('name'),	//标示
				'url'   => I('url'),	//url
				'title' => I('title'),	//标题
				'fid'   => $fid,		//上级ID
				'pid'   => $fStr,		//排序规则
				'sort'  => I('sort'),	//排序
				'ajax'  => $ajax,		//是否 ajax
				'menu'  => $menu,    	//是否为目录
				);

			$icon && $arr['icon'] = $icon;	//图标

			if($rData->where('id='.$id)->edit($arr)){
				$this->ajaxReturn('succeed');
			}
			$this->ajaxReturn('error');
		}

		//信息
		$info = $rData->where('id='.$id)->find();

		//上级权限
		$field = '*,concat(pid,",",id) as path';
		$order = 'path,id';
		$cls = $rData->selA(null,$field,$order);

		$this->assign('info',$info);
		$this->assign('cls',$cls);
		$this->display();
	}

	//删除权限
	function delAuth(){
		if(IS_POST){
			$rData =  M('Auth_rule');
			$id    =  I('id');

			//开启事物
			$rData->startTrans();
			if(!$rData->where("id=".$id)->delete()){

				//回滚事物
				$rData->rollback();
				$this->ajaxReturn('error');
			}
			// FIND_IN_SET("'.$sub.'",b.sub)
			if($rData->where('FIND_IN_SET('.$id.',pid)')->select()){
				if(!$rData->where('FIND_IN_SET('.$id.',pid)')->delete()){
					//回滚事物
					$rData->rollback();
					$this->ajaxReturn('error');
				}
			}

			//提交事物
			$rData->commit();
			$this->ajaxReturn('succeed');
		}
	}

	//批量删除权限
	function delAuths(){

		if(IS_POST){
			$rData =  M('Auth_rule');
			$idArr =  I('id');

			is_array($idArr) || $this->ajaxReturn('请选择删除项');

			//开启事物
			$rData->startTrans();
			foreach ($idArr as $k => $v) {
				
				if(!$rData->where("id=".$v)->delete()){

					//回滚事物
					$rData->rollback();
					$this->ajaxReturn('error');
				}

				if($rData->where('FIND_IN_SET('.$v.',pid)')->select()){
					if(!$rData->where('FIND_IN_SET('.$v.',pid)')->delete()){
						//回滚事物
						$rData->rollback();
						$this->ajaxReturn('error');
					}
				}
			}

			//提交事物
			$rData->commit();
			$this->ajaxReturn('succeed');
		}
	}

	//权限分组
	function group(){
		$data  = D('AuthGroup');
		
		$field = '*';
		$order = 'id';
		
		$list  = $data->sel(null,15,$field,$order);

		$this->assign('pgnum',$list['num']);
		$this->assign('list',$list['list']);
		$this->assign('page',$list['page']);
		$this->display();
	}

	//添加分组
	function addGro(){

		if(IS_POST){
			$data  = M('Auth_group');

			$arr = array(
				'title' => I('title'),
				'descr' => I('descr'),
				);

			if($data->add($arr)){
				$this->ajaxReturn('succeed');
			}
			$this->ajaxReturn('error');
		}

		$this->display();
	}

	//修改角色
	function editGro(){
		$aData =  D('AuthGroup');
		$id    =  I('id');

		if(IS_POST){
			$id   =  I('id');

			$arr = array(
				'title' => I('title'),
				'descr' => I('descr'),
				);

			if($aData->where('id='.$id)->edit($arr)){
				$this->ajaxReturn('succeed');
			}
			$this->ajaxReturn('error');
		}

		//信息
		$info = $aData->where('id='.$id)->find();

		$this->assign('info',$info);
		$this->display();
	}

	//删除权限
	function delGro(){
		if(IS_POST){
			$aData = D('AuthGroup');
			$id    = I('id');

			if($aData->where('id='.$id)->delete()){
				$this->ajaxReturn('succeed');
			}
			$this->ajaxReturn('error');
		}
	}

	//批量删除权限
	function delGros(){
		if(IS_POST){
			$aData =  M('Auth_group');
			$idArr =  I('id');

			is_array($idArr) || $this->ajaxReturn('请选择删除项');

			//开启事物
			$aData->startTrans();
			foreach ($idArr as $k => $v) {
				
				if(!$aData->where("id=".$v)->delete()){

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

	//设置权限
	function setAuth(){
		$rData = D('Auth_rule');
		$gData = D('AuthGroup');
		$id    = I('id');

		if(IS_POST){
			$id    = I('id');
			$aStr  = implode(',', I('auth'));

			if($gData->where('id='.$id)->edit(array('rules'=>$aStr))){
				$this->ajaxReturn('succeed');
			}
			$this->ajaxReturn('error');
		}

		$field = '*,concat(pid,",",id) as path';
		$order = 'path,id';

		//上级权限
		$list  = $rData->selA('menu=1',$field,$order);
		$info  = $gData->field('rules,title')->where('id='.$id)->find();

		$this->assign('id',$id);
		$this->assign('list',$list);
		$this->assign('title',$info['title']);
		$this->assign('rules',$info['rules']);
		$this->display();
	}
}