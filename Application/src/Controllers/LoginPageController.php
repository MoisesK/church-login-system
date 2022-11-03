<?php

namespace App\Controllers;

use App\Controllers\PageGenericController;
use App\Util\View;

class LoginPageController extends PageGenericController{

    public static function getLoginPage(): string
	{
		//Metodo que retornar o conteúdo(View) da PÁGINA HOME
		$content = View::render('InternalsPages/login', [
			
		]);

		return parent::getLogin("Login > 1ªIBTN", $content);
	}
}