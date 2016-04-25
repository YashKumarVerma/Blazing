

==================================================

Welcome to Blazing Sahayak : controllers !


Arguments:-

~ php sahayak controller create <controller name>



<?php 

if(isset($argv[1]) && isset($argv[2]) && isset($argv[3]) )
{

		fopen("application/modules/controller/".$argv[3].".controller.php", "w");

}

?>


