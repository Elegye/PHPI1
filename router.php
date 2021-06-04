<?php
// router.php

// Get the url path and trim leading slash
$url_path = trim($_SERVER['REQUEST_URI'], '/');
$_GET['route'] = $url_path;

// If url_path is empty, it is root, so call index.html
if ( ! $url_path ) {
    $_GET['route'] = "index";
    include("./public/index.php");
    return;
}

// If url_path has no dot, it is a post permalink, so add .html extension
if(!preg_match('/[.]/', $url_path)) {
    var_dump($_GET);
    include("./public/index.php");
    return;
}

// In case of css files, add the appropriate header
if( preg_match( '/[.css]/', $url_path ) ) {
    header("Content-type: text/css");
    include("./public/".$url_path);
}