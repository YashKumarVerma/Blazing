<?php 

if(isset($argv[1]) && isset($argv[2]) && !isset($argv[3]))
{
	echo "
		==================================================

		Welcome to Blazing Sahayak : controllers !


		Arguments:-

		~ php sahayak controller create <controller name>
		~ php sahayak controller delete <controller name>

		";
}




if(isset($argv[1]) && isset($argv[2]) && isset($argv[3]) )
{

	// to create controller
	if($argv[1] == "controller" && $argv[2] == "create" )
	{
		// create new file
		$file = fopen("application/modules/controller/".$argv[3].".controller.php", "w");
		
		// load template of controller
		$content = file_get_contents("application/sahayak/sahayak_templates/sahayak.resource.ykv");
		
		// write template into new controller 
		fwrite($file, $content);

		// close the file
		fclose($file);

		echo "
		Controller Named " . $argv[3] . " successfully created.
		";
	}

	if($argv[1] == "controller" && $argv[2] == "delete" )
	{
		if(unlink("application/modules/controller/".$argv[3].".controller.php"))
		{
			echo "
			Controller Named " . $argv[3] . "was successfully deleted
			";
		}
		else
		{
			echo "
			Error in Deleting Controller
			";
		}
	}

}




?>


