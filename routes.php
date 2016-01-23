<?php declare(strict_types=1);

namespace Room11\Platter;

use Aerys\Request;
use Aerys\Response;
use Room11\Platter\Presentation\Controller\Index as IndexController;
use Room11\Platter\Presentation\Controller\Authentication as AuthenticationController;
use Room11\Platter\WebSocket\Handler;
use Room11\Platter\WebSocket\Client\Collection as ClientCollection;
use function Aerys\websocket;

$router = \Aerys\router();

$router
    ->route('GET', '/', function(Request $request, Response $response) use ($template) {
        (new IndexController)->index($response, $template);
    })
    ->route('POST', '/login', function(Request $request, Response $response) use ($requests, $template, $administrators) {
        yield from (new AuthenticationController)->logIn($request, $response, $requests, $template, $administrators);
    })
    ->route('GET', '/ws', websocket(new Handler(new ClientCollection())))
;
