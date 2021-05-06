<?php

declare(strict_types=1);

use Middlewares\FastRoute;
use Middlewares\RequestHandler;
use Relay\Relay;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Laminas\Diactoros\ServerRequestFactory;
use FastRoute\Dispatcher;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$container = require dirname(__DIR__) . '/src/config/container.php';
$routes = require dirname(__DIR__) . '/src/config/routes.php';

// often make !AUTH_URi but in our case only 2 routes  with auth
const AUTH_URI =
[
    '/api/generate',
    '/api/retrieve'
];

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri        = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if(false !== $pos = strpos($uri, '?')){
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $routes->dispatch($httpMethod, $uri);
switch( $routeInfo[0] ) {
    case Dispatcher::NOT_FOUND:
        // ... 404 Method Not Allowed
        exit( header('location: /error404' ) );
    case Dispatcher::METHOD_NOT_ALLOWED:
        // ... 405 Method Not Allowed
        $allowedMethods = $routeInfo[1];
        exit( header('location: /error405?method=' . join( ', ', $allowedMethods ) ) );
    case Dispatcher::FOUND:

        if( in_array( $uri, AUTH_URI ) )
        {
            $jwt = new \App\lib\JwtAuthenticator();

            if( !$jwt->validateHeader() )
            {
                exit( header('location: /error400' ) );
            }

            if( !$jwt->validateToken() )
            {
                exit( header('location: /error401' ) );
            }
        }

        $controller = $routeInfo[1];
        $parameters = $routeInfo[2];

        // We could do $container->get($controller) but $container->call()
        // does that automatically
        $container->call( $controller, $parameters );
        break;
}

$middlewareQueue[] = new FastRoute($routes);
$middlewareQueue[] = new RequestHandler($container);

$requestHandler = new Relay($middlewareQueue);
$response = $requestHandler->handle(ServerRequestFactory::fromGlobals());

$emitter = new SapiEmitter();
return $emitter->emit($response);
