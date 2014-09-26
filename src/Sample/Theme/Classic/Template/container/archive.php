<div id="archive">
	<div class="title"><?=$post['title']?></div>
	<?php foreach((array)$post['list'] as $year => $month_list): ?>
	<div class="year_archive">
		<div class="year"><?=$year?></div>
		<?php foreach((array)$month_list as $month => $article_list): ?>
		<div class="month_archive">
			<div class="month"><?=$month?></div>
			<div class="list">
				<?php foreach((array)$article_list as $article): ?>
				<article>
					<span class="title">
						<?=linkTo("{$blog['base']}article/{$article['url']}", $article['title'])?>
					</span>
					<span class="category">
						Category:
						<?=linkTo("{$blog['base']}category/{$article['category']}", $article['category'])?>
					</span>
				</article>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<?php endforeach; ?>
	<div class="bar">
		<span class="new">
			<?=isset($post['bar']['p_url'])
				? linkTo($post['bar']['p_url'], "<< {$post['bar']['p_title']}"): ''?>
		</span>
		<span class="old">
			<?=isset($post['bar']['n_url'])
				? linkTo($post['bar']['n_url'], "{$post['bar']['n_title']} >>"): ''?>
		</span>
		<span class="count">
			<?="{$post['bar']['index']} / {$post['bar']['total']}"?>
		</span>
	</div>
</div>
