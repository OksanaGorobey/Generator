<?php declare(strict_types=1);

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

return simpleDispatcher( function( RouteCollector $r )
{
    $r->addRoute(
        'GET',
        '/ping',
        [
            'App\Controller\BaseController',
            'pingAction'
        ]
    );
    $r->addRoute(
        'GET',
        '/',
        [
            'App\Controller\BaseController',
            'indexAction'
        ]
    );

    ////////////////////////////////////////////////////////////////////////////

    $r->addRoute(
        'GET',
        '/error400',
        [
            'App\Controller\BaseController',
            'error400Action'
        ]
    );
    $r->addRoute(
        'GET',
        '/error401',
        [
            'App\Controller\BaseController',
            'error401Action'
        ]
    );
    $r->addRoute(
        'GET',
        '/error403',
        [
            'App\Controller\BaseController',
            'error403Action'
        ]
    );
    $r->addRoute(
        'GET',
        '/error404',
        [
            'App\Controller\BaseController',
            'error404Action'
        ]
    );
    $r->addRoute(
        'GET',
        '/error405',
        [
            'App\Controller\BaseController',
            'error405Action'
        ]
    );

    ////////////////////////////////////////////////////////////////////////////

    $r->addRoute(
        'POST',
        '/api/auth',
        [
            'App\Controller\LoginController',
            'loginAction'
        ]
    );

    $r->addRoute(
        'GET',
        '/api/generate',
        [
            'App\Controller\GeneratorController',
            'generateAction'
        ]
    );

    $r->addRoute(
        'GET',
        '/api/retrieve',
        [
            'App\Controller\GeneratorController',
            'viewAction'
        ]
    );

    ////////////////////////////////////////////////////////////////////////////

});
