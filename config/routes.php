<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController::index');
Router::addRoute(['GET'], '/createOrder', 'App\Controller\IndexController::createOrder');
Router::addRoute(['GET'], '/products', 'App\Controller\IndexController::products');
Router::addRoute(['GET'], '/test', 'App\Controller\IndexController::test');
Router::addRoute(['GET'], '/test1', 'App\Controller\IndexController::index1');
Router::addRoute(['GET'], '/getUsers', 'App\Controller\IndexController::getUsers');