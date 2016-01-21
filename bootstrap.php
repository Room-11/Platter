<?php declare(strict_types=1);

namespace Room11\Platter;

use Room11\Platter\Presentation\Template\Html;

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/init.deployment.php';

$template = new Html(__DIR__ . '/templates', '/page.phtml');

require_once __DIR__ . '/routes.php';
