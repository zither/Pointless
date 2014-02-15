<?php
/**
 * Built-in Web Server Route
 * 
 * @package		Pointless
 * @author		ScarWu
 * @copyright	Copyright (c) 2012-2014, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/Pointless
 */

define('BLOG', $_SERVER['DOCUMENT_ROOT'] . '/Blog');

require BLOG . '/Config.php';
$path = BLOG . '/Temp';

$pattern = '/^' . str_replace('/', '\/', $config['blog_base']) . '/';
if(!preg_match($pattern, $_SERVER['REQUEST_URI']))
	header("Location:http://{$_SERVER['HTTP_HOST']}" . $config['blog_base']);

$pattern = '/^' . str_replace('/', '\/', $config['blog_base']) . '(.+)/';
if(preg_match($pattern, $_SERVER['REQUEST_URI'], $match))
	$path .= urldecode($match[1]);

$path .= is_dir($path) ? '/index.html' : '';

if(preg_match('/\.css$/', $path))
	header('Content-type: text/css');

if(preg_match('/\.js$/', $path))
	header('Content-type: text/javascript');

if(file_exists($path)) {
	echo file_get_contents($path);
	return TRUE;
}

return FALSE;