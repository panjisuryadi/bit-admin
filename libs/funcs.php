<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
// ini_set('display_errors',1);
// error_reporting(E_ALL);
// setlocale(LC_ALL, 'en_US.UTF8');
// header("Content-type: application/json;  charset=utf-8");
ini_set("max_execution_time", 30);

function regs($val, $def = '') {
    return $_POST[$val]   ?? 
           $_GET[$val]    ?? 
           $_FILES[$val]  ?? 
           $_COOKIE[$val] ?? 
           $_SERVER[$val] ?? 
           $def;
}

function convert_phone(){
    
}

function validate_email($email){
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function layouts($part, $data=[]){
    global $views;
    extract($data);
    logs($views.$part.'.php');
    require $views.$part.'.php';
}

function logs($teks){
    $basename   = $_SERVER["SCRIPT_FILENAME"];
    $basename   = explode('/', $basename);
    $nama   = 'error_'.str_replace('.php', '', end($basename));
    $bt     = debug_backtrace();
    $caller = array_shift($bt);
    $line   = $caller['line'];
    $jamtgl = date("YmdHis");
    $date   = date("Ymd");
    $green  = "\033[32m";
    $red    = "\033[31m";
    $reset  = "\033[0m";
    $teksna = $green . $jamtgl . $reset . '|' . $red . $line . $reset . '= ' . $teks . PHP_EOL;
    $myfile = fopen("./logs/".$date.'_'.$nama.".log", "a+") or die("Unable to open file!");
    
    fwrite($myfile, $teksna);

    fclose($myfile);
    return true;
}

function errors($teks){
    $basename   = $_SERVER["SCRIPT_FILENAME"];
    $basename   = explode('/', $basename);
    $nama   = 'error_'.str_replace('.php', '', end($basename));
    $bt     = debug_backtrace();
    $caller = array_shift($bt);
    $line   = $caller['line'];
    $jamtgl = date("YmdHis");
    $date   = date("Ymd");
    $green  = "\033[32m";
    $red    = "\033[31m";
    $reset  = "\033[0m";
    $teksna = $green . $jamtgl . $reset . '|' . $red . $line . $reset . '= ' . $teks . PHP_EOL;
    $myfile = fopen("./errors/".$date.'_'.$nama.".log", "a+") or die("Unable to open file!");
    
    fwrite($myfile, $teksna);

    fclose($myfile);
    return true;
}

function api_post($url, $data){
    $payload = json_encode($data);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = trim(curl_exec($ch));
    curl_close($ch);
    return $result;
}

function api_post_header($url, $data, $bearer_token = null){
  $payload = json_encode($data);
  $ch = curl_init($url);

  $headers = array('Content-Type: application/json');

  if ($bearer_token) {
      $headers[] = 'Authorization: Bearer ' . $bearer_token;
  }

  curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
  curl_setopt($ch, CURLOPT_HEADER, 0); // or 1 if you need headers in the response
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Add this line to disable SSL verification (for development/testing ONLY)
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Add this line to disable SSL verification (for development/testing ONLY)

  $result = curl_exec($ch);
  if (curl_errno($ch)) { // Check for cURL errors
      $error_message = curl_error($ch);
      curl_close($ch);
      return "cURL Error: " . $error_message; // Return the error message
  }
  curl_close($ch);
  return $result;
}

function api_delete($url, $data = null) {
    $ch = curl_init($url);

    if ($data !== null) {
        $payload = json_encode($data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    } else {
        curl_setopt($ch, CURLOPT_HTTPHEADER, array());
    }

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = trim(curl_exec($ch));
    curl_close($ch);
    return $result;
}

function api_put($url, $data) {
    $payload = json_encode($data);
    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $result = trim(curl_exec($ch));
    
    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
    }
    
    curl_close($ch);
    return $result;
}

function api_get($url, $params = array()) {
    if (!empty($params)) {
        $url .= '?' . http_build_query($params);
    }

    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $result = trim(curl_exec($ch));
    
    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
    }
    
    curl_close($ch);
    return $result;
}