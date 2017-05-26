<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller{

	function index(){
		$uid = session(C('WEB_SESSION'))['uid'];

		$data  = D('Blog');
		$cData = D('User_cla');

		$cid   = I('cid');

		//数据列表
		// $where = 'del = 0';
		$where .= $uid  ? ' and b.uid = '.$uid : '';
		$where .= $cid  ? ' and FIND_IN_SET('.$cid.',b.pid)' : '' ;
		
		$field = 'b.*,c.name';
		$order = 'b.id desc';

		$list  = $data->sel($where,15,$field,$order);
		
		$this->assign('cid',$cid);
		$this->assign('uid',$uid);
		$this->assign('list',$list['list']);
		$this->assign('page',$list['page']);
		$this->display();
	}

	public function index1(){
		$uid = session(C('WEB_SESSION'))['uid'];

		$data  = D('Blog');
		$cData = D('User_cla');

		$cid   = I('cid');

		//数据列表
		// $where = 'del = 0';
		$where .= $uid  ? ' and b.uid = '.$uid : '';
		$where .= $cid  ? ' and FIND_IN_SET('.$cid.',b.pid)' : '' ;
		
		$field = 'b.*,c.name';
		$order = 'b.id desc';

		$list  = $data->sel($where,15,$field,$order);
		
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