<?php

require_once __DIR__.'/../lib/MyAutoloader.php';

spl_autoload_register('MyAutoloader::controllersLoader');
spl_autoload_register('MyAutoloader::includesLoader');
spl_autoload_register('MyAutoloader::classLoader');
