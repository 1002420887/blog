<?php

/**
 * 封装 验证码类
 */

class Code{

	private $num   = '23456789';
	private $str   = 'abcdefghkmnprstuvwxyz';
	private $strs  = 'abcdefghkmnprstuvwxyz23456789';
	private $len   = 4;		//验证码长度
	private $width = 130;	//宽度
	private $height = 50;	//高度
	private $font;			//字体
	private $img;			//背景
	private $code;			//验证码
	private $size  = 16;	//字体大小
	private $color;			//字体颜色
	private $type;			//类型

	//装载字体
	public function __construct($arr = null){

		//传入格式
		// $arr = array(
		// 	'len'    => 8,	//验证码长度
		// 	'width'  => 100,//验证码宽度
		// 	'height' => 30, //高度
		// 	'size'	 => 18,//字体大小
		// 	'type'	 => 3,//类型 1 数字 2 字母 3 混合
		// 	);
		
		//设置初始化
		$this->len    = isset($arr['len'])    ? $arr['len']    : $this->len ;
		$this->width  = isset($arr['width'])  ? $arr['width']  : $this->width ;
		$this->height = isset($arr['height']) ? $arr['height'] : $this->height ;
		$this->size   = isset($arr['size'])   ? $arr['size']   : $this->size ;
		$this->type   = isset($arr['type'])   ? $arr['type']   : $this->type ;
		
		$this->font = FONT_PATH.'/ARJULIAN.ttf';
		ob_clean();
	}

	//画背景
	private function drawBg(){
		$this->img = imagecreatetruecolor($this->width, $this->height);
		$color     = imagecolorallocate($this->img, mt_rand(157,255), mt_rand(157,255), mt_rand(157,255));
		imagefilledrectangle($this->img,0,$this->height,$this->width,0,$color);
	}

	//生成随机码
	private function createCode(){

		switch ($this->type) {
			case 1:
				$string = $this->num;
				break;
			case 2:
				$string = $this->str;
				break;
			case 3:
				$string = $this->strs;
				break;
		}

	 	$_len = strlen($string)-1;
		for ($i = 0;$i < $this->len;$i++) {
			$this->code .= $string[mt_rand(0,$_len)];
		}
	}

	//生成文字
	private function createFont() {
		$_x = $this->width / $this->len;
		for ( $i = 0; $i < $this->len; $i++) {
			$this->color = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
			imagettftext($this->img,$this->size,mt_rand(-30,30),$_x*$i+mt_rand(1,5),$this->height / 1.4,$this->color,$this->font,$this->code[$i]);
		}
	}

	//生成线条、雪花
	private function createLine() {
		//线条
		for($i = 0;$i < 6;$i++) {
			$color = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
	  		imageline($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,$this->width),mt_rand(0,$this->height),$color);
		}
		
		//雪花
		for($i = 0;$i < 100;$i ++) {
			$color = imagecolorallocate($this->img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
			imagestring($this->img,mt_rand(1,5),mt_rand(0,$this->width),mt_rand(0,$this->height),'*',$color);
		}
	}

	//输出
	private function outPut() {
		header('Content-type:image/png');
		imagepng($this->img);
		imagedestroy($this->img);
	}

	//对外生成
	public function show() {
		$this->drawBg();
		$this->createCode();
		$this->createLine();
		$this->createFont();
		$this->outPut();
	}
	//获取验证码
	public function getCode() {
		return strtolower($this->code);
	}

}
