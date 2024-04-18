# jaunt
Jaunt, a tree based router for PHP.

Jaunt is an experiment, a working experiment, but still an experiment.

[Why Jaunt](why.md)

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


