<?php
/**
 * Created by PhpStorm.
 * User: jdomange
 * Date: 04/07/2018
 * Time: 17:07
 */

class CoreController
{
    protected $Auth = null;
    protected $Routes = null;

    public function __construct()
    {
        if(isset($_SESSION['auth'])){
            $tmpAuth = json_decode($_SESSION['auth']);
            $this->Auth = new UserRepository($tmpAuth->{'id'});
        }
        $this->Routes = Access::getSlugsById();
    }
}