<?php

namespace Jaunt\Unit;

use \PHPUnit\Framework\TestCase;
use Jaunt\Router;

class RouterTest extends TestCase
{
    public function testRouterBuilder() {
        $router = new Router();
        $router->get("/", 'trim');
        $router->get('/api/tests/:id/content', [ArrayObject::class, 'count']);
        $router->use('/api/tests', 'fake_middleware_function');
        print_r($router);

        $route = $router->route('get', "/api/tests/123/content");
        var_dump($route);
    }

    public function testBigRoute() {
        $test_mem_start = memory_get_usage ();
        $test_time_start = microtime ( true );
        $router = (new Router())
            ->get('null', 'FrontPage')
            ->get('account/:account_id', 'Account')
            ->post('account/:account_id', 'Account')
            ->get('accounts', 'Account')
            ->get('events/:account_id', 'Event')
            ->get('event/:event_id/attendees', ['Event','attendees'])
            ->get('event/:event_id/workers', ['Event','workers'])
            ->get('accommodations/:account_id', 'Accommodations')
            ->get('badges/:account_id', 'Badges')
            ->get('badges/:account_id/progress', 'Badges');

        $router->route('GET', 'badges/49728/progress');
        echo "Time required = " . (microtime ( true ) - $test_time_start) . " seconds\n";
        echo "Memory required = " . sprintf('%.2f',((memory_get_usage () - $test_mem_start)/1048576)) . " MB\n";
    }
}