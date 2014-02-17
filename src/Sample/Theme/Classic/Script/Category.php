<?php
/**
 * Category Data Generator Script for Theme
 * 
 * @package     Pointless
 * @author      ScarWu
 * @copyright   Copyright (c) 2012-2014, ScarWu (http://scar.simcz.tw/)
 * @link        http://github.com/scarwu/Pointless
 */

use NanoCLI\IO;

class Category {

    /**
     * @var array
     */
    private $list;
    
    public function __construct() {
        $this->list = array();
        
        foreach(Resource::get('article') as $value) {
            if(!isset($this->list[$value['category']]))
                $this->list[$value['category']] = array();

            $this->list[$value['category']][] = $value;
        }

        uasort($this->list, function($a, $b) {
            if (count($a) == count($b))
                return 0;

            return count($a) > count($b) ? -1 : 1;
        });
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
        $first = NULL;
        $count = 0;
        $total = count($this->list);
        $key = array_keys($this->list);

        $config = Resource::get('config');
        
        foreach((array)$this->list as $index => $article_list) {
            IO::writeln("Building category/$index");
            if(NULL == $first) {
                $first = $index;
            }

            $data = [];
            $data['title'] ="Category: $index";
            $data['path'] = "category/$index";
            $data['list'] = $this->createDateList($article_list);
            
            // Extend Data
            $data['name'] = "{$data['title']} | {$config['blog_name']}";
            $data['header'] = $config['blog_name'];
            $data['slogan'] = $config['blog_slogan'];
            $data['description'] = $config['blog_description'];
            $data['keywords'] = $config['blog_keywords'];
            $data['footer'] = $config['blog_footer'];
            $data['dn'] = $config['blog_dn'];
            $data['base'] = $config['blog_base'];
            $data['url'] = $config['blog_dn'] . $config['blog_base'];
            $data['lang'] = $config['blog_lang'];
            $data['author'] = $config['author_name'];
            $data['email'] = $config['author_email'];
            $data['google_analytics'] = $config['google_analytics'];
            $data['disqus_shortname'] = $config['disqus_shortname'];

            // Bar
            $data['bar']['index'] = $count + 1;
            $data['bar']['total'] = $total;
            
            if(isset($key[$count - 1])) {
                $data['bar']['p_title'] = $key[$count - 1];
                $data['bar']['p_path'] = "{$data['base']}category/" . $key[$count - 1];
            }

            if(isset($key[$count + 1])) {
                $data['bar']['n_title'] = $key[$count + 1];
                $data['bar']['n_path'] = "{$data['base']}category/" . $key[$count + 1];
            }
            
            $count++;

            $container = bindData($data, THEME . '/Template/Container/Category.php');

            $data['block'] = Resource::get('block');
            $data['block']['container'] = $container;
            
            // Write HTML to Disk
            $result = bindData($data, THEME . '/Template/index.php');
            writeTo($result, TEMP . "/{$data['path']}");

            // Sitemap
            Resource::append('sitemap', $data['path']);
        }

        if(file_exists(TEMP . "/category/$first/index.html")) {
            copy(TEMP . "/category/$first/index.html", TEMP . "/category/index.html");
            Resource::append('sitemap', 'category');
        }
    }

    private function createDateList($list) {
        $result = [];

        foreach((array)$list as $article) {
            if(!isset($result[$article['year']])) {
                $result[$article['year']] = [];
            }

            if(!isset($result[$article['year']][$article['month']])) {
                $result[$article['year']][$article['month']] = [];
            }

            $result[$article['year']][$article['month']][] = $article;
        }

        return $result;
    }
}
