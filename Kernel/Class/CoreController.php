<?php
/**
 * Created by PhpStorm.
 * User: jdomange
 * Date: 04/07/2018
 * Time: 17:07
 */

class CoreController
{
    protected $Auth = false;

    public function __construct()
    {
        global $Auth;
        $this->Auth = $Auth;
    }
}