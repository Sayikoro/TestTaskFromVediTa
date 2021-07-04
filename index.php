<?
session_start();
// ini_set('display_errors',1);
// error_reporting(E_ALL);
define('ROOT', dirname(__FILE__));
// 2. Подключение файлов системы
require_once(ROOT.'/Components/Router.php');
// 3. Установка соединения с БД
require_once(ROOT.'/Components/DB.php');
// 4. Вызор Router
$router = new Router();
$router->run();
?>







