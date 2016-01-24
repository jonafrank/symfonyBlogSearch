<?php

namespace Jonafrank\SearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Liip\SearchBundle\Helper\SearchParams;

class DefaultController extends Controller
{
    public function searchAction(Request $request)
    {
        switch ($this->container->getParameter('jonafrank.search.engine')) {
            case 'google':
                return $this->render('JonafrankSearchBundle:Default:google_results.html.twig', array(
                    'title'  => 'Search',
                    'query'  => SearchParams::requestedQuery($request, 'query'),
                    'page'   => SearchParams::requestedPage($request, 'page')
                ));
            case 'elasticsearch':
                $finder = $this->container->get('fos_elastica.finder.example_blog.post');
                $query = $request->query->get('query');
                $paginator = $this->get('knp_paginator');
                $page = $request->query->get('page', 1);
                $results = $finder->createPaginatorAdapter($query);
                $pagination = $paginator->paginate($results, $page, 10);
                return $this->render('JonafrankSearchBundle:Default:elastic_results.html.twig', array(
                    'title'      => 'Search',
                    'pagination' => $pagination
                ));
        }
    }
}
