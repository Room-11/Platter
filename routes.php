<?php declare(strict_types=1);

namespace Room11\Platter;

use Aerys\Request;
use Aerys\Response;
use Room11\Platter\Presentation\Controller\Index as IndexController;
use Room11\Platter\Presentation\Controller\Authentication as AuthenticationController;

$router = \Aerys\router();

$router
    ->route('GET', '/', function(Request $request, Response $response) use ($template) {
        (new IndexController)->index($response, $template);
    })
    ->route('POST', '/login', function(Request $request, Response $response) use ($requests, $template) {
        yield from (new AuthenticationController)->logIn($request, $response, $requests, $template);
    })
;
