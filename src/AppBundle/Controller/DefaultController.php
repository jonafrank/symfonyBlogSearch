<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $postQuery = $this->getDoctrine()->getRepository('AppBundle:Post')
            ->getAllQuery();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $postQuery,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('default/index.html.twig', array('pagination' => $pagination));
    }

    /**
     * @Route("/post/{id}", name="post")
     */
    public function postAction(Request $request)
    {
        $post = $this->getDoctrine()->getRepository('AppBundle:Post')
            ->find($request->attributes->get('id'));
        if (!$post) {
            throw $this->createNotFoundException('The post does not exist');
        }
        return $this->render('default/post.html.twig', array('post'=> $post));
    }
}
