<?php

class Category {
	private $_list;
	
	public function __construct() {
		$this->_list = array();
	}
	
	public function add($article) {
		if(!isset($this->_list[$article['category']]))
			$this->_list[$article['category']] = array();
		$this->_list[$article['category']][] = $article;
	}
	
	public function getList() {
		return $this->_list;
	}
	
	public function sortList() {
		$this->_list = count_sort($this->_list);
	}
	
	public function gen($slider) {
		$max = array(0, NULL);
		$count = 0;
		$total = count($this->_list);
		$key = array_keys($this->_list);
		
		foreach((array)$this->_list as $index => $article_list) {
			NanoIO::Writeln(sprintf("Building category/%s", $index));
			$max = count($article_list) > $max[0] ? array(count($article_list), $index) : $max;
			
			$output_data['bar'] = array();
			$output_data['bar']['index'] = $count+1;
			$output_data['bar']['total'] = $total;
			if(isset($key[$count-1]))
				$output_data['bar']['prev'] = array(
					'title' => $key[$count-1],
					'url' => $key[$count-1]
				);
			if(isset($key[$count+1]))
				$output_data['bar']['next'] = array(
					'title' => $key[$count+1],
					'url' => $key[$count+1]
				);
			
			$count++;
			
			$output_data['title'] ='Category: ' . $index;
			$output_data['article_list'] = $article_list;
			$output_data['container'] = bind_data($output_data, THEME_TEMPLATE . 'Container' . SEPARATOR . 'Category.php');
			$output_data['slider'] = $slider;
			
			$result = bind_data($output_data, THEME_TEMPLATE . 'index.php');
			write_to($result, BLOG_PUBLIC_CATEGORY . $index);
		}
		
		if(file_exists(BLOG_PUBLIC_CATEGORY . $max[1] . SEPARATOR . 'index.html'))
			copy(BLOG_PUBLIC_CATEGORY . $max[1] . SEPARATOR . 'index.html', BLOG_PUBLIC_CATEGORY . 'index.html');
	}
}