<?php

namespace App\Controllers;

use App\Controllers\PageGenericController;
use App\Util\View;

class HomeController extends PageGenericController{

    public static function getHome(): string
	{
		//Metodo que retornar o conteúdo(View) da PÁGINA HOME
		$content = View::render('InternalsPages/home', [
			"HomeName" => "Lista de Entregas",
			"DescricaoPage" => "Visão geral de Entregas cadastradas!",
		]);

		return parent::getPage("Home > E2000", $content);
	}
}