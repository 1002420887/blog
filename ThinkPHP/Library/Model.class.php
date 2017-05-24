<?php

/**
 * 封装 核心模型类
 */

class Model{

	static   $link  = null;
	static   $sql 		;  
	private  $table = '';
	private  $arr 		;
	 
	/**
	 * [_link 数据库静态链接方法]
	 * @return [type] [description]
	 */
	public function __construct($table){
		$this->table = C('DB_FIX').$table;
		if(is_null(self::$link)){
			self::$link = new PDO(C('DB_TYPE').':host='.C('BD_HOST').';dbname='.C('DB_NAME'),C('DB_USER'),C('DB_PWD'));
			self::$link->exec("SET names ".C('DB_CHARSET'));
		}
		$this->_arr();
	}

	/**
	 * [_arr 条件空数组]
	 * @return [type] [description]
	 */
	private function _arr(){
		$this->arr = array(
			'field'  => '*',
			'where' => '',
			'order' => '',
			'limit' => '',
			'group' => '',
			'alias' => '',
			'join'  => '',
		);
	}

	/**
	 * [startTrans 启动事物，关闭自动提交]
	 * @return [type] [description]
	 */
	public function startTrans(){
		self::$link->beginTransaction();
	}

	/**
	 * [commit 提交一个事物]
	 * @return [type] [description]
	 */
	public function commit(){
		self::$link->commit();
	}

	/**
	 * [rollback 回滚一个事物]
	 * @return [type] [description]
	 */
	public function rollback(){
		self::$link->rollBack();
	}

	/**
	 * [query query方法]
	 * @param  [type] $sql [sql语句]
	 * @return [type]      [数组]
	 */
	public function query($sql,$count=null){
		self::$sql = $sql;
		$query = self::$link->query($sql);

		//为空处理
		if(empty($query)){return null;}

		//排除单条查询
		if(!is_null($count) && $count!='one'){
			return $query->fetchColumn();
		}

		//去掉index下标
		$query->setFetchMode(PDO::FETCH_ASSOC);

		$quArr = $query->fetchAll();

		//处理为空
		if($count == 'one'){
			$quArr = isset($quArr[0]) ? $quArr[0] : null ;
		}

		//重置 数组
		$this->_arr();
		//返回数据
		return $quArr;
	}

	/**
	 * [getSql 获取最后的SQL语句]
	 * @return [type] [description]
	 */
	public function getSql(){
		return self::$sql;
	}

	/**
	 * [field 字段链式操作]
	 * @param  [type] $field [字段]
	 * @return [type]       [this obj]
	 */
	public function field($field){

		$field = is_array($field) ? implode(',', $field) : $field ;

		$this->arr['field'] = $field;
		return $this;
	}

	/**
	 * [where 条件]
	 * @param  [type] $where [string]
	 * @return [type]        [this obj]
	 */
	public function where($where){
		$this->arr['where'] = $where;
		return $this;
	}

	/**
	 * [order 排序]
	 * @param  [type] $order [string]
	 * @return [type]        [this obj]
	 */
	public function order($order){
		$this->arr['order'] = $order;
		return $this;
	}

	/**
	 * [group 分组查询]
	 * @param  [type] $group [description]
	 * @return [type]        [description]
	 */
	public function group($group){
		$this->arr['group']  = $group;
		return $this;
	}

	/**
	 * [alias alias 配合join使用]
	 * @param  [type] $alias [description]
	 * @return [type]        [description]
	 */
	public function alias($alias){
		$this->arr['alias']  = $alias;
		return $this;
	}

	/**
	 * [join join查询]
	 * @param  [type] $join [description]
	 * @return [type]       [description]
	 */
	public function join($join){

		$join = preg_match("/__.*?__/i", $join ,$match) ? preg_replace('/__.*?__/i',C('DB_FIX').strstr(substr($match[0],2),'__',true),$join) : $join ;

		$this->arr['join']  .= ' '.$join;
		return $this;
	}

	/**
	 * [limit limit]
	 * @param  [type] $limit [description]
	 * @return [type]        [description]
	 */
	public function limit($limit){
		$this->arr['limit']  = $limit;
		return $this;
	}
	
	//聚合函数
	/**
	 * [count count方法]
	 * @return [type] [description]
	 */
	public function count(){
		return $this->select('count');
	}

	/**
	 * [avg avg方法 平均数 ]
	 * @return [type] [description]
	 */
	public function avg(){
		return $this->select('avg');
	}

	/**
	 * [min min方法 最小值]
	 * @return [type] [description]
	 */
	public function min(){
		return $this->select('min');
	}

	/**
	 * [max max方法 最大值]
	 * @return [type] [description]
	 */
	public function max(){
		return $this->select('max');
	}

	/**
	 * [max max方法 和]
	 * @return [type] [description]
	 */
	public function sum(){
		return $this->select('sum');
	}

	/**
	 * [max max方法 和]
	 * @return [type] [description]
	 */
	public function group_concat(){
		return $this->select('group_concat');
	}
	//聚合函数 end

	//单条查询
	public function find(){
		return $this->select('one');
	}

	/**
	 * [select select]
	 * @return [type] [description]
	 */
	public function select($count=null){

		//排除单条查询
		if($count!= 'one'){
			$field = is_null($count) ? $this->arr['field'] : $count.'('.$this->arr['field'].')' ;
		}else{
			$field = $this->arr['field'];
		}
		
		$where = empty($this->arr['where']) ? '' : ' where '.$this->arr['where'];
		$order = empty($this->arr['order']) ? '' : ' order by '.$this->arr['order'];
		$group = empty($this->arr['group']) ? '' : ' group by '.$this->arr['group'];
		$limit = empty($this->arr['limit']) ? '' : ' limit '.$this->arr['limit'];

		$sql = 'select '.$field.' from '.$this->table.' '.$this->arr['alias'].' '.$this->arr['join'].$where.$order.$limit.$group;

		if($count == 'group_concat'){
			$count = null;
		}

		//初始化join
		$this->arr['join'] = '';

		return $this->query($sql,$count);
	}

	/**
	 * [exec 执行操作]
	 * @return [type] [description]
	 */
	public function exec($sql){

		//重置 数组
		$this->_arr();
		return self::$link->exec($sql);
	}

	/**
	 * [add 添加]
	 * @param [type] $add [description]
	 */
	public function add($add){

		$field = '';
		$val   = '';
		foreach ($add as $k => $v) {
			$field .= ','.$k;
			$val   .= ',"'.$v.'"';
		}

		$sql = 'insert into '.$this->table.' ('.substr($field,1).') values('.substr($val,1).')';
		$this->exec($sql);
		return self::$link->lastInsertId();
	}

	/**
	 * [setInc 递增 $num]
	 * @param [type] $field [字段]
	 * @param [type] $num   [description]
	 */
	public function setInc($field,$num = null){

		$where = empty($this->arr['where']) ? '' : ' where '.$this->arr['where'];
		$num   = is_null($num) ? $field.'+1' : $field.'+'.$num ;

		$sql = 'update '.$this->table.' set '.$field.'='.$num.$where;
		return $this->exec($sql);
	}

	/**
	 * [setDec 递减 $num]
	 * @param [type] $field [字段]
	 * @param [type] $num   [description]
	 */
	public function setDec($field,$num = null){
		$where = empty($this->arr['where']) ? '' : ' where '.$this->arr['where'];
		$num   = is_null($num) ? $field.'-1' : $field.'-'.$num ;

		$sql = 'update '.$this->table.' set '.$field.'='.$num.$where;
		return $this->exec($sql);
	}

	/**
	 * [edit 修改]
	 * @param  [type] $edit [description]
	 * @return [type]       [description]
	 */
	public function edit($edit){
		$set = '';
		foreach ($edit as $k => $v) {
			$set .= ','.$k.'="'.$v.'"';
		}

		$where = empty($this->arr['where']) ? '' : ' where '.$this->arr['where'];

		$sql = 'update '.$this->table.' set '.substr($set,1).$where;
		return $this->exec($sql);
	}

	/**
	 * [setField 修改]
	 * @param [type] $edit [结果]
	 */
	public function setField($edit){
		return $this->edit($edit);
	}

	/**
	 * [save 修改]
	 * @param [type] $edit [结果]
	 */
	public function save(){
		return $this->edit($edit);
	}

	/**
	 * [delete 删除方法]
	 * @return [type] [description]
	 */
	public function delete(){

		if(empty($this->arr['where'])) halt('删除条件不能为空');

		$sql = 'DELETE FROM '.$this->table.' WHERE '.$this->arr['where'];
		return $this->exec($sql);
	}
}