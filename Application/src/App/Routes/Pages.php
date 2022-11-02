<?php

namespace App\Routes;

// Gerenciador de páginas

use App\Controllers\HomeController;

// ROTA HOME
$obRouter->get('/', [
    function () {
        return new Response(200, HomeController::getHome());
    }
]);