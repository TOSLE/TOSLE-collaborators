<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 16/02/2018
 * Time: 11:22
 */

class DashboardController
{
    /**
     * @Route("/en/dashboard(/index)")
     * @param array $params
     *
     */
    function indexAction($params)
    {
        $View = new View("dashboard", "dashboard");
        $View->setData("PageName", NAV_DASHBOARD . " " . GLOBAL_HOME_TEXT);
    }

    /**
     * @Route("/en/dashboard/lessons")
     * @param array $params
     * View message action
     */
    function lessonsAction($params)
    {
        $View = new View("dashboard", "lesson");
        $View->setData("PageName", NAV_DASHBOARD . " " . NAV_DASHBOARD_LESSON);
    }

    function homeworkAction($params)
    {
        $View = new View("dashboard", "homework");
        $View->setData("PageName", NAV_DASHBOARD . " " . NAV_DASHBOARD_LESSON);
    }

    function studentAction($params)
    {
        $View = new View("dashboard", "student");
        $View->setData("PageName", NAV_DASHBOARD . " " . NAV_DASHBOARD_STUDENT);
    }

    function blogAction($params)
    {
        $View = new View("dashboard", "Dashboard/blog");
        $View->setData("PageName", NAV_DASHBOARD . " " . NAV_DASHBOARD_BLOG);
    }

    function portofolioAction($params)
    {
        $View = new View("dashboard", "portofolio");
        $View->setData("PageName", NAV_DASHBOARD . " " . NAV_DASHBOARD_PORTOFOLIO);
    }

    function chatAction($params)
    {
        $View = new View("dashboard", "Dashboard/chat");
        $View->setData("PageName", NAV_DASHBOARD . " " . NAV_DASHBOARD_CHAT);
    }

    function statAction($params)
    {
        $View = new View("dashboard", "chat");
        $View->setData("PageName", NAV_DASHBOARD . " " . NAV_DASHBOARD_STATISTIC);
    }

    function graphAction($params)
    {
        $View = new View("dashboard", "chat");
        $View->setData("PageName", NAV_DASHBOARD . " " . NAV_DASHBOARD_GRAPH);
    }

}