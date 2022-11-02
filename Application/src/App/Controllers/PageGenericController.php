<?php

namespace App\Controllers;

use App\Util\View;

class PageGenericController
{
    public static function getPage($title, $content): string
    {
        //Método responsável por retornar o conteúdo(VIEW) da página genérica.
        return View::render('page', [
            "title" => $title,
            "header" => self::getHeader(),
            "content" => $content,
            "footer" => self::getFooter()
        ]);
    }
    private static function getHeader(): string
    {
        return View::render("header");
    }

    private static function getFooter(): string
    {
        return View::render("footer");
    }
}
