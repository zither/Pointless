<?php
/**
 * Pointless Deploy Command
 * 
 * @package     Pointless
 * @author      ScarWu
 * @copyright   Copyright (c) 2012-2014, ScarWu (http://scar.simcz.tw/)
 * @link        http://github.com/scarwu/Pointless
 */

namespace Pointless;

use NanoCLI\Command;
use NanoCLI\IO;
use Resource;

class DeployCommand extends Command {
    public function __construct() {
        parent::__construct();
    }
    
    public function run() {
        $github = Resource::get('config')['github'];

        $account = $github['account'];
        $repo = $github['repo'];
        $branch = $github['branch'];
        
        if(NULL == $account || NULL == $repo || NULL == $branch) {
            IO::writeln('Please add Github setting in Pointless config.', 'red');
            return;
        }

        chdir(DEPLOY);

        if(!file_exists(DEPLOY . '/.git')) {
            system('git init');
            system("git remote add origin git@github.com:$account/$repo.git");
        }

        system("git pull origin $branch");

        recursiveRemove(DEPLOY);
        recursiveCopy(TEMP, DEPLOY);

        system('git add --all .');
        system(sprintf('git commit -m "%s"', date(DATE_RSS)));
        system("git push origin $branch");
    }
}
