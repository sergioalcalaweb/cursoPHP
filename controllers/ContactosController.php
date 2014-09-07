<?php 
	
	// view('contactos');

class ContactosController{

	public function indexAction(){

		exit('contactos');

	}

	public function ciudadAction($ciudad){

		exit('contactos '. $ciudad);

	}
}