<?php
// DYNAMIC
$method         = regs('REQUEST_METHOD');
$uri            = regs('REQUEST_URI');
$cmd            = regs('cmd');

// DEFINE
$views          = './views/';
$controllers    = './controllers/';
$models         = './models/';
$data           = [];
$url            = '';
$id             = '';
$module         = '';