<?php

class session
{
	public static function start()
	{
		session_start();
	}

	public static function data($index, $data)
	{
		$_SESSION[$index] = $data;
	}

	public static function get($index)
	{
		return $_SESSION[$index];
	}

	public static function end()
	{
		session_unset();
		session_destroy();
	}
}