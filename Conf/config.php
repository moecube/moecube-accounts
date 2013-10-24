<?php
//项目配置文件
return array(

    //调试
    'APP_STATUS' => 'debug',
    'PATH_MODE' => 3,
    'SHOW_PAGE_TRACE' =>true, // 显示页面Trace信息

    //数据库配置信息
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_HOST'   => 'localhost', // 服务器地址
    'DB_NAME'   => 'moeid', // 数据库名
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => '', // 密码
    'DB_PORT'   => 3306, // 端口
    'DB_PREFIX' => 'moeid_', // 数据库表前缀
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
        array('users/captcha','User/captcha','','get',''),
    ),
);