<?php declare(strict_types=1);

namespace Room11\Platter\Presentation\Controller;

use Aerys\Response;
use Room11\Platter\Presentation\Template\Html;

class Index
{
    public function index(Response $response, Html $template)
    {
        $response->send($template->renderPage('/auth/login.phtml'));
    }
}
