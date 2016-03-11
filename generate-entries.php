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
			<h2>Generate Entry</h2>
			<p class="navi"><a href="entry.json">view data</a> | <a href="index.php">view index</a></p>
			<form action="generate-entries.php" method="post" autocomplete="off">
				<div class="title">Post an entry here, then see it in view data.</div>
				<p>Title:</p><p><input type="text" name="title" class="field"></p>
				<input type="email" name="email" class="none">
				<p>Entry:</p><p><textarea cols="40" rows="20" name="body" class="field"></textarea></p>
				<p><input type="submit" value="Submit" name="submit" class="button"></p>
			</form>
		<?php
		class entry {
			public $title = "";
			public $body  = "";
		}
		$doc = $_SERVER['DOCUMENT_ROOT']."/demos/mustache/entry.json";
		if(isset($_POST['submit']) && $_POST['email'] == "") {
			$entry = new entry();
			$entry->title = stripslashes($_POST['title']);
			$entry->body  = stripslashes($_POST['body']);
			$entry->date = date('l, F jS, Y');
			$outputstring = json_encode($entry);
			//first, obtain the data initially present in the text file
			$ini_handle = fopen($doc, "r");
			$ini_contents = str_replace('{"entry" : [', '', fread($ini_handle, filesize($doc)));
			fclose($ini_handle);
			//done obtaining initially present data

			//write new data to the file, along with the old data
			$handle = fopen($doc, "w+");
				$writestring = "{\"entry\" : [\n\t" . strip_tags(stripslashes($outputstring)) . "," . $ini_contents;
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