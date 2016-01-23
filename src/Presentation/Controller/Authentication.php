<?php declare(strict_types=1);

namespace Room11\Platter\Presentation\Controller;

use Aerys\Request;
use Aerys\Response;
use Room11\Platter\Authentication\RequestCollection;
use Room11\Platter\Presentation\Template\Html;
use Room11\Platter\Authentication\Request as AuthenticationRequest;

class Authentication
{
    public function logIn(
        Request $request,
        Response $response,
        RequestCollection $authenticationRequests,
        Html $template
    ): \Generator
    {
        parse_str(yield $request->getBody(), $post);

        $authenticationRequests->add(new AuthenticationRequest((int) $post['username'], new \DateTimeImmutable()));

        $response->send($template->renderPage('/awaiting-confirmation.phtml'));
    }
}
