<?php

namespace AppBundle\Handler;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler;

class AjaxAuthenticationSuccessHandler extends DefaultAuthenticationSuccessHandler
{
    /**
     * {@inheritdoc}
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        if ($request->isXmlHttpRequest()) {
            $targetUrl = $this->determineTargetUrl($request);
            return new JsonResponse(
                array(
                    'success'     => true,
                    'redirectURI' => $this->httpUtils->generateUri($request, $targetUrl)
                )
            );

        } else {
            return parent::onAuthenticationSuccess($request, $token);
        }
    }
}