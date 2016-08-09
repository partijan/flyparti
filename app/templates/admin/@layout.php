<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $head_title; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		<script src="?ref=<?php echo JS_REFRESH ?>"></script>
		<link rel="stylesheet" type="text/css" href="../css/reset.css?ref=<?php echo CSS_REFRESH; ?>"/>
		<link rel="stylesheet" type="text/css" href="../css/admin/layout.css?ref=<?php echo CSS_REFRESH; ?>"/>
		<link rel="stylesheet" type="text/css" href="../css/forms.css?ref=<?php echo CSS_REFRESH; ?>"/>

	</head>

	<body>
		<div id="page-wrapper">
			<div id="page">			   
				<div id="header">
					<h1>Flyparti - admin: <?php echo $head_title ?></h1>
				</div>
                <div id="content-wrapper">
					<?php echo $content_wrapper; ?>
                </div>

				<div id="side-wrapper">

					<div id="menu-box">
						<?php echo $content_menu_box; ?>
					</div>
				</div>
			</div>
		</div>

	</body>
</html>
