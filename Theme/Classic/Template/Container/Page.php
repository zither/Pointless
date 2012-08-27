<div id="page">
	<?php
	foreach((array)$data['article_list'] as $index => $article_info) {
		echo '<article>';
		echo '<div class="title">' . link_to(BLOG_PATH.'article/'.$article_info['url'], $article_info['title']) . '</div>';
		echo '<div class="info">';
		echo '<span class="date">Date: ' . $article_info['date'] . '</span>';
		echo '</div>';
		echo '<div class="content">' . preg_replace('/<!--more-->(.|\n)*/', '', $article_info['content']) . '</div>';
		echo '<a class="more" href="' . BLOG_PATH . 'article/' . $article_info['url'] . '">Read more ...</a>';
		echo '</article>';
		echo '<hr>';
	}
	
	$bar = sprintf('<span class="count">< %d / %d ></span>', $data['bar']['index'], $data['bar']['total']);
	if($data['bar']['total'] != 1) {
		if($data['bar']['index'] == 1)
			$bar .= sprintf('<span class="new"></span><span class="old"><a href="/page/%d">Older Posts >></a></span>', $data['bar']['index']+1);
		elseif($data['bar']['index'] == $data['bar']['total'])
			$bar .= sprintf('<span class="new"><a href="/page/%d"><< Newer Posts</a></span><span class="old"></span>', $data['bar']['index']-1);
		else {
			$bar .= sprintf('<span class="new"><a href="/page/%d"><< Newer Posts</a></span>', $data['bar']['index']-1);
			$bar .= sprintf('<span class="old"><a href="/page/%d">Older Posts >></a></span>', $data['bar']['index']+1);
		}
	}
	?>
	<div class="bar"><?php echo $bar; ?></div>
</div>