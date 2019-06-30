<?php
\Core\Page\Router::addRoute('/login', '\App\Controller\Login');
\Core\Page\Router::addRoute('/register', 'App\Controller\Register');
\Core\Page\Router::addRoute('/home', 'App\Controller\Home');
\Core\Page\Router::addRoute('/logout', 'App\Controller\Logout');
\Core\Page\Router::addRoute('/index', 'App\Controller\Home');
\Core\Page\Router::addRoute('/', 'App\Controller\Home');