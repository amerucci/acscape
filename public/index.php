<?php

use Router\Router;
use App\Exceptions\NotFoundException;

require '../vendor/autoload.php';

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);
define('DB_NAME', 'escape_game');
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PWD', '');

$router = new Router($_GET['url']);


// public route
$router->get('/', 'App\Controllers\BlogController@welcome');
$router->get('/index', 'App\Controllers\BlogController@index');
$router->get('/show', 'App\Controllers\BlogController@show');

// user login, register, logout route
$router->get('/login', 'App\Controllers\UserController@login');
$router->post('/login', 'App\Controllers\UserController@loginPost');
$router->get('/logout', 'App\Controllers\UserController@logout');
$router->get('/register', 'App\Controllers\UserController@register');
$router->post('/register', 'App\Controllers\UserController@registerPost');


// **********************************************************************************************************
// admin route
// **********************************************************************************************************

// admin accueil
$router->get('/admin/posts', 'App\Controllers\Admin\PostController@index');

// gestion des scripts
$router->get('/admin/script', 'App\Controllers\Admin\ScriptController@index');
$router->get('/admin/script/create', 'App\Controllers\Admin\ScriptController@create');
$router->post('/admin/script/create', 'App\Controllers\Admin\ScriptController@createScript');
$router->post('/admin/script/delete/:id', 'App\Controllers\Admin\ScriptController@destroy');
$router->get('/admin/script/edit/:id', 'App\Controllers\Admin\ScriptController@edit');
$router->post('/admin/script/edit/:id', 'App\Controllers\Admin\ScriptController@update');
$router->get('/admin/script/show/:id', 'App\Controllers\Admin\ScriptController@show');

// gestion des rooms
$router->get('/admin/room', 'App\Controllers\Admin\RoomController@index');
$router->get('/admin/room/create', 'App\Controllers\Admin\RoomController@create');
$router->post('/admin/room/create', 'App\Controllers\Admin\RoomController@createRoom');
$router->post('/admin/room/delete/:id', 'App\Controllers\Admin\RoomController@destroy');
$router->get('/admin/room/edit/:id', 'App\Controllers\Admin\RoomController@edit');
$router->post('/admin/room/edit/:id', 'App\Controllers\Admin\RoomController@update');
$router->get('/admin/room/show/:id', 'App\Controllers\Admin\RoomController@show');

// gestion des furnitures
$router->get('/admin/furniture', 'App\Controllers\Admin\FurnitureController@index');
$router->get('/admin/furniture/create', 'App\Controllers\Admin\FurnitureController@create');
$router->post('/admin/furniture/create', 'App\Controllers\Admin\FurnitureController@createFurniture');
$router->post('/admin/furniture/delete/:id', 'App\Controllers\Admin\FurnitureController@destroy');
$router->get('/admin/furniture/edit/:id', 'App\Controllers\Admin\FurnitureController@edit');
$router->post('/admin/furniture/edit/:id', 'App\Controllers\Admin\FurnitureController@update');
$router->get('/admin/furniture/show/:id', 'App\Controllers\Admin\FurnitureController@show');

// gestion des objets
$router->get('/admin/objects', 'App\Controllers\Admin\ObjectsController@index');
$router->get('/admin/objects/create', 'App\Controllers\Admin\ObjectsController@create');
$router->post('/admin/objects/create', 'App\Controllers\Admin\ObjectsController@createObject');
$router->post('/admin/objects/delete/:id', 'App\Controllers\Admin\ObjectsController@destroy');
$router->get('/admin/objects/edit/:id', 'App\Controllers\Admin\ObjectsController@edit');
$router->post('/admin/objects/edit/:id', 'App\Controllers\Admin\ObjectsController@update');
$router->get('/admin/objects/show/:id', 'App\Controllers\Admin\ObjectsController@show');


// gestion des interactions
$router->get('/admin/interactions', 'App\Controllers\Admin\InteractionsController@index');
$router->get('/admin/interactions/create', 'App\Controllers\Admin\InteractionsController@create');
$router->post('/admin/interactions/create', 'App\Controllers\Admin\InteractionsController@createInteraction');
$router->post('/admin/interactions/delete/:id', 'App\Controllers\Admin\InteractionsController@destroy');
$router->get('/admin/interactions/edit/:id', 'App\Controllers\Admin\InteractionsController@edit');
$router->post('/admin/interactions/edit/:id', 'App\Controllers\Admin\InteractionsController@update');
$router->get('/admin/interactions/show/:id', 'App\Controllers\Admin\InteractionsController@show');


// le gamecontroller admin
$router->get('/admin/game', 'App\Controllers\Admin\GameController@index');  // affiche la page de création des paramètres du jeu



// **********************************************************************************************************
// error route
// **********************************************************************************************************
try {
    $router->run();
} catch (NotFoundException $e) {
    return $e->error404();
}