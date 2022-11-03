<?php

namespace App\Controllers;

use App\Util\View;

class PageGenericController
{
    public static function getPage($title, $content): string
    {
        //Método responsável por retornar o conteúdo(VIEW) da página genérica.
        return View::render('MainStructurePages/page', [
            "title" => $title,
            "header" => self::getHeader(),
            "content" => $content,
            "footer" => self::getFooter()
        ]);
    }

    
    public static function getLogin($title, $content): string
    {
        //Método responsável por retornar o conteúdo(VIEW) da página genérica.
        return View::render('InternalsPages/login', [
            "title" => "Login",
            "content" => $content,
        ]);
    }
    private static function getHeader(): string
    {
        return View::render("MainStructurePages/header");
    }

    private static function getFooter(): string
    {
        return View::render("MainStructurePages/footer");
    }
}
