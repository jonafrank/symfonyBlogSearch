<?php

namespace Jonafrank\SearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Liip\SearchBundle\Helper\SearchParams;

class DefaultController extends Controller
{
    public function searchAction(Request $request)
    {
        $resultsTemplate = $this->container->getParameter('jonafrank.search.results.template');
        $params = array();
        $query = $request->query->get('query');
        $page = $request->query->get('page', 1);

        switch ($this->container->getParameter('jonafrank.search.engine')) {
            case 'google':
                $params = array (
                    'title'  => 'Search',
                    'query'  => SearchParams::requestedQuery($request, 'query'),
                    'page'   => SearchParams::requestedPage($request, 'page')
                );
                // return $this->render($resultsTemplate, array(
                //     'title'  => 'Search',
                //     'query'  => SearchParams::requestedQuery($request, 'query'),
                //     'page'   => SearchParams::requestedPage($request, 'page')
                // ));
            case 'elasticsearch':
                $finder = $this->container->get('fos_elastica.finder.example_blog.post');
                $paginator = $this->get('knp_paginator');
                $results = $finder->createPaginatorAdapter($query);
                $pagination = $paginator->paginate($results, $page, 10);
                $params = array(
                    'query'      => $query,
                    'title'      => 'Search',
                    'pagination' => $pagination
                );
            case 'doctrine':
                $pagination =  $this->doctrineSearch($request);
                $params = array(
                    'query'      => $query,
                    'title'      => 'Search',
                    'pagination' => $pagination
                );
        }

        return $this->render($resultsTemplate, $params);
    }

    /**
     * Perform the manual search in doctrine and return the results
     *
     * @param  Request $request
     * @return Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination
     */
    protected function doctrineSearch(Request $request)
    {
        $entity = $this->container->getParameter('jonafrank.search.entity');
        $searchQuery = $request->query->get('query');
        $page = $request->query->get('page', 1);
        $searchFields = $this->container->getParameter('jonafrank.search.properties_search');
        $query = $this->getDoctrine()->getRepository($entity)->createQueryBuilder('e');
        $parameters = array();
        foreach ($searchFields as $prop) {
            $query->orWhere('e.'. $prop . ' LIKE :'.$prop);
            $parameters[$prop] = "%$searchQuery%";
        }
        $query->setParameters($parameters)->getQuery();
        $paginator = $this->get('knp_paginator');
        return $paginator->paginate($query, $page, 10);
    }
}
