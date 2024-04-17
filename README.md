# jaunt
Jaunt, a tree based router for PHP.

Jaunt is an experiment, a working experiment, but still an experiment.

## Usage
```
<?php

require '/path/to/vendor/autoload.php';

$router = (new Router())
    ->use('/api/', 'auth_middleware')
    ->use('/api/account', 'account_access_middleware')
    ->get('/api/accounts', 'get_all_accounts_handler');
    ->get('/api/account/:id', 'get_account_handler');
    ->get('/api/account/:id/users', 'get_account_users_handler');
});

// Fetch method and URI from somewhere
$method = $_SERVER['REQUEST_METHOD'];
$path = url_parse($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$route = $router->route($method, $path);
```

## Why Jaunt
Most developers have become accustomed to Rails style routing of web
requests. 
My personal favorite is the simple, yet powerful, routing included 
with [express.js](https://expressjs.com/en/4x/api.html#router).
Most Rails style routers also use regular expressions to find
matching routes.
While regular expression based matching is powerful, I feel it also
introduces some performance challenges, especially in PHP where we
are starting each new request from scratch.

The basic cycle for regex based route matching includes:
1. Adding routes to the router in a simple to write syntax.
2. Converting the routes regular expressions
3. Walking the list of routes looking for a regular expression match,
 which requires compiling the regular expression for execution.

Some framework add shortcuts, like keeping "compiled" list of routes
so they are not built and converted again on every request. 
[FastRoute](https://github.com/nikic/FastRoute) has an interesting 
approach that complies all the routes into one regular expression 
and then does one match.

Jaunt avoids regular expression matching by building a route tree
and then walking the tree to find the matching route
