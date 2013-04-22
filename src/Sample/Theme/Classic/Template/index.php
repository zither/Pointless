<!doctype html>
<html lang="<?=BLOG_LANG?>" class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?=isset($data['title']) ? $data['title'] . ' | ' : NULL?><?=BLOG_NAME?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Load Cascading Style Sheets -->
	<link rel="stylesheet" href="<?=BLOG_PATH?>theme/main.css">
</head>
<body>
	<div id="main">
		<div class="border">
			<header>
				<hgroup>
					<h1><?=linkTo(BLOG_PATH, BLOG_NAME)?></h1>
					<h2><?=BLOG_SLOGAN?></h2>
				</hgroup>
			</header>
			<div id="nav">
				<a class="search" href="javascript:void(0);">Search
					<form action="http://www.google.com/search?q=as" target="_blank" method="get">
						<input type="hidden" name="q" value="site:<?=BLOG_DNS?>" />
						<input type="text" name="q" />
						<input type="submit" />
					</form>
				</a>
				<a href="<?=BLOG_PATH?>">Home</a>
				<a href="<?=BLOG_PATH . 'about'?>">About</a>
			</div>
			<div id="container"><?=$data['block']['container'] ?></div>
			<div id="side"><?=$data['block']['side'] ?></div>
			<footer><?=BLOG_FOOTER?></footer>
		<div>
	</div>
	<!-- Define and Load Javascript -->
	<script src="<?=BLOG_PATH?>theme/main.js"></script>
	<?php if(GOOGLE_ANALYSTIC): ?>
	<script>
		var _gaq = [['_setAccount', '<?=GOOGLE_ANALYSTIC?>'], ['_trackPageview']]; (function(d, t) {
			var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
			g.src = ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js';
			s.parentNode.insertBefore(g, s)
		} (document, 'script'));
	</script>
	<?php endif; ?>
</body>
</html>