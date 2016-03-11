<?php
$links = new Mustache_Engine;
$links_template = file_get_contents('links.mustache'); 
$links_data = file_get_contents('links.json'); 
echo $links->render($links_template, json_decode($links_data, true)); ?> 