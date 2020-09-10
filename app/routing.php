<?php
$routing = [];
$routing['/'] = [
    'controller' => 'Main',
    'action' => 'index'
];
$routing['/account/signin'] = [
    'controller' => 'Login',
    'action' => 'index'
];
$routing['/account/signup'] = [
    'controller' => 'Registration',
    'action' => 'index'
];
$routing['/account/settings'] = [
    'controller' => 'Settings',
    'action' => 'index'
];
$routing['/account/logout'] = [
    'controller' => 'Logout',
    'action' => 'index'
];
$routing['/verify'] = [
    'controller' => 'Verify',
    'action' => 'index'
];