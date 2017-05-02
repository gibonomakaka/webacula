<?php

// FRONT CONTROLLER

// Общие настройки
ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();

// Подключение файлов системы
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Autoload.php');

// Подключение настроек
//$settings = include_once ROOT.'\config\setup.php';

// Вызов Router
$router = new Router();
$router->run();