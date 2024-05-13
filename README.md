# jaunt
Jaunt, a fast tree based router for PHP.

One of the biggest challenges with PHP routers is that they
start over for every request.
Jaunt was designed to simplify and speedup the process of
finding a route by building and walking a tree based structure 
rather than iterating over a list of regular expressed based
route definitions.

Jaunt was [benchmarked](https://github.com/davenusbaum/benchmark-php-routing/tree/jaunt)
using the excellent [benchmark-php-routing](https://github.com/kktsvetkov/benchmark-php-routing) 
package created by [Kaloyan Tsvetkov](https://github.com/kktsvetkov).  

## Create a router
Creating a router is simple.
```
<?php

use Jaunt\Router;

$router = new Router();
```

## Add routes
Router are added by using the appropriate class method for the HTTP method
and providing a path and route destination.
The meaning of the route destination is open, the goal of the router is
to find and return the destination.
Dynamic routes can include placeholders wrapped in `{}`.
```
$router = (new Router())
    ->get('/api/account', 'get_all_accounts_handler');
    ->get('/api/account/:id', 'get_account_handler');
    ->get('/api/account/:id/users', 'get_account_users_handler');
```
## Add middleware
Middleware can be added to any point in a route.
```
$router = (new Router())
    ->use('/api/', 'auth_middleware')
    ->use('/api/account', 'account_access_middleware')
    ->get('/api/account', 'get_all_accounts_handler');
    ->get('/api/account/:id', 'get_account_handler');
    ->get('/api/account/:id/users', 'get_account_users_handler');
```
## Find a route
The `route` method returns an array of route information
including an array of named parameters and an array of
route destinations that can be used as a stack of handlers
to be called.
```
$route = $router->route($method, $path);
```
## Caching routes
Routes can be created in advance and cached to speed up the process of creating a router.
```
// define the routes
$router = (new Router())
    ->use('/api/', 'auth_middleware')
    ->use('/api/account', 'account_access_middleware')
    ->get('/api/account', 'get_all_accounts_handler');
    ->get('/api/account/:id', 'get_account_handler');
    ->get('/api/account/:id/users', 'get_account_users_handler');
// get the resulting route tree
$routeTree = $router->getRouteTree();
// cache the route tree in a php file
file_put_contents('../cache/cached_routes.php','<?php return ' . var_export($route_tree, true) . ';'
```
Use the cached route tree when creating the router
```
$router = new Router(include '../cache/cached_routes.php');
$route = $router->route($method, $path);
```

## Basic Usage Example
```
<?php

use Jaunt\Router;

require '/path/to/vendor/autoload.php';

$router = (new Router())
    ->use('/api/', 'auth_middleware')
    ->use('/api/account', 'account_access_middleware')
    ->get('/api/account', 'get_all_accounts_handler');
    ->get('/api/account/:id', 'get_account_handler');
    ->get('/api/account/:id/users', 'get_account_users_handler');


// Fetch method and URI from somewhere
$method = $_SERVER['REQUEST_METHOD'];
$path = url_parse($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$route = $router->route($method, $path);
``` 
