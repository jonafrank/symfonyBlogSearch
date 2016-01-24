<?php

namespace Jonafrank\SearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Liip\SearchBundle\Helper\SearchParams;

class DefaultController extends Controller
{
    public function searchAction(Request $request)
    {
        if ($this->container->getParameter('jonafrank.search.engine') === 'google') {
            return $this->render('JonafrankSearchBundle:Default:search.html.twig', array(
                'title' => 'Search',
                'query' => SearchParams::requestedQuery($request, 'query'),
                'page'  => SearchParams::requestedPage($request, 'page')
            ));
        }
    }
}
