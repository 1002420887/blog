<?php

/**
 * 封装 上传文件类
 */

class Upload{
	private $file;		//文件名称
	private $size;		//文件大小 默认 2M，
	private $dir;		//上传目录
	private $nameImg;	//路径
	private $type = array(
		'image/gif','image/jpeg','image/jpg','image/pjpeg','image/x-png','image/png'
	);	//文件类型

	function __construct($file,$dir,$type = null,$size = null){
		$this->file = $file;
		$this->dir  = is_null($dir)  ? $this->dir  : $dir  ;
		$this->type = is_null($type) ? $this->type : $type ;
		$this->size = is_null($size) ? 2*1024*1024 : $size ;
	}

	// 上传文件
	public function upload(){
		
		//多文件 多 name 上传
		if(is_array($this->file)){
			foreach ($this->file as $k => $v) {
				
				if(is_array($_FILES[$v]['name'])){
					foreach ($_FILES[$v] as $key => $value) {
						//上传文件
						return $this->move($value,$v);
					}
				}else{
					//上传文件
					return $this->move($_FILES[$v],$v);
				}
			}
		}else{
			//上传文件
			return $this->move($_FILES[$this->file],$this->file);
		}
	}

	//上传文件
	private function move($val,$name){

		//验证类型
		$this->aType($val['type'],$name);
		//验证大小
		$this->aSize($val['size'],$name);
		//错误信息
		$this->aError($val['error'],$name);
		$newName = $this->aNmae().strrchr($val['name'],'.');
		//上传文件
		return move_uploaded_file($val['tmp_name'],$this->dir.$newName);
	}

	//设置名称
	private function aNmae(){
		return chr(mt_rand(65, 90)).mt_rand(1,99).mt_rand(1,99).mt_rand(1,99).mt_rand(1,99).mt_rand(1,99).mt_rand(1,99);
	}

	//限制类型
	private function aType($type,$name){
		if(!in_array($type, $this->type)){
			$this->ajaxReturn($name.'文件类型不合法');
		}
	}

	//限制大小
	private function aSize($size,$name){
		if($size > $this->size){
			$this->ajaxReturn($name.'文件太大');
		}
	}

	//错误信息
	private function aError($error,$name){
		switch($error){
		    case 1:   
		        $this->setError($name."服务器空间不够用");   
		break;   

		case 2:   
	        $this->setError($name."文件大小超出浏览器限制");   
	        break;   

	    case 3:    
	        $this->setError($name."文件仅部分被上传");   
	        break;   

	    case 4:  
	        $this->setError($name."没有找到要上传的文件");   
	        break;   

	    case 5:  
	        $this->setError($name."服务器临时文件夹丢失");   
	        break;   

	    case 6: 
	        $this->setError($name."文件写入到临时文件夹出错");   
	        break;   
		}
	}
}