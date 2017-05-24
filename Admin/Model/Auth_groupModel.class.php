<?php
namespace Admin\Model;
use Think\Model;
/**
 * 权限 模型表
 */

class Auth_groupModel extends Model{
	
	//权限分组表
	function sel($where,$pages,$field,$order){

		$num  = $this->where($where)->count();
		$page = new Page($num,$pages);
		$list = $this
				->field($field)
				->limit($page->firstR().','.$page->larstR())
				->where($where)
				->order($order)
				->select();

		return array('list'=>$list,'page'=>$page->show(),'num'=>$page->num());
	}
}