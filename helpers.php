<?php


function controller($name){

	if (empty($name)) {

		$name = 'home';

	}

	$file = "controllers/$name.php";

	if (file_exists($file)) {
		
		require $file;
		
	}else{

		header("HTTP/0.1 404 Not Found");
		exit("Pagina no econtrada");
		
	}



}
	
function view($template, $vars = array()){

	extract($vars);

	require "views/$template.tpl.php";	
	
}