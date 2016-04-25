<?php

//  This file loads all sahayak components which exist as separate files

// print_r($argv);

if(count($argv) == 1)
{
	include "components/no_para_passed_home.php";
}


if(isset($argv[1]) && $argv[1] == 'controller')
{
	include "components/sahayak.component.domain.controller.php";
}

if(isset($argv[1]) && $argv[1] == 'blazer' )
{
	include "components/sahayak.component.domain.blazer.php";
}