<?php declare(strict_types=1);

namespace Room11\Platter;

use Room11\Platter\Presentation\Controller\Index as IndexController;

$router = \Aerys\router();

$router->route('GET', '/', function(\Aerys\Request $req, \Aerys\Response $resp) use ($template) {
    (new IndexController)->index($resp, $template);
});
