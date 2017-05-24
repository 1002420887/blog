<?php
namespace Admin\Model;
use Think\Model;
/**
 * 权限 模型表
 */

class Auth_ruleModel extends Model{
	
	//分页查询
	function sel($where,$pages,$field,$order){

		$num  = $this->where($where)->count();
		$page = new Page($num,$pages);
		$list = $this
				->field($field)
				->limit($page->firstR().','.$page->larstR())
				->where($where)
				->order($order)
				->select();

		//权限缩进
		foreach ($list as $k => $v) {
			$list[$k]['nbsp'] = str_repeat("&nbsp; &nbsp; &nbsp; &nbsp;",count(explode(',', $v['pid']))-1);
		}

		return array('list'=>$list,'page'=>$page->show(),'num'=>$page->num());
	}

	//全部查询
	function selA($where,$field,$order){
		
		$list = $this->field($field)->where($where)->order($order)->select();

		//权限缩进
		foreach ($list as $k => $v) {
			$list[$k]['nbsp'] = str_repeat("&nbsp; &nbsp; &nbsp; &nbsp;",count(explode(',', $v['pid']))-1);
		}

		return $list;
	}
}