<?php
namespace Home\Model;
use Think\Model;
/**
 * 博客 模型表
 */

class BlogModel extends Model{
	//分页查询
	function sel($where,$pages,$field,$order){

		$num  = $this
		->where($where)
		->alias("b")
		->join("LEFT JOIN __USER__ u ON b.uid=u.uid")
		->join("LEFT JOIN __USER_CLA__ c ON b.fid=c.id")
		->count();

		$page = new \Think\Page($num,$pages);
		$list = $this
				->field($field)
				->alias("b")
				->join("LEFT JOIN __USER__ u ON b.uid=u.uid")
				->join("LEFT JOIN __USER_CLA__ c ON b.fid=c.id")
				->limit("{$page->firstRow},{$page->listRows}")
				->where($where)
				->order($order)
				->select();

		return array('list'=>$list,'page'=>$page->show(),'num'=>$page->show());
	}
}