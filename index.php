<?php

require(dirname(__FILE__).'./vendor/autoload.php');//autoload packages
//load config
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

//requiring configs
$dotenv->required(['DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD','SITE_URL']);

//echo  $host = getenv('DB_HOST');
// echo get_domain();

$extras = array('#special_id','.special_class');
echo anchor('test.php','New Page','Custom Title Message!',$extras);