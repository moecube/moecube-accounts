<?php
//项目配置文件
return array(

    //调试
    'APP_STATUS' => 'debug',
	'URL_MODEL' => 3,
    'SHOW_PAGE_TRACE' =>true, // 显示页面Trace信息
	'LOAD_EXT_CONFIG' => 'db',
    //其他项目配置参数

    'URL_CASE_INSENSITIVE' =>true,
    'LAYOUT_ON' => true,
    // ...

    'URL_ROUTER_ON'   => true, //开启路由
    'URL_ROUTE_RULES' => array( //定义路由规则
        array('users/:id\d','User/show','','get','html,'),
        array('users/sign_in','User/sign_in','','get','html,'),
        array('users/sign_in','User/do_sign_in','','post','html,'),
        array('users/sign_up','User/sign_up','','get','html,'),
        array('users/sign_up','User/do_sign_up','','post','html,'),
        array('users/captcha','User/captcha','','get','html,'),
    ),
);