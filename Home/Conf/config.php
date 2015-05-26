<?php
return array(
	//'配置项'=>'配置值'
	/* 数据库设置 */
    'DB_TYPE'               => 'mysql',     // 数据库类型
    'DB_HOST'               => 'localhost', // 服务器地址
    'DB_NAME'               => 'sornets',   // 数据库名
    'DB_USER'               => 'sornets',   // 用户名
    'DB_PWD'                => 'sxcxs0819', // 密码
    'DB_PORT'               => '',			// 端口
    'DB_PREFIX'             => 'act_',		// 数据库表前缀
    'DB_FIELDTYPE_CHECK'    => false,       // 是否进行字段类型检查
    'DB_FIELDS_CACHE'       => true,        // 启用字段缓存
    'DB_CHARSET'            => 'utf8',      // 数据库编码默认采用utf8
    'DB_DEPLOY_TYPE'        => 0,			// 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
    'DB_RW_SEPARATE'        => false,       // 数据库读写是否分离 主从式有效
    'DB_MASTER_NUM'         => 1,			// 读写分离后 主服务器数量
    'DB_SLAVE_NO'           => '',			// 指定从服务器序号
    'DB_SQL_BUILD_CACHE'    => false,		// 数据库查询的SQL创建缓存
    'DB_SQL_BUILD_QUEUE'    => 'file',		// SQL缓存队列的缓存方式 支持 file xcache和apc
    'DB_SQL_BUILD_LENGTH'   => 20,			// SQL缓存的队列长度
    'DB_SQL_LOG'            => false,		// SQL执行日志记录

	//URL路由模式
	'URL_MODEL'             => 0,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式，提供最好的用户体验和SEO支持
	//默认错误跳转对应的模板文件
	'TMPL_ACTION_ERROR'     => 'Public:jump',
	//默认成功跳转对应的模板文件
	'TMPL_ACTION_SUCCESS'   => 'Public:jump',
);
?>