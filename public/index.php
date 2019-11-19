<?php

require_once('../includes/autoload.php');
require_once('../includes/routs.php');

$url = strtok($_SERVER['REQUEST_URI'],'?');
if(! isset($routs[$url])) {
    http_response_code(404);
    include('../views/error_404.php');
    die();
}
$controller = new $routs[$url];
$controller->index();
