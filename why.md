# Why Jaunt
There are two primary reasons I decided to build my own router:
1. I wanted functionality similar to 
 [express.js](https://expressjs.com/en/guide/routing.html) routing.
2. In my mind, regex based routing seemed "heavy" for a PHP application 
 that starts every request from scratch. I thought perhaps a tree based
 approach work serve me better.

## Regular Expression Concerns *(perhaps unfounded)*
Like most developers I have grown accustomed to Rails style routing for web
requests, my personal favorite is the simple, yet powerful, router included
with [express.js](https://expressjs.com/en/4x/api.html#router).
Most Rails style routers use regular expressions to find matching routes,
which, in my mind, has always seemed like a bit of a performance challenge
for PHP.

The basic cycle for regex based route matching includes:
1. Add routes to the router in a simple to write syntax.
2. Convert the routes regular expressions
3. Iterate through the list of routes looking for a regular expression match,
   which requires compiling the regular expressions for execution.

The big framework add shortcuts, like keeping "compiled" list of routes
so they are not built and converted again on every request.
[FastRoute](https://github.com/nikic/FastRoute) 
and [Symfony Router](https://symfony.com/doc/current/create_framework/routing.html)
use this approach.

Jaunt avoids regular expression matching by building a route tree
and then walking the tree to find the matching route