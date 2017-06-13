<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 程序列表
 */
class ProgramController extends Controller{
	/**
	 * [pamList 程序所有列表]
	 * @return [type] [description]
	 */
	public function pamList(){
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
		// var_dump($list['page']);
		$this->assign('cid',$cid);
		$this->assign('uid',$uid);
		$this->assign('list',$list['list']);
		$this->assign('page',$list['page']);		
		$this->display();
	}

	public function pamInfo(){
		if(I('get.pm')){
			$id=I('get.pm');
			$where['b.id']=array('eq',$id);
			$info = M('blog')
				->field("b.*,c.name")
				->alias("b")
				->join("LEFT JOIN __USER__ u ON b.uid=u.uid")
				->join("LEFT JOIN __USER_CLA__ c ON b.fid=c.id")
				->where($where)
				->find();
			$this->assign('info',$info);
			$this->display();
		}
		
	}


}