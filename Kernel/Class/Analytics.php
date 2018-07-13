<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 13/07/2018
 * Time: 20:02
 */

/**
 * Class Analytics
 * Générations des données statistiques globales.
 *
 * type géré, pour le moment :
 *      - view
 */
class Analytics
{
    private $expireToken;


    public function __construct()
    {
        $this->expireToken = time()+(DURATION_COOKIE_VIEW_SECONDS*DURATION_COOKIE_VIEW_MINUTES*DURATION_COOKIE_VIEW_HOURS*DURATION_COOKIE_VIEW_DAY*DURATION_COOKIE_VIEW_MONTH);
    }

    public function setViewStats($_cookie = null)
    {
        $Stats = new Stats();
        if(isset($_SERVER['HTTP_REFERER'])){
            $referer = $_SERVER['HTTP_REFERER'];
        } else {
            $referer = null;
        }
        $target = $_SERVER['REQUEST_URI'];
        if(isset($_cookie)){
            $Stats->getStatsView($_cookie, $target);
            if(empty($Stats->getId())) {
                $Stats->setToken($_cookie);
                $Stats->setType('view');
                $Stats->setSource($referer);
                $Stats->setTarget($target);
                $Stats->setDay(date('d'));
                $Stats->setMonth(date('m'));
                $Stats->setYear(date('Y'));
                $Stats->save();
                setcookie('TOSLE_ANALYTICS', $Stats->getToken(), $this->expireToken);
            } else {
                return false;
            }
        } else {
            $Stats->setToken();
            $Stats->setType('view');
            $Stats->setSource($referer);
            $Stats->setTarget($target);
            $Stats->setDay(date('d'));
            $Stats->setMonth(date('m'));
            $Stats->setYear(date('Y'));
            $Stats->save();
            setcookie('TOSLE_ANALYTICS', $Stats->getToken(), $this->expireToken);
        }
    }
}