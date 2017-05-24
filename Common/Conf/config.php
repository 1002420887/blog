<?php

return array(

	'TMPL_PARSE_STRING'=>array('__PUBLIC__'=>'/Public'),
	'DB_TYPE'               =>  'mysql',     // 数据库类型
	'DB_HOST'               =>  '127.0.0.1', // 主机地址
    'DB_NAME'               =>  'sime',     // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',         // 密码
    'DB_PREFIX'             =>  'sime_',    // 数据库前缀
    

    'COOKIE_PREFIX'         =>  'td',      // Cookie前缀避免冲突
    'COOKIE_HTTPONLY'       =>  '',      // Cookie httponly设置

    
    'TMPL_TEMPLATE_SUFFIX'  =>  '.tpl',     // 模板后缀
    'URL_MODEL'             =>2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
    

    'URL_HTML_SUFFIX'       =>  'html',  // URL伪静态后缀
    'DEFAULT_FILTER'        =>  'strip_tags,htmlspecialchars', // 默认参数过滤方法 用于I函数... 

    'MODULE_ALLOW_LIST'    =>    array('Admin','Home'), //模块列表
    'DEFAULT_MODULE' 	   => 	'Home',//默认模块
    );