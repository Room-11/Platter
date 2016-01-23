<?php declare(strict_types=1);

namespace Room11\Platter;

use Room11\Platter\Presentation\Template\Html;
use Room11\Platter\Authentication\RequestCollection;

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/init.deployment.php';

$template = new Html(__DIR__ . '/templates', '/page.phtml');
$requests = new RequestCollection();

require_once __DIR__ . '/routes.php';
