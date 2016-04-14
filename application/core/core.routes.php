<?php 

class Route
{
	/***********************************************
	| string : call the controller if this is hit
	| controller :- 
	| 	homepage@main_form where
	|	@main_form : is the method
	***********************************************/
	static function set($string, $controller_method)
	{
		$request = io::url()[0];
		if($request == $string)
		{
			$controller = controller::extract($controller_method)[0];
			$function 	= controller::extract($controller_method)[1];
			if(controller::exist($controller))
			{
				include "application/modules/controller/".$controller.".controller.php";
				if(function_exists($function))
					{
						call_user_func($function);
					}
				else
					{
						error::fatal('2','undefined function called !');
					}
				
			}
			else
			{
				error::fatal('1','undefined controller called');
			}
		}
	}	
}