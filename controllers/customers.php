<?php
$name   = regs('name');
$msisdn   = regs('msisdn');
$email   = regs('email');
$sub   = regs('sub');
$address   = regs('address');

function indexs($id=''){
    echo 'index';
}

function lists(){
    global $data;

    $main = 'customers/lists';
    layouts($main, ['data', $data]);
    // echo 'lists';
}

function details($id){
    echo 'details';
}

function inserts(){
    echo 'inserts';
}

function updates($id){
    echo 'updates';
}

function deletes($id){
    echo 'deletes';
}