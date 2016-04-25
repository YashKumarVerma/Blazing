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
			

			//  {!data!}
			$this->content = str_replace('{!', ' <?php echo htmlspecialchars($', $this->content);
			$this->content = str_replace('!}', '); ?>', $this->content);
			
			// {{@url}}
			$this->content = str_replace('{{@url', '<?php echo $GLOBALS["protected"]["app"]["url"]' , $this->content);
			
			// {{@name}}
			$this->content = str_replace('{{@name', '<?php echo $GLOBALS["protected"]["app"]["name"]', $this->content);

			// 	{.home.css.} -> loa css like a boss
			$this->content = str_replace('{.', '<?php blazer::css("', $this->content);
			$this->content = str_replace('.}', '"); ?>', $this->content);

			// {#file.js#}
			$this->content = str_replace('{#', '<?php blazer::script("', $this->content);
			$this->content = str_replace('#}', '"); ?>', $this->content);

			// {auto(bootstrap.json)}
			$this->content = str_replace('{plugin(', '<?php blazer::plugin("', $this->content);
			$this->content = str_replace(')}', '"); ?>', $this->content);

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

	static function script($link)
	{
		echo '<script type="text/javascript" src="'.$GLOBALS['protected']['app']['assets']['js'].$link.'"></script>';
	}

	static function plugin($plugin_autoload_file)
	{
		if(file_exists("assets/plugins/".$plugin_autoload_file))
		{
			$content = file_get_contents("assets/plugins/".$plugin_autoload_file);
			$content = json_decode($content,TRUE);
			foreach($content['css'] as $css){
				echo '<link rel="stylesheet" type="text/css" href="'.$css.'">  '; 
			}
			foreach ($content['js'] as $js){
					echo '<script type="text/javascript" src="'.$js.'"></script>';
			}
		}
		else
		{
			echo "AUTOLOAD FILE NOT FOUND !";		
		}
	}

	static function css($link)
	{
		echo '<link rel="stylesheet" type="text/css" href="'.$GLOBALS['protected']['app']['assets']['css'].$link.'">';
	}

}

/*
model::load('database');

	$data = ['username' => $username];

	$view = new blazer();
	$view->render('profile.html',$data,TRUE);

*/