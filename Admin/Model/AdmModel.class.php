<?php
namespace Admin\Model;
use Think\Model;
/**
 * 管理员 模型表
 */

class AdmModel extends Model{
	
	//权限分组表
	function sel($where,$pages,$field,$order){

		$num  = $this->where($where)->count();
		$page = new Page($num,$pages);
		$list = $this
				->field($field)
				->alias("a")
				->field($field)
				->join("LEFT JOIN __AUTH_GROUP_ACCESS__ ag ON a.uid=ag.uid")
				->join("LEFT JOIN __AUTH_GROUP__ g ON ag.group_id=g.id")
				->limit($page->firstR().','.$page->larstR())
				->where($where)
				->order($order)
				->select();

		return array('list'=>$list,'page'=>$page->show(),'num'=>$page->num());
	}

	/**
	 * [fin 单条连表查询]
	 * @param  [type] $where [条件]
	 * @param  [type] $field [字段]
	 * @return [type]        [description]
	 */
	function fin($where,$field){
		return $this
				->field($field)
				->alias("a")
				->field($field)
				->join("LEFT JOIN __AUTH_GROUP_ACCESS__ ag ON a.uid=ag.uid")
				->join("LEFT JOIN __AUTH_GROUP__ g ON ag.group_id=g.id")
				->where($where)
				->find();
	}
}