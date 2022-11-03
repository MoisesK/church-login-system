<?php

namespace App\Controllers;

use App\Controllers\PageGenericController;
use App\Util\View;

class EventPageController extends PageGenericController{

    public static function getEventsPage(): string
	{
		//Metodo que retornar o conteúdo(View) da PÁGINA HOME
		$content = View::render('InternalsPages/events', [
			"teste" => "Lista de Entregas",
		]);

		return parent::getPage("Eventos > 1ªIBTN", $content);
	}
}