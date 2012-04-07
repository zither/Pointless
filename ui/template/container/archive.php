<?php
$temp = array();
foreach((array)$data['article_list'] as $index => $article_info) {
	if(!isset($temp[$article_info['month']]))
		$temp[$article_info['month']] = array();
	array_push($temp[$article_info['month']], $article_info);
}
?>

<div id="archive">
	<div class="title"><?php echo $data['title']; ?></div>
	<?php
	echo '<div class="month">';
	foreach((array)$temp as $month => $article_list) {
		echo '<div>' . $month . '</div>';
		echo '<div>';
		foreach((array)$article_list as $info) {
			echo '<article>';
			echo '<span>' . $info['title'] . '</span>';
			// echo '<footer>';
			echo '<span>Category: ' . $info['category'] . '</span>';
			// echo '</footer>';
			echo '</article>';
		}
		echo '</div>';
	}
	echo '</div>';
	?>
</div>