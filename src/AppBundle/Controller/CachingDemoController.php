<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CachingDemoController extends Controller
{
    /**
     * @Route("/caching/no")
     */
    public function noCacheAction()
    {
        return $this->render('caching/index.html.twig', [
            'zeit' => new \DateTime()
        ]);
    }

    /**
     * @Route("/caching/full")
     */
    public function fullAction(Request $request)
    {
        $response = $this->render('caching/index.html.twig', [
            'zeit' => new \DateTime()
        ]);

        $response->setPublic();
        //$response->setEtag(md5((new \DateTime())->format('U')));

        $response->setSharedMaxAge(60);
        //$response->setExpires(new \DateTime("2017/2/9"));
        //$response->setLastModified(new \DateTime("2017/2/9"));
        if( $response->isNotModified($request))
        {
            $response->setStatusCode(304);
        }
        // (optional) set a custom Cache-Control directive
        //$response->headers->addCacheControlDirective('must-revalidate', true);

        // replace this example code with whatever you need
        return $response;
    }

    /**
     * @Route("/caching/donut")
     */
    public function donutAction()
    {
        $response = $this->render('caching/donut.html.twig', [
            'zeit' => new \DateTime()
        ]);

        $response->setPublic();
        $response->setSharedMaxAge(60);
        return $response;
    }

    /**
     * @Route("/caching/fragment")
     */
    public function fragmentAction()
    {
        $response = $this->render('caching/fragment.html.twig', [
            'zeit' => new \DateTime()
        ]);

        $response->setPrivate();
        return $response;
    }
}
