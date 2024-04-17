<?php

use Jaunt\Router;

include 'bootstrap.php';

$test_mem_start = memory_get_usage ();
$test_time_start = microtime ( true );
$router = (new Router())
    ->get('/', 'FrontPage')
    ->use('/account', 'AccountAccess')
    ->get('account/:account_id', 'Account')
    ->post('account/:account_id', 'Account')
    ->get('accounts', 'Account')
    ->get('events/:account_id', 'Event')
    ->get('event/:event_id/attendees', ['Event','attendees'])
    ->get('event/:event_id/workers', ['Event','workers'])
    ->get('accommodations/:account_id', 'Accommodations')
    ->get('account/:account_id/badges', 'Badges')
    ->get('/account/:account_id/badges/progress', 'BadgeProgress');

$route = $router->route('GET', 'account/49728/badges/progress');
echo "Time required = " . (microtime ( true ) - $test_time_start) . " seconds\n";
echo "Memory required = " . sprintf('%.2f',((memory_get_usage () - $test_mem_start)/1048576)) . " MB\n";
print_r($route);
