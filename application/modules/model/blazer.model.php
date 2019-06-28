<?php
/*
*@author : Yash Kumar Verma
*@url : https://github.com/YashKumarVerma/Blazing
*@note : Integrated Blazing Templating Engine (Fastest Engine)
*/


// change class name as you want to access it
class blazer
{
	// $source contains directory of source files
	var $source;
	// $cache contains directory of cache
	var $cache;
	// re-calculating render
	var $content;

	function __construct($source = "application/public" , $cache = "application/public/blazing_compiled")
	{
		// if cache directory does not exist
		if(!file_exists($cache))
			mkdir($cache);

		$this->source = $source;
		$this->cache = $cache;
	}

	// if you want to set  source folder somewhere else, use this function
	public function source($i)
	{
		$this->source = $i;
	}

	// if want to set cache to somewhere else, use this function 
	public function cache($i)
	{
		$this->cache = $i;
	}

	public function render($file,$data,$turbo = FALSE)
	{
		if($turbo == TRUE)
		{
			if(file_exists($this->cache . '/' . $file . '.blazing.php'))
			{
				if(is_array($data))
				{
					foreach ($data as $index => $value) {
					$$index = $value;
					}
				}
				include_once ($this->cache . '/' . $file . '.blazing.php');
			}
			else
			{
				$this->render($file,$data,FALSE);
			}
		}
		else
		{
			// delete if another instance exist
			if(file_exists($this->cache . '/' . $file . '.blazing.php'))
			{
				unlink($this->cache . '/' . $file . '.blazing.php');
			}

			// calculating again !
			$this->content = file_get_contents($this->source . '/' . $file);
			

/*************************************
 DECLARE TEMPLATES IN CORE PHP HERE 
 *************************************/
			//  {!data!}
			$this->content = str_replace('{!', ' <?php echo htmlspecialchars($', $this->content);
			$this->content = str_replace('!}', '); ?>', $this->content);
			
			// {{@url}}
			$this->content = str_replace('{{@url', '<?php echo $GLOBALS["protected"]["app"]["url"]' , $this->content);
			
			//  {{@name}}
			$this->content = str_replace('{{@name', '<?php echo $GLOBALS["protected"]["app"]["name"]' , $this->content);

			// {{@adminName}}
			$this->content = str_replace('{{@adminName', '<?php echo $GLOBALS["protected"]["app"]["admin"]["name"]' , $this->content);
			
			// {{@adminEmail}}
			$this->content = str_replace('{{@adminEmail', '<?php echo $GLOBALS["protected"]["app"]["admin"]["email"]' , $this->content);

			// {{@adminContact}}
			$this->content = str_replace('{{@adminContact', '<?php echo $GLOBALS["protected"]["app"]["admin"]["contact"]' , $this->content);

			//  {{@subname}}
			$this->content = str_replace('{{@subname', '<?php echo $GLOBALS["protected"]["app"]["subname"]' , $this->content);

			// 	{.home.} -> load css like a boss
			$this->content = str_replace('{.', '<link rel="stylesheet" type="text/css" href="'.$GLOBALS['protected']['app']['assets']['css'], $this->content);
			$this->content = str_replace('.}', '.css"> ', $this->content);

			// {#file#} -> load js like a boss
			$this->content = str_replace('{#', '<script type="text/javascript" src="'.$GLOBALS['protected']['app']['assets']['js'], $this->content);
			$this->content = str_replace('#}', '.js"></script>', $this->content);

			// {auto(bootstrap.json)}
			$this->content = str_replace('{plugin(', '<?php blazer::plugin("', $this->content);
			$this->content = str_replace(')}', '"); ?>', $this->content);

/* CUSTOM TEMPLATES START */

/* CUSTOM TEMPLATES ENDS */

			// {{data}}
			$this->content = str_replace('{{', '<?= $', $this->content);

			// for closing
			$this->content = str_replace('}}', ' ?>', $this->content);

			
			$handle = fopen($this->cache . '/' . $file . '.blazing.php' ,'w');
			fwrite($handle, $this->content);
			fclose($handle);

			// include it man !
			if(is_array($data))
			{
				foreach ($data as $index => $value) {
					$$index = $value;
				}
			}
			include_once ($this->cache . '/' . $file . '.blazing.php');
		}
	}
}

/*
model::load('database');

	$data = ['username' => $username];

	$view = new blazer();
	$view->render('profile.html',$data,TRUE);

*/
