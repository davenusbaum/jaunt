<?php

namespace Jaunt\Unit;

use Jaunt\Route;
use \PHPUnit\Framework\TestCase;
use Jaunt\Router;

class RouterTest extends TestCase
{
    public function testRouterBuilder() {
        $router = new Router();
        $router->get("/", 'trim');
        $router->get('/api/tests/:id/content', [ArrayObject::class, 'count']);
        $router->use('/api/tests', 'fake_middleware_function');

        $this->assertInstanceOf(Router::class, $router);
    }

    public function testRoute() {
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

        $route = $router->match('GET', 'badges/49728/progress');
        $this->assertIsArray($route);
        $this->assertEquals('Badges',$route['stack'][0]);
        $this->assertEquals('49728',$route['params']['account_id']);
    }

    public function testMultipleCallbacks() {
        $router = (new Router())
            ->get('null', 'FrontPage')
            ->use('user','Auth')
            ->post('user/account/:account_id', ['AccountAccess','PostAccount']);

        $route = $router->match('POST', 'user/account/12345');
        $this->assertIsArray($route);
        $this->assertEquals(['Auth','AccountAccess','PostAccount'],$route['stack']);
        $this->assertEquals('12345',$route['params']['account_id']);
        $this->assertEquals('user/account/:account_id',$route['path']);
    }
}