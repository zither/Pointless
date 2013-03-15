<?php
/**
 * Pointless Gen JS Command
 * 
 * @package		Pointless
 * @author		ScarWu
 * @copyright	Copyright (c) 2012-2013, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/Pointless
 */

namespace Pointless\Gen;

use NanoCLI\Command;
use NanoCLI\IO;
use Compress;

class Js extends Command {
	public function __construct() {
		parent::__construct();
	}
	
	public function run() {
		require LIBRARY . 'Compress.php';
		
		IO::writeln("Clean Javascript ...", 'yellow');
		if(file_exists(PUBLIC_FOLDER . 'main.js'))
			unlink(PUBLIC_FOLDER . 'main.js');

		IO::writeln("Compress Javascript ...", 'yellow');
		$Compress = new Compress();
		$Compress->js(THEME_JS, PUBLIC_FOLDER . 'theme');
	}
}