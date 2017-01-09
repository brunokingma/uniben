<?php

	switch($_SERVER['REQUEST_METHOD'])	{
	case 'GET': $request = &$_GET; break;
	case 'POST': $request = &$_POST; break;
	}


	if(isset($request['model']) && isset($request['action']) ){


		if($request['action'] != 'logar' &&  $request['action'] != 'esqueciminhasenha'){

			require 'classes/componente.php';
			$componente = new componente();
			$componente->verificaAutenticacao();

		}



			require 'classes/rb.php';
			require 'classes/config.php';
			require 'classes/'.$request['model'].'.php';

			$config = new config();

		 	R::setup( 'mysql:host='.$config->localhost.';dbname='.$config->banco.'', $config->usuario, $config->senha);
		 	R::freeze(true);

		 	$obj = R::dispense( $request['model'] );

			$obj->$request['action']($request);

	}

?>