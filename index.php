<?php

session_start();

require 'vendor/autoload.php';

if(!isset($_SESSION['auth']) && $_SERVER['REQUEST_URI'] !== '/login'){
    header('Location: /login');
    return;
}

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', function(){
        $controller = new Quiz\Controllers\Main();
        $controller->run();
    });
    $r->addRoute(['GET', 'POST'], '/login', function(){
        $controller = new Quiz\Controllers\Login();
        $controller->run();
    });
    $r->addRoute(['GET', 'POST'], '/logout', function(){
        $controller = new Quiz\Controllers\Login();
        $controller->runLogout();
    });
    # - Tests
    if (isset($_SESSION['auth']) && $_SESSION['auth']['privilege'] == 1){
        $r->addRoute('GET', '/tests', function(){
            $controller = new Quiz\Controllers\Tests();
            $controller->run();
        });
        $r->addRoute(['GET', 'POST'], '/tests/add', function(){
            $controller = new Quiz\Controllers\Tests();
            $controller->runAdd();
        });
        $r->addRoute(['GET', 'POST'], '/tests/questions', function(){
            $controller = new Quiz\Controllers\Questions();
            $controller->run();
        });
        $r->addRoute(['GET', 'POST'], '/tests/delete', function(){
            $controller = new Quiz\Controllers\Tests();
            $controller->runDelete();
        });
        $r->addRoute(['GET', 'POST'], '/tests/update', function(){
            $controller = new Quiz\Controllers\Tests();
            $controller->runUpdate();
        });
        $r->addRoute(['GET', 'POST'], '/tests/delete/question', function(){
            $controller = new Quiz\Controllers\Tests();
            $controller->runDeleteQuestion();
        });
        $r->addRoute(['GET', 'POST'], '/tests/delete/answer', function(){
            $controller = new Quiz\Controllers\Tests();
            $controller->runDeleteAnswer();
        });
        $r->addRoute(['GET', 'POST'], '/tests/add/answer', function(){
            $controller = new Quiz\Controllers\Tests();
            $controller->runAddAnswer();
        });
        $r->addRoute(['GET', 'POST'], '/tests/add/question', function(){
            $controller = new Quiz\Controllers\Tests();
            $controller->runAddQuestion();
        });

        # - Users
    $r->addRoute('GET', '/users', function(){
        $controller = new Quiz\Controllers\Users();
        $controller->run();
    });
    $r->addRoute(['GET', 'POST'], '/users/add', function(){
        $controller = new Quiz\Controllers\Users();
        $controller->runAdd();
    });
    $r->addRoute(['GET', 'POST'], '/users/update', function(){
        $controller = new Quiz\Controllers\Users();
        $controller->runUpdate();
    });
    $r->addRoute(['GET', 'POST'], '/users/delete', function(){
        $controller = new Quiz\Controllers\Users();
        $controller->runDelete();
    });

    # - Student Results

    $r->addRoute(['GET', 'POST'], '/studentresults', function(){
        $controller = new Quiz\Controllers\StudentResults();
        $controller->run();
    });
    }


    # - Tasks
    if (isset($_SESSION['auth']) && ($_SESSION['auth']['privilege'] == 0 || $_SESSION['auth']['privilege'] == 1)){
        
        # - Tasks
        
        $r->addRoute('GET', '/tasks', function(){
            $controller = new Quiz\Controllers\Tasks();
            $controller->run();
        });
        $r->addRoute(['GET', 'POST'], '/tasks/start', function(){
            $controller = new Quiz\Controllers\Tasks();
            $controller->runStart();
        });

        # - Results

        $r->addRoute(['GET', 'POST'], '/results', function(){
            $controller = new Quiz\Controllers\Results();
            $controller->run();
        });
    }

    
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        echo 'Route did not create';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        echo 'Route has been created, but not method';

        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $handler($vars);
        // ... call $handler with $vars
        break;
}