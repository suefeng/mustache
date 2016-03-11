<?php
include('src/Mustache/Autoloader.php');
Mustache_Autoloader::register();
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
		<div class="entries">
			<h2>Generate Link</h2>
			<p class="navi"><a href="links.json">view data</a> | <a href="index.php">view index</a></p>
			<form action="generate-links.php" method="post" autocomplete="off">
				<div class="title">Post a link here, then see it in view data.</div>
				<p>Link URL:</p><p><input type="text" name="linkUrl" class="field"></p>
				<p>Link Name:</p><p><input type="text" name="linkName" class="field"></p>
				<p><input type="submit" value="Submit" name="submit" class="button"></p>
			</form>
		<?php 
		class link {
			public $linkUrl = "";
			public $linkName  = "";
		}
		$doc =  $_SERVER['DOCUMENT_ROOT']."/demos/mustache/links.json";
		if(isset($_POST['submit'])) {
			$link = new link();
			$link->linkUrl = stripslashes($_POST['linkUrl']);
			$link->linkName  = stripslashes($_POST['linkName']);
			$outputstring = json_encode($link);
			//first, obtain the data initially present in the text file 
			$ini_handle = fopen($doc, "r"); 
			$ini_contents = str_replace('{"links" : [', '', fread($ini_handle, filesize($doc))); 
			fclose($ini_handle); 
			//done obtaining initially present data 
		   
			//write new data to the file, along with the old data 
			$handle = fopen($doc, "w+"); 
				$writestring = "{\"links\" : [\n\t" . strip_tags(stripslashes($outputstring)) . "," . $ini_contents; 
				if (fwrite($handle, $writestring) === false) { 
					echo "Cannot write to text file. <br />";           
				} 
				else { echo "<div class=\"entries\">Success!</div>"; }
			fclose($handle); 
			unset($_POST['submit']);
		} ?>
		</div>
<?php include('sidebar.php'); ?>	 
	</div>
</body>
</html>