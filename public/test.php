<?php

require 'rb-mysql.php';
$db=require '../config/config_db.php';
R::setup($db['dsn'], $db['user'], $db['pass']);
var_dump(R::testConnection());