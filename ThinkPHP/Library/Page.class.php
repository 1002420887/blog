<?php

/**
 * 封装 分页
 */

class Page{

	private $par   = null;  //条件
	private $page  = 1;	 	//当前页码
	private $num   = 0;	 	//总条数
	private $nums  = 0;	 	//每页条数
	private $pages = 0;  	//总页数
	private $pnum  = 7; 	//最大显示页数
	private $default = array(
			'first' => '首页',
			'last'  => '尾页',
			'prev'  => '上一页',
			'next'  => '下一页',
			'pointL' => '...',
			'pointR' => '...',
		);

	/**
	 * [__construct 构造函数初始化]
	 * @param [type] $num  [数据条数]
	 * @param [type] $nums [每页条数]
	 */
	function __construct($num,$nums,$par = null) {
    	$this->num  = $num;
    	$this->nums = $nums;
    	$this->par  = $par;
    	$page  = I('page') ? I('page') : 1 ;
		$this->page = $page;
    }

	/**
	 * [show 分页展示]
	 * @return [type] [分页展示连接]
	 */
	function show(){
		return 1;
		//总页数
		$pages = ceil($this->num/$this->nums);
		$this->pages = $pages;

		//上一页
		$prev = $this->prev($this->page);

		//下一页
		$next = $this->next($this->page);

		$str = '<div class="h_ui_page">';

		//首页
		if($this->page >= 5){
			$str .= '<a href="'.$this->url(1).'">'.$this->default['first'].'</a>';
		}

		//上一页连接
		if($this->page != 1){
			$str .= '<a href="'.$this->url($prev).'">'.$this->default['prev'].'</a>';
		}

		//加 左边...
		if($this->page > ($this->pnum-3)){
			$str .= '<a>'.$this->default['pointL'].'</a>';
		}

		$start = $this->page - 3 <= 1 ? 1 : $this->page - 3 ;

		if($pages <= $this->pnum){
			$end = $pages;
		}else{
			$end = $start + ($this->pnum-1);
			if($end >= $pages){
				$end = $pages;
			}
		}

		for ($i = $start; $i <= $end; $i++) {
			$act = '';
			if($this->page == $i){
				$act = 'class="active"';
			}
			$str .= '<a '.$act.' href="'.$this->url($i).'">'.$i.'</a>';
		}

		//加 右边...
		if(($this->page + 3) < $pages){
			$str .= '<a>'.$this->default['pointR'].'</a>';
		}

		if($this->page != $pages){
			//下一页连接
			$str .= '<a href="'.$this->url($next).'">'.$this->default['next'].'</a>';

			//尾页
			$str .= '<a href="'.$this->url($pages).'">'.$this->default['last'].'</a>';
		}

		$str .= '</div>';

		return $str;
	}

	//处理url
	function url($page){

		$pgArr = array('page'=>$page);
		$par   = is_null($this->par) ? $pgArr : array_merge($this->par,$pgArr);
		return U(MODEL.'/'.CONTROLLER.'/'.ACTION,$par);
	}

	//开始记录数
	function firstR(){
		
		return ($this->page-1)*$this->nums;
	}

	//所取条数
	function larstR(){
		return $this->nums;
	}

	//上一页
	function prev($page){

		$page -- ;
		if($page <= 1){
			$page = 1;
		}

		return $page;
	}

	//下一页
	function next($page){
		$page ++ ;
		if($page >= $this->pages){
			$page = $this->pages;
		}

		return $page;
	}

	//总条数
	function num(){
		return $this->num;
	}

	//总页数
	function pages(){
		return $this->pages;
	}
}