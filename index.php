<?php
include('src/Mustache/Autoloader.php');
Mustache_Autoloader::register();
$entry = new Mustache_Engine;
$entry_template = file_get_contents('entry.mustache');
$entry_data = file_get_contents('entry.json');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mustache Demo</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="default.css">
</head>
<body>
<div class="suefeng-demo-navi">
		<a href="http://suefeng.net/?p=165"><strong>&laquo; Previous Demo: </strong>jQuery and jQuery UI Demos</a>
		<span class="right">
			<a href="http://suefeng.net/?p=317"><strong>Back to the Handlebars Article</strong></a>
		</span>
</div>
	<div class="wrapper">
		<h1>Mustache Demo</h1>
		<div class="clearboth"></div>
<?php echo $entry->render($entry_template, json_decode($entry_data, true)); ?>
<?php include('sidebar.php'); ?>
	</div>
</body>
</html>