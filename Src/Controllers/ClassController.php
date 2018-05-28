<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 12/02/2018
 * Time: 00:29
 */

class ClassController
{
    /**
     * @Route("/en/class(/index)")
     * @param array $params
     * Default action of ClassController
     */
    function indexAction($params)
    {
        $View = new View("default");
    }

    /**
     * @Route("/en/class/{idArticle}")
     * @param array $params
     * View lessons action
     */
    function viewAction($params)
    {
        $View = new View("default");
    }

    /**
     * @Route("/en/class/{params}")
     * @param array $params
     * View filtered lessons action
     */
    function searchAction($params)
    {
        $View = new View("default");
    }
}