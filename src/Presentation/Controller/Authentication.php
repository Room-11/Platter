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
        Html $template,
        array $allowedUsers
    ): \Generator
    {
        parse_str(yield $request->getBody(), $post);

        if (empty($post['username']) || !in_array((int) $post['username'], $allowedUsers, true)) {
            $response
                ->setStatus(403)
                ->setReason('Nope')
                ->send($template->renderPage('/auth/not-allowed.phtml'))
            ;

            return;
        }

        $authenticationRequests->add(new AuthenticationRequest((int) $post['username'], new \DateTimeImmutable()));

        $response->send($template->renderPage('/auth/awaiting-confirmation.phtml'));
    }
}
