<?php
/**
 * 用户模块配置文件
 */

return array(
	'__PUBLIC__'   => __ROOT__.'/Public',		//public 目录

	'__MODPUBLIC_' => __ROOT__.'/'.MODEL.'/View/'.C('DEF_TPL').'/Public',		//PUBLIC目录

	'__CSS__'      => '/'.MODEL.'/View/'.C('DEF_TPL').'/Public/Css',	//Css目录

	'SESSION'	   => true,	   //session状态

	'DEFAULT_THEME' =>  'default',  // 默认模板主题名称

	'WEB_SESSION'  => 'sime',   //session前缀 每个网站必改

	'AUTH'		   => false,	//是否开启后台权限认证
);