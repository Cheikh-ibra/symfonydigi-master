<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Test
 * @package App\Controller
 */
class Test extends AbstractController
{

    /**
     * @param $theme
     * @param Request $request
     * @return Response
     * @Route("/blog/article/{theme}", name="test_hello")
     */
    function showArticleByTheme($theme, Request $request)
    {

        $response = new Response() ;

        $content = "<html><body>Theme : $theme</body></html></body>";

        $response->setContent($content);
        $response->setStatusCode(200);

        return $response;
    }

}