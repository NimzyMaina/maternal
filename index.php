<?php

require(dirname(__FILE__).'./vendor/autoload.php');//autoload packages
//load config
$db = new Database();
$db->getConnection();



//echo  $host = getenv('DB_HOST');
// echo get_domain();


$extras = array('#special_id','.special_class','_blank');
echo anchor('test.php','New Page','Custom Title Message!',$extras);
