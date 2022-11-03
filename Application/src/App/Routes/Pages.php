<?php

namespace App\Routes;

// Gerenciador de páginas

use App\Controllers\HomeController;
use App\Controllers\EventPageController;
use App\Controllers\LoginPageController;



// ROTA PARA LOGIN/CADASTRO

$obRouter->get('/login', [
    function () {
        return new Response(200, LoginPageController::getLoginPage());
    }
]);



// ROTA HOME
$obRouter->get('/', [
    function () {
        return new Response(200, HomeController::getHome());
    }
]);

// ROTA VISUALIZAÇÃO DE EVENTOS
$obRouter->get('/eventos', [
    function () {
        return new Response(200, EventPageController::getEventsPage());
    }
]);