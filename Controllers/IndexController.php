<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 06/02/2018
 * Time: 21:41
 */


/**
 * Class IndexController
 * Controller not use
 */
class IndexController
{
    /**
     * @Route("/en/index(/index)")
     * @param array $params
     * Default action of IndexController
     */
    function indexAction($params)
    {
        $View = new View();
    }

    function rightAction($params)
    {
        echo "Vous n'avez apparemment pas les droits d'accès à ce lien";
    }
}