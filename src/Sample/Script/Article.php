<?php
/**
 * Article Data Generator Script for Theme
 * 
 * @package     Pointless
 * @author      ScarWu
 * @copyright   Copyright (c) 2012-2014, ScarWu (http://scar.simcz.tw/)
 * @link        http://github.com/scarwu/Pointless
 */

use NanoCLI\IO;

class Article {

    /**
     * @var array
     */
    private $list;
    
    public function __construct() {
        $this->list = Resource::get('article');
    }
    
    /**
     * Get List
     *
     * @return array
     */
    public function getList() {
        return $this->list;
    }
    
    /**
     * Generate Data
     *
     * @param string
     */
    public function gen() {
        $count = 0;
        $total = count($this->list);
        $keys = array_keys($this->list);

        $blog = Resource::get('config')['blog'];

        foreach((array)$this->list as $post) {
            IO::writeln("Building article/{$post['url']}");
            
            $post['url'] = "article/{$post['url']}";
            $post['bar']['index'] = $count + 1;
            $post['bar']['total'] = $total;

            if(isset($keys[$count - 1])) {
                $key = $keys[$count - 1];
                $title = $this->list[$key]['title'];
                $url = $this->list[$key]['url'];

                $post['bar']['p_title'] = $title;
                $post['bar']['p_url'] = "{$blog['base']}article/$url";
            }

            if(isset($keys[$count + 1])) {
                $key = $keys[$count + 1];
                $title = $this->list[$key]['title'];
                $url = $this->list[$key]['url'];

                $post['bar']['n_title'] = $title;
                $post['bar']['n_url'] = "{$blog['base']}article/$url";
            }

            $count++;

            $container = bindData($post, THEME . '/Template/Container/Article.php');

            $block = Resource::get('block');
            $block['container'] = $container;

            $ext = [];
            $ext['name'] = "{$post['title']} | {$blog['name']}";
            $ext['keywords'] = "{$blog['keywords']},{$post['keywords']}";
            $ext['url'] = $blog['dn'] . $blog['base'];

            $data = [];
            $data['blog'] = array_merge($blog, $ext);
            $data['block'] = $block;
            
            // Write HTML to Disk
            $result = bindData($data, THEME . '/Template/index.php');
            writeTo($result, TEMP . "/{$post['url']}");

            // Sitemap
            Resource::append('sitemap', $post['url']);
        }
    }
}