<?php 

class Route
{
	/***********************************************
	| string : call the controller if this is hit
	| controller :- 
	| 	homepage@main_form where
	|	@main_form : is the method
	***********************************************/
static function set($string , $controller_method)
	{
		$broken_url = explode('/', io::get('url'));
		$broken_string = explode('/', $string);

		$data_to_pass = array();
		$error = 0;

if(count($broken_url) == count($broken_string) && count($_POST) == 0 )
	{
		for ($i=0; $i < count($broken_url); $i++) 
		{ 
			if(strpos($broken_string[$i], '$') !== false) 
			{  
					// array_push($data_to_pass, $broken_url[$i] );
					$broken_string[$i] = str_replace('$', '', $broken_string[$i]);
					$data_to_pass[ $broken_string[$i] ] = $broken_url[$i];  
			}
			else
			{
				if($broken_string[$i] != $broken_url[$i])
				{
					$error++;
				}
			}
		}

		// if all absolute strings matched
		if($error == 0)
		{
			$controller = controller::extract($controller_method)[0];
			$function 	= controller::extract($controller_method)[1];
			if(controller::exist($controller))
			{
				include_once "application/modules/controller/".$controller.".controller.php";
				if(function_exists($function))
					{
						call_user_func($function,$data_to_pass);
					}
				else
					{
						err::fatal('Route : 2','undefined function called !');
					}
				
			}
			else
			{
				err::fatal('Route : 1','undefined controller called');
			}
		}
	}
}

static function post($string , $controller_method)
{
	if(count($_POST) > 0)
	{
				$broken_url = explode('/', io::get('url'));
				$broken_string = explode('/', $string);

				$data_to_pass = array();
				$error = 0;

		if(count($broken_url) == count($broken_string))
			{
				for ($i=0; $i < count($broken_url); $i++) 
				{ 
					if(strpos($broken_string[$i], '$') !== false) 
					{  
							// array_push($data_to_pass, $broken_url[$i] );
							$broken_string[$i] = str_replace('$', '', $broken_string[$i]);
							$data_to_pass[ $broken_string[$i] ] = $broken_url[$i];  
					}
					else
					{
						if($broken_string[$i] != $broken_url[$i])
						{
							$error++;
						}
					}
				}

				// if all absolute strings matched
				if($error == 0)
				{
					$controller = controller::extract($controller_method)[0];
					$function 	= controller::extract($controller_method)[1];
					if(controller::exist($controller))
					{
						include_once "application/modules/controller/".$controller.".controller.php";
						if(function_exists($function))
							{
								call_user_func($function,$data_to_pass);
							}
						else
							{
								err::fatal('Route : 2','undefined function called !');
							}
						
					}
					else
					{
						err::fatal('Route : 1','undefined controller called');
					}
				}
			}

	}
}


}

