<?php
//
//include './vendor/autoload.php';
//use Runner\Setup;
//
//
//$setup = new Setup();
//$setup->setup();

require __DIR__ . '/vendor/autoload.php';

use App\Infra\Data\InMemory\InMemory;
use App\Core\CoreFacade;
use App\Infra\API\UnitController;
use App\Infra\API\ProductController;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;



session_start();

if (!isset($_SESSION['database'])) {
    //        $connection = new PDO('sqlite:oop.db');
//    $_SESSION['database'] = new SQLite($connection);
    $_SESSION['database'] = new InMemory();
}

$database = $_SESSION['database'];
$core = new CoreFacade($database);

$dispatcher = simpleDispatcher(function (RouteCollector $r) {
    // Unit Routes
    $r->addRoute('POST', '/units', 'App\Infra\API\UnitController@createUnit');
    $r->addRoute('GET', '/units/{id}', 'App\Infra\API\UnitController@getOneUnit');
    $r->addRoute('GET', '/units', 'App\Infra\API\UnitController@getAllUnits');

    // Product Routes
    $r->addRoute('POST', '/products', 'App\Infra\API\ProductController@createProduct');
    $r->addRoute('GET', '/products/{id}', 'App\Infra\API\ProductController@getOneProduct');
    $r->addRoute('GET', '/products', 'App\Infra\API\ProductController@getAllProducts');
    $r->addRoute('PATCH', '/products/{id}', 'App\Infra\API\ProductController@updateProductPrice');

    // Receipt Routes
    $r->addRoute('POST', '/receipts', 'App\Infra\API\ReceiptController@createReceipt');
    $r->addRoute('GET', '/receipts/{id}', 'App\Infra\API\ReceiptController@getOneReceipt');
    $r->addRoute('POST', '/receipts/{id}', 'App\Infra\API\ReceiptController@addProductInReceipt');
    $r->addRoute('PATCH', '/receipts/{id}', 'App\Infra\API\ReceiptController@closeReceipt');
    $r->addRoute('DELETE', '/receipts/{id}', 'App\Infra\API\ReceiptController@deleteReceipt');

    // Sales Route
    $r->addRoute('GET', '/sales', 'App\Infra\API\SalesController@getSales');
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];


$pos = strpos($uri, '?');
if ($pos !== false) {
    $uri = substr($uri, 0, $pos);
}

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo json_encode(["error" => "Route not found"]);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo json_encode(["error" => "Method not allowed"]);
        break;
    case FastRoute\Dispatcher::FOUND:
        [$controller, $method] = explode('@', $routeInfo[1]);
        $vars = $routeInfo[2];

        $request = Laminas\Diactoros\ServerRequestFactory::fromGlobals();

        $args = [];
        if (isset($vars['id'])) {
            $args['id'] = $vars['id'];
        }
        $args['request'] = $request;

        $controllerInstance = new $controller($core);
        echo $controllerInstance->$method($args)->getBody();
        break;
}
