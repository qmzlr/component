<?php


use Aura\SqlQuery\QueryFactory;
use Delight\Auth\Auth;
use DI\Container;
use DI\ContainerBuilder;
use League\Plates\Engine;
use Tamtamchik\SimpleFlash\Flash;

if (!session_id()) {
    session_start();
}

require '../vendor/autoload.php';

$builder = new ContainerBuilder();
$builder->addDefinitions([
    Engine::class => function () {
        return new Engine('../app/Views');
    },
    PDO::class => function () {
        $driver = 'mysql';
        $host = 'localhost';
        $database = 'component';
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
    $r->addRoute('POST', '/registration', 'App\Controllers\IndexController::registration');
    $r->addRoute('POST', '/authorization', 'App\Controllers\IndexController::authorization');
    $r->addRoute('GET', '/users', 'App\Controllers\IndexController::users');
    $r->addRoute('GET', '/logout', 'App\Controllers\IndexController::logout');
    $r->addRoute('GET', '/edit/{id:\d+}', 'App\Controllers\UserController::index');
    $r->addRoute('POST', '/edit', 'App\Controllers\UserController::update');
    $r->addRoute('GET', '/create', 'App\Controllers\UserController::newUser');
    $r->addRoute('POST', '/createUser', 'App\Controllers\UserController::createUser');
    $r->addRoute('GET', '/profile/{id:\d+}', 'App\Controllers\UserController::profile');
    $r->addRoute('GET', '/security/{id:\d+}', 'App\Controllers\UserController::security');
    $r->addRoute('POST', '/securityUpdate', 'App\Controllers\UserController::securityUpdate');
    $r->addRoute('GET', '/status/{id:\d+}', 'App\Controllers\UserController::status');
    $r->addRoute('POST', '/statusUpdate', 'App\Controllers\UserController::statusUpdate');
    $r->addRoute('GET', '/media/{id:\d+}', 'App\Controllers\UserController::pageMedia');
    $r->addRoute('POST', '/mediaUpdate', 'App\Controllers\UserController::mediaUpdate');
    $r->addRoute('GET', '/delete/{id:\d+}', 'App\Controllers\UserController::delete');
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
