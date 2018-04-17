<?php 
/***************************************
Sahayak 2.0

The Command Line Tool for Blazing
*****************************************/
$slug           = explode('/', $argv[2]);
$controller     = $argv['1'];
$method         = "";
$parameterList  = [];
$routeLine     = PHP_EOL."Route::"; 
$controllerLine = PHP_EOL;

// if post request
if($argc == 4){
    $routeLine.= "post('";
}else{
    $routeLine.= "set('";
}

// get param list and method
foreach($slug as $node){
    if(strpos($node, '$') !== false){
        array_push($parameterList,$node);
    }
    else{
        $method.=ucwords($node);
    }
}

/// line to add to routes
$routeLine.=$argv[2].'\',\''.$controller.'@'.$method.'\');';


// CONTROLLER DATA
$controllerLine .= "function ".$method."(\$url){".PHP_EOL;
foreach($parameterList as $node){
    $controllerLine.= "\t".$node." = \$url['".$node."'];".PHP_EOL;
}
$controllerLine.= PHP_EOL."}";


// Writing route
$handle = file_get_contents("application/modules/routes.php");
file_put_contents("application/modules/routes.php",$handle.$routeLine);

// writing controller
if(!file_exists("application/modules/controller/".$controller.".controller.php")){
    $handle = fopen("application/modules/controller/".$controller.".controller.php","w");
    fclose($handle);
    $controllerLine = "<?php ".PHP_EOL.PHP_EOL.$controllerLine.PHP_EOL;
}

$handle = file_get_contents("application/modules/controller/".$controller.".controller.php");
file_put_contents("application/modules/controller/".$controller.".controller.php",$handle.$controllerLine);
