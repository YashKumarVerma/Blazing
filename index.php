<?php 

// For measuring page generation time
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;

/****************************************************************************
| laod base module
*****************************************************************************/
include "application/core/core.base.php";


/****************************************************************************
| laod extensions
*****************************************************************************/
include "application/extensions/extensions.core.php";


/***************************************************************************
| some environment actions
***************************************************************************/
session::start();


/****************************************************************************
| laod configurations
*****************************************************************************/
include "application/config/config.app.php";


/****************************************************************************
| laod main processor
*****************************************************************************/
include "application/core/core.processor.php";


/****************************************************************************
| laod routes
*****************************************************************************/
include "application/modules/routes.php";

// console($_GET);

// end page generation time
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);
// echo "<hr />";
echo '<p class="foot"> Page generated in '.$total_time.' seconds. </p>';