<?php


//clase request 
class Request {

	// definimos variables privadas

	protected $url;
	protected $controller;
	protected $action;
	protected $defaultController = 'home';
	protected $defaultAction = 'index';
	protected $params = array();

	public function __construct($url){

		$this->url = $url;

		//ruta/acerca/algo
		//ruta/acerca/algo2
		//ruta/acerca

		$segments = explode('/', $this->getUrl());
		
		$this->resolveController($segments);
		$this->resolveAction($segments);
		$this->resolveParams($segments);

	}

	public function resolveParams(&$segments){

		$this->params = $segments;
	}

	//paso de valores por referencia con el & 
	public function resolveAction(&$segments){

		//array_shift toma el primer valor del arreglo y lo quita del arreglo original
		$this->action = array_shift($segments);

		if (empty($this->action)) {
			$this->action = $this->defaultAction;
		}

	}

	public function resolveController(&$segments){

		//array_shift toma el primer valor del arreglo 
		$this->controller = array_shift($segments);

		if (empty($this->controller)) {
			$this->controller = $this->defaultController;
		}

	}

	public function getUrl(){
		return $this->url;
	}

	public function getController(){

		return $this->controller;

	}

	public function getControllerClassName(){

		//creamos la clase iflector y mandamos a llamar a la funcion camel 
		//sintaxis clase::funcion

		return Inflector::camel($this->getController()) . 'Controller';

	}

	public function getControllerFileName(){
		return 'controllers/' . $this->getControllerClassName() . '.php';
	}

	public function getAction(){
		return $this->action;
	}

	public function getParams(){
		return $this->params;
	}

	public function getActionMethodName(){
		
		return Inflector::lowerCamel($this->getAction()) . 'Action';		

	}

	//lo que ejecuta toda nuestra aplicacion y llama al las funciones ya que fue iniciada la clase
	public function execute(){

		$controllerClassName = $this->getControllerClassName();
		$controllerFileName  = $this->getControllerFileName();
		$actionMethodName 	 = $this->getActionMethodName();
		$params 			 = $this->getParams();


		if (!file_exists($controllerFileName) ) {
			exit('El Controlador no existe');
		}

		require $controllerFileName;

		$controller = new $controllerClassName();

		//se usar para llamar funciones de una clase pasando arreglos como parametros
		$response = call_user_func_array([$controller, $actionMethodName], $params); 


		$this->executeResponse($response);
		// $controller->$actionMethodName();
	}

	public function executeResponse($response){

		//verifica los datos de la respuesta 
		if ($response instanceof Response) {

			$response->execute();

		}elseif (is_string($response)) {

			echo $response;

		}elseif (is_array($response)) {

			echo json_encode($response);

		}
		else{
			exit('Respuesta Invalida');
		}

	}

}


