<?php

/**
 * 调用smarty
 */

class SmartyCore{
	private static $smarty = null;

	public function __construct(){
		if(is_null(self::$smarty)){
			
			$smarty = new Smarty();
			//模板目录
			$smarty ->template_dir = __ROOT__.'/'.MODEL.'/View/'.C('DEF_TPL').'/'.CONTROLLER.'/';
			//编译目录
			$smarty ->compile_dir = COMP_PATH;
			//缓存目录
			$smarty ->cache_dir   = CACHE_PATH;

			//左定界符
			$smarty ->left_delimiter = C('L_DELI');

			//左定界符
			$smarty ->right_delimiter = C('R_DELI');

			//是否开启缓存
			$smarty ->caching		  = C('CACHE');
			$smarty ->cache_lifetime  = C('CACHE_TIME');

			//系统标签库
			$smarty->plugins_dir      = self::_plugins_dir();

			$smarty->php_handling     = 'SMARTY_PHP_ALLOW' ;

			self::$smarty             = $smarty;
		}
	}

	//display方法
	protected function display($tpl){
		self::$smarty->display($tpl,$_SERVER['REQUEST_URI']);
	}

	//assign方法
	protected function assign($var,$val){
		self::$smarty->assign($var,$val);
	}

	private static function _plugins_dir(){
	   return array(
	      ORG_PATH.'/Smarty/plugins',
	      PLUGINS_PATH,
	      // COMMON_PLUGINS_PATH,
	   );
	 }
}