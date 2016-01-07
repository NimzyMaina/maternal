<?php

require(dirname(__FILE__).'./vendor/autoload.php');//autoload packages
//load config
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

//echo  $host = getenv('DB_HOST');
 echo get_domain();