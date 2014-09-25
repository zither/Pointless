<?php
/**
 * Sitemap Generator Extension
 * 
 * @package     Pointless
 * @author      ScarWu
 * @copyright   Copyright (c) 2012-2014, ScarWu (http://scar.simcz.tw/)
 * @link        http://github.com/scarwu/Pointless
 */

use NanoCLI\IO;

class Robots {

    /**
     * Run Generator
     */
    public function run() {
        IO::writeln('Building Robots.txt');

        $robots = Resource::get('config')['robots'];
        // 没有设置 robots 则直接返回
        if (empty($robots)) return true;

        $robotsContent = null;
        foreach ($robots as $rule) {
            $robotsContent .= "User-agent: {$rule['User-agent']}\n";
            if (!empty($rule['Allow'])) {
                foreach ($rule['Allow'] as $allow) {
                    $robotsContent .= "Allow: {$allow}\n";
                }
            }
            if (!empty($rule['Disallow'])) {
                foreach ($rule['Disallow'] as $disallow) {
                    $robotsContent .= "Disallow: {$disallow}\n";
                }
            }
            $robotsContent .= "\n";
        }

        writeTo($robotsContent, TEMP . '/robots.txt');
    }
}
