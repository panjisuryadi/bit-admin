<?php
$routes = array();
// CUSTOMERS
$routes['customers']['GET'][''] = $controllers.'customers|lists';
$routes['customers']['GET']['id'] = $controllers.'customers|details';
$routes['customers']['POST']['indexs'] = $controllers.'customers|indexs';
$routes['customers']['POST']['inserts'] = $controllers.'customers|inserts';
$routes['customers']['POST']['updates'] = $controllers.'customers|updates';
$routes['customers']['POST']['deletes'] = $controllers.'customers|deletes';


function get_route(){
    global $routes;
    global $method;
    global $uri;
    global $cmd;
    global $id;

    $explode    = explode('/', $uri);
    $count      = count($explode);

    $module  = $explode[$count-1];
    if(is_numeric($explode[$count-1])){
        $id     = $explode[$count-1];
        $module = $explode[$count-2];
        $cmd    = 'id';
    }

    $routing    = $routes[$module][$method][$cmd] ? $routes[$module][$method][$cmd] : die('errors');
    $explode    = explode('|', $routing);
    $req        = $explode[0];
    $fun        = $explode[1];

    require $req.'.php';
    $ret        = $fun($id);
    
    return $ret;
}