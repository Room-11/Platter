<?php declare(strict_types=1);

namespace Room11\Platter\Cli;

use Aerys\Host;

require_once __DIR__ . '/../bootstrap.php';

foreach ($hosts as $name => $host) {
    (new Host)
        ->name($name)
        ->expose($host[0], $host[1])
        ->use($router)
        ->use(\Aerys\root(__DIR__ . '/../public'))
    ;
}
