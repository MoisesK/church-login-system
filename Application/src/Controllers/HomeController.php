<?php

namespace App\Controllers;

use App\Controllers\PageGenericController;
use App\Util\View;

class HomeController extends PageGenericController{

    public static function getHome(): string
	{
		//Metodo que retornar o conteúdo(View) da PÁGINA HOME
		$content = View::render('InternalsPages/home', [
			"teste" => "Lista de Entregas",
		]);

		return parent::getPage("Home > 1ªIBTN", $content);
	}
}