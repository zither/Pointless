<?php
$config = [
    'blog' => [
        'name' => 'MiniThinker',
        'slogan' => '努力学习那些想要知道的东西',
        'footer' => 'Powered By <a href="https://github.com/scarwu/Pointless">Pointless</a>',
        'description' => '记录在生活以及自学编程过程中好玩的东西。',
        'keywords' => 'MiniThinker, Programming, Computer, PHP, Scheme',
        
        'lang' => 'zh-cn', // en | zh-tw | zh-cn | other

        'dn' => 'blog.minimee.org',
        'base' => '/',

        'author' => 'Minimee',
        'email' => NULL,
        
        'disqus_shortname' => NULL, // Disqus Shortname
        'google_analytics' => NULL, // Google Analytics - UA-xxxxxxxx-x
    ],

    'theme' => 'Classic',

    'feed_quantity' => 5,
    'article_quantity' => 5,

	// :year, :month, :day
	// :hour, :minute, :second, :timestamp
	// :title, :url
    'article_url' => ':year/:month/:day/:url',

    // Reference: http://php.net/manual/en/timezones.php
    'timezone' => 'Asia/Shanghai',

    'github' => [
        'account' => 'zither',
        'repo' => 'zither.github.com',
        'branch' => 'master',
        'cname' => true
    ],

    // synchronize raw files
    'synchronize_raw_md' => true,

    // Reference: http://php.net/manual/en/function.iconv.php
    // Big5 | GBK | other => UTF-8
    'encoding' => 'utf-8',

    'editor' => 'vim'
];
