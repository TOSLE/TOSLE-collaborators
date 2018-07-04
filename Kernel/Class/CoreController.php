<?php
/**
 * Created by PhpStorm.
 * User: jdomange
 * Date: 04/07/2018
 * Time: 17:07
 */

class CoreController
{
    protected $Auth;

    public function __construct()
    {
        $this->Auth = $GLOBALS['authUser'];
    }
}