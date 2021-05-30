<?php 
date_default_timezone_set ('Asia/Tbilisi');

$db['db_host'] = 'localhost'; 
$db['db_user'] = 'root';
$db['db_pass'] = 'Asfajo21';
$db['db_name'] = 'onl_shop921';


foreach ($db as $key => $value) {
define(strtoupper($key), $value);
}
$c = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
?>
