<?php
/**
 * 入口文件
 * Created by PhpStorm.
 * User: 52818
 * Date: 2019/9/23
 * Time: 9:50
 */

//导入框架基础类
require './framework/Base.php';
//实例化框架类
$app = new Base();
//让框架跑起来
$app->run();