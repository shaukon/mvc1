<?php
/**
 * 框架基础类，引导类，前端控制器
 *  * 基础类也叫引入类，或者前端控制器，
 * 主要完成三项工作：
 * 1.加载用户自定义的配置信息
 * 2.实现类的自动加载
 * 3.获取用户的请求，高大上一点就是请求分发：把用户的请求传递给对应的控制器，或者方法执行。
 * Created by PhpStorm.
 * User: 52818
 * Date: 2019/9/23
 * Time: 9:48
 */
class Base{
	//创建run方法，完成框架的所有功能
	public function run(){
		//加载配置
		$this->loadConfig();
		//注册自动加载
		$this->registerAutoLoad();
		//获取请求参数
		$this->getRequestParams();
		//请求分发
		$this->dispatch();
	}

	//加载配置
	private function loadConfig(){
		//使用全局变量保存用户配置
		$GLOBALS['config'] = require './application/config/config.php';
	}

	//创建用户自定义类的加载方法
	public function userAutoLoad($className){
		//定义基础类的列表
		$baseClass = [
			'Model' => './framework/Model.php',
			'Db' => './framework/Db.php',
		];

		//依次进行判断：基础类？模型类？控制器类？
		if (isset($baseClass[$className])){
			require $baseClass[$className]; //加载模型基类
		} elseif (substr($className,-5) == 'Model'){
			require './application/home/model/'.$className.'.php';//加载自定义模型基类
		} elseif (substr($className,-10) == 'Controller'){
			require './application/home/controller/'.$className.'.php';//加载自定义控制器基类
		}
	}

	//注册自动加载方法,到标准函数库中。
	private function registerAutoLoad(){
		/**
		 * php标准库里面的一个方法，
		 * 允许用户自定义类的加载方法，
		 * 然后将用户自定义的方法，注册进来。
		 */
		spl_autoload_register([$this,'userAutoLoad']);
	}

	//获取请求参数
	private function getRequestParams(){

		//当前模块
		$defPlate = $GLOBALS['config']['app']['default_platform'];
		//mvc1.io?p=home&c=student&a=info
		$p = isset($_GET['p'])?$_GET['p']:$defPlate;
		define('PLATFORM',$p);


		//当前控制器
		$defController = $GLOBALS['config'][PLATFORM]['default_controller'];
		//mvc1.io?p=home&c=student&a=info
		$c = isset($_GET['c'])?$_GET['c']:$defController;
		define('CONTROLLER',$c);

		//当前方法
		$defAction = $GLOBALS['config'][PLATFORM]['default_action'];
		//mvc1.io?p=home&c=student&a=info
		$a = isset($_GET['a'])?$_GET['a']:$defAction;
		define('ACTION',$a);
	}

	private function dispatch(){
		//实例化控制器类
		$controllerName = CONTROLLER.'Controller';
		$controller = new $controllerName;

		//调用当前方法
		$actionName = ACTION.'action';
		$controller->$actionName();


	}
}

















