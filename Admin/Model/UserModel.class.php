<?php
namespace Admin\Model;
use Think\Model;
/**
 * 会员 模型表
 */

class UserModel extends Model{
	
	//会员表
	function sel($where,$pages,$field,$order){

		$num  = $this->where($where)->count();
		$page = new Page($num,$pages);
		$list = $this
				->field($field)
				->field($field)
				->limit($page->firstR().','.$page->larstR())
				->where($where)
				->order($order)
				->select();

		return array('list'=>$list,'page'=>$page->show(),'num'=>$page->num());
	}
}