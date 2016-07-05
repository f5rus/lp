<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\LoginType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     *
     * @Route("/login", name="security_login")
     * @Template(":security:login.html.twig")
     */
    public function loginAction(Request $request)
    {
        $securityHelper = $this->get('security_helper');

        $data = array('username' => '', 'password' => '');
        $form = $this->createForm('AppBundle\Form\Type\LoginType', $data);

        $form->handleRequest($request);

        if ($form->isValid())
        {
            $data = $form->getData();

            try {
                $securityHelper->authenticate($data['username'], $data['password']);
                $url = $this->generateUrl('user_dashboard');
                return $this->redirect($url);

            } catch (\Exception $e) {

            }
        }

        return array('form' => $form->createView());
    }
}