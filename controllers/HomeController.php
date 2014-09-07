<?php
	//primera parte
	// $lenguaje = 'PHP';
	// $titulo = 'Mi Curso de Programación de PHP';
	// $secreta = 'Esto es una variable secreta';
	// view('home',compact('lenguaje','titulo'));

class HomeController {

	public function IndexAction(){

		// exit('We are alive');

		//para el tipo de respuesta invalida
		//return new arrayObject();

		//crea una nueva vista de la clase view
		return new View('home',['titulo'=>'MejorandoPHP','lenguaje'=>'PHP']);

		//regreso de string
		//return 'Pagina en constraccion';

		//regreso de array
		//return ['titulo'=>'MejorandoPHP','lenguaje'=>'PHP'];

	}
}

