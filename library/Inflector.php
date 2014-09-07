<?php

class Inflector{

	// se pone estatico para decirle a php que no se tiene que crear un nuevo objeto de la clase 
	// para poder instanciar esa funcion

	public static function camel($value){

		$segments = explode('-', $value);
		//array_walk me permite reccorrer todo el arreglo y ejecutar una funcion
		array_walk($segments, function(&$item){
			//ucfisrt convierte el primer caracter en mayuscula
			$item = ucfirst($item);
		});

		return implode('', $segments);
	}

	public static function lowerCamel($value){

		return lcfirst(static::camel($value));

	}
}