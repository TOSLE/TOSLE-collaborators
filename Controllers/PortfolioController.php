<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 27/03/2018
 * Time: 22:44
 */

class PortfolioController
{
    /**
     * @Route("/en/portfolio(/index)")
     * @param array $params
     * Default action of PortfolioController
     */
    function indexAction($params)
    {
        $View = new View("default");
    }

    /**
     * @Route("/en/portfolio/edit")
     * @param array $params
     * Edit portfolio action
     */
    function editAction($params)
    {
        $View = new View("default");
    }
}