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
     * Default action of DashboardController
     */
    function indexAction($params)
    {
        $View = new View("dashboard", "dashboard");
        $View->setData("PageName", NAV_DASHBOARD . " " . GLOBAL_HOME_TEXT);
    }

    /**
     * @Route("/en/dashboard/lessons")
     * @param array $params
     * View lessons dashboard action
     */
    function lessonsAction($params)
    {
        $View = new View("dashboard", "lesson");
        $View->setData("PageName", NAV_DASHBOARD . " " . NAV_DASHBOARD_LESSON);
    }

    /**
     * @Route("/en/dashboard/homework")
     * @param array $params
     * View homework dashboard action
     */
    function homeworkAction($params)
    {
        $View = new View("dashboard", "homework");
        $View->setData("PageName", NAV_DASHBOARD . " " . NAV_DASHBOARD_LESSON);
    }

    /**
     * @Route("/en/dashboard/student")
     * @param array $params
     * View student dashboard action
     */
    function studentAction($params)
    {
        $View = new View("dashboard", "student");
        $View->setData("PageName", NAV_DASHBOARD . " " . NAV_DASHBOARD_STUDENT);
    }

    /**
     * @Route("/en/dashboard/blog")
     * @param array $params
     * View blog dashboard action
     */
    function blogAction($params)
    {
        $View = new View("dashboard", "Dashboard/blog");
        $View->setData("PageName", NAV_DASHBOARD . " " . NAV_DASHBOARD_BLOG);

        $Blog = new Blog();
        $target = [
            "title",
            "datecreate"
        ];
        $parameter = [
            "status" => 1
        ];
        $response = $Blog->selectAnd($target, $parameter);
        $data = [];
        foreach($response as $key => $value){
            $date = new DateTime($value["blog_datecreate"]);
            $value["blog_datecreate"] = $date->format("m/j/Y");
            $data[] = $value;
        }

        $View->setData("lastsPublication", $data);
    }

    /**
     * @Route("/en/dashboard/portfolio")
     * @param array $params
     * View portfolio dashboard action
     */
    function portofolioAction($params)
    {
        $View = new View("dashboard", "portofolio");
        $View->setData("PageName", NAV_DASHBOARD . " " . NAV_DASHBOARD_PORTOFOLIO);
    }

    /**
     * @Route("/en/dashboard/chat")
     * @param array $params
     * View chat dashboard action
     */
    function chatAction($params)
    {
        $View = new View("dashboard", "Dashboard/chat");
        $View->setData("PageName", NAV_DASHBOARD . " " . NAV_DASHBOARD_CHAT);
    }

    /**
     * @Route("/en/dashboard/stats")
     * @param array $params
     * View stats dashboard action
     */
    function statsAction($params)
    {
        $View = new View("dashboard", "chat");
        $View->setData("PageName", NAV_DASHBOARD . " " . NAV_DASHBOARD_STATISTIC);
    }

}