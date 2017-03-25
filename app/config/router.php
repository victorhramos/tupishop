<?php

/**
 * false to disable controller/action automatic route
 */
$router = $di->getRouter(false);

// Home
$router->addGet('/', [
    'controller' => 'index',
    'action' => 'index'
]);

$router->handle();
