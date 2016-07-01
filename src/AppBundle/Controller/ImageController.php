<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class ImageController
 * @package AppBundle\Controller
 *
 * @Route("/image")
 */
class ImageController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/", name="image_list")
     */
    public function listAction()
    {
        return $this->render('image/image_list.html.twig');
    }
}
