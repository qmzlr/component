<?php

use Aura\SqlQuery\QueryFactory;
use Delight\Auth\Auth;
use DI\Container;
use DI\ContainerBuilder;
use League\Plates\Engine;

if (!session_id()) {
    session_start();
}

require '../vendor/autoload.php';


$builder = new ContainerBuilder();
$builder->addDefinitions([
    Engine::class => function () {
        return new Engine('../app/views');
    },
    PDO::class => function () {
        $driver = 'mysql';
        $host = 'localhost';
        $database = 'vmind';
        $username = 'root';
        $password = '';
        return new PDO("$driver:host=$host;dbname=$database", $username, $password);
    },
    QueryFactory::class => function () {
        return new QueryFactory('mysql');
    },
    Auth::class => function (Container $c) {
        return new Auth($c->get(PDO::class));
    }

]);


try {
    $container = $builder->build();
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', ['App\Controllers\IndexController', 'index']);
    $r->addRoute('GET', '/login', 'App\Controllers\IndexController::login');
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);


$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo '404 Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo '405 Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        $controller = $container->call($routeInfo[1], [$routeInfo[2] + $_GET + $_POST]);
        break;
}
