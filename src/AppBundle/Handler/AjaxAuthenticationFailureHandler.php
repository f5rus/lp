<?php

namespace AppBundle\Handler;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationFailureHandler;

class AjaxAuthenticationFailureHandler extends DefaultAuthenticationFailureHandler
{
    /**
     * @param Request $request
     * @param AuthenticationException $exception
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        if ($request->isXmlHttpRequest()) {
            $array = array('success' => false, 'message' => $exception->getMessage());
            return new JsonResponse($array);
        } else {
            return parent::onAuthenticationFailure($request, $exception);
        }
    }
}