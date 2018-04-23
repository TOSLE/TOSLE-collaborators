<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 12/02/2018
 * Time: 00:29
 */

class BlogController
{
    /**
     * @Route("/en/blog(/index)")
     * @param array $params
     * Default action of BlogController
     */
    function indexAction($params)
    {
        $View = new View("default");
    }

    /**
     * @Route("/en/view/{idArticle}")
     * @param array $params
     * View article action
     */
    function viewAction($params)
    {
        $View = new View("default");
    }

    /**
     * @Route("/en/search/{params}")
     * @param array $params
     * View filtered article action
     */
    function searchAction($params)
    {
        $View = new View("default");
    }

    /**
     * @Route("/en/add/{params}")
     * @param array $params
     * Add article
     */
    function addAction()
    {
        $Blog = new Blog();
        $Blog->setTitle('Test');
        $Blog->setContent('lorem ipj jgjhg hjg jg jfgf fhgf gf gjhgjhg jg f fgfd hgf hfgghfhg dhgf hfsum');
        $Blog->setStatus(1);
        $Blog->setType(1);
        $Blog->save();
    }
}