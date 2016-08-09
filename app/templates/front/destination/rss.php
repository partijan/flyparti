<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<title>Flyparti</title>
		<atom:link href="<?php echo URL_WEB ?>/rss.php" rel="self" type="application/rss+xml" />
		<link><?php echo URL_WEB; ?></link>
		<description>Flyparti-létaní nás baví</description>
		<lastBuildDate><?php echo gmdate("D, d M Y H:i:s") . " GMT"; ?></lastBuildDate>
		<language>cs</language>	
		<pubDate><?php echo gmdate("D, d M Y H:i:s") . " GMT"; ?></pubDate>

		<?php
		foreach ($destinations as $destination)
		{
			$dtCreated = date_create($destination['dtCreated']);
			?>
			<item>
				<title><?php echo $destination['title'] ?></title>
				<guid><?php echo URL_WEB ?>/destinace.php?idDestinace=<?php echo $destination['id'] ?></guid>
				<description><?php echo htmlspecialchars(strip_tags($destination['briefDescription'])); ?></description>
			</item>
<?php } ?>
	</channel>
</rss>