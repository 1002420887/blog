<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller{

	function index(){
		$uid = (int)session("bkHmUser.uid");
		// var_dump($uid);
		$data  = D('Blog');
		$cData = D('User_cla');

		$cid   = I('cid');
		// $where['uid']=array('eq',$uid);
		//数据列表
		// $where = 'del = 0';
		$where= $uid  ? 'b.uid = '.$uid : '';
		// $where['b.uid']=array('eq',$uid);
		$where .= $cid  ? ' and FIND_IN_SET('.$cid.',b.pid)' : '' ;
		
		$field = 'b.*,c.name';
		$order = 'b.id desc';
		$list  = $data->sel($where,15,$field,$order);
		// var_dump($list);
		$this->assign('cid',$cid);
		$this->assign('uid',$uid);
		$this->assign('list',$list['list']);
		$this->assign('page',$list['page']);
		$this->display();
	}

	public function index1(){
		$uid = (int)session("bkHmUser.uid");
		// var_dump($uid);
		$data  = D('Blog');
		$cData = D('User_cla');

		$cid   = I('cid');
		// $where['uid']=array('eq',$uid);
		//数据列表
		// $where = 'del = 0';
		$where= $uid  ? 'b.uid = '.$uid : '';
		// $where['b.uid']=array('eq',$uid);
		$where .= $cid  ? ' and FIND_IN_SET('.$cid.',b.pid)' : '' ;
		
		$field = 'b.*,c.name';
		$order = 'b.id desc';
		$list  = $data->sel($where,15,$field,$order);
		// var_dump($list);
		$this->assign('cid',$cid);
		$this->assign('uid',$uid);
		$this->assign('list',$list['list']);
		$this->assign('page',$list['page']);
		$this->display();		
	}

	// //内容显示页
	// function cont(){
	// 	$data = M('blog');
	// 	$id   = I('id');

	// 	$info = $data->where('id='.$id)->find();
	// 	$info['content'] = html_entity_decode($info['content']);

	// 	$this->assign('info',$info);
	// 	$this->display();
	// }

	// function test(){

	// 	$this->display();
	// }
}