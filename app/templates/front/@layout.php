<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $head_title; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="alternate" type="application/rss+xml" href="<?php echo URL_WEB . '/rss.php'; ?>">
		<?php echo $head_content ?>
    </head>
    <body>
        <div id="page-wrapper">
            <div id="page">			   
                <div id="header">
                    <h1>Flyparti - letecká společnost</h1>
                    <h2>Letani nas bavi</h2>                   
					<?php echo 'Dnes je: ' . date('d. n. Y'); ?>
                </div>

                <div id="menu-box">
					<?php echo $content_menu_box; ?>
                </div>
                <div id="content-wrapper">
					<?php echo $content_wrapper; ?>                    
                </div>

                <div id="side-wrapper">					
					<div class="box">
						<?php echo isset($content_side_wrapper) ? $content_side_wrapper : '' ?>
                    </div>
					<object width="173" height="69" data="<?php echo URL_WEB . '/flash/hodiny.swf'; ?>" />
                </div>
            </div>
        </div>
    </body>
</html>

