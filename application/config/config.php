<?php
/**
 * 应用配置文件
 * 使用数组方式
 *
 * config目录下面放置用户的自定义配置文件
 * Created by PhpStorm.
 * User: 52818
 * Date: 2019/9/20
 * Time: 18:00
 */

return [
    //数据库的连接参数配置
    'db' => [
        'user' => 'root', //用户名
        'pass' => 'root', //密码
        'dbname' => 'edu', //默认数据库名称
    ],

    //应用的整体配置
    'app' => [
        'default_platform' => 'home', //默认模块
    ],

    //前台配置
    'home' => [
        'default_controller' => 'Student', //默认控制器
        'default_action' => 'listAll', //默认方法
    ],

    //后台配置
    'admin' => [
        'default_controller' => '', //默认控制器
        'default_action' => '', //默认方法
    ],


];














