<?php
/**
 * 用户模块配置文件
 */

return array(
	'__PUBLIC__'   => __ROOT__.'/Public',		//public 目录

	'__MODPUBLIC_' => __ROOT__.'/'.MODEL.'/View/'.C('DEF_TPL').'/Public',		//PUBLIC目录
	//模板配置目录
	'TMPL_PARSE_STRING' =>	array(
        '__BS__'	=>__ROOT__.'/Public/bootstrap',
		'__CSS__'	=>__ROOT__.'/'.MODULE_NAME.'/View/Public/Css',
		'__JS__'	=>__ROOT__.'/'.MODULE_NAME.'/View/Public/Js',
		'__IMAGES__'=>__ROOT__.'/'.MODULE_NAME.'/View/Public/Images',
        '__HOMEIMAGES__'=>__ROOT__.'/Home/View/Public/Images',
		),

	'SESSION'	   => true,	   //session状态

	'WEB_SESSION'  => 'sime',   //session前缀 每个网站必改

	'AUTH'		   => false,	//是否开启后台权限认证
);