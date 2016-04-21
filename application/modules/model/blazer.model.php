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

	function __construct($source = "application/public" , $cache = "application/public/blazing_cache")
	{
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

	public function render($file,$data,$re_calculate = FALSE)
	{
		if($re_calculate == FALSE)
		{
			if(file_exists($this->cache . '/' . $file . '.blazing.php'))
			{
				foreach ($data as $index => $value) {
					$$index = $value;
				}
				include_once ($this->cache . '/' . $file . '.blazing.php');
			}
			else
			{
				$this->render($file,$data,TRUE);
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
			
			// {{data}}
			$this->content = str_replace('{{', '<?= $', $this->content);
			$this->content = str_replace('}}', ' ?>', $this->content);

			//  {!data!}
			$this->content = str_replace('{!', ' <?php echo htmlspecialchars($', $this->content);
			$this->content = str_replace('!}', '); ?>', $this->content);
			

			$handle = fopen($this->cache . '/' . $file . '.blazing.php' ,'w');
			fwrite($handle, $this->content);
			fclose($handle);

			// include it man !
			foreach ($data as $index => $value) {
					$$index = $value;
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