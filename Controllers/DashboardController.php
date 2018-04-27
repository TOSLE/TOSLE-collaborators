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
            "datecreate",
            "id",
            "status"
        ];
        $parameter = [
            "status" => 1
        ];
        $response = $Blog->getLimitedData($Blog->selectAllData($target), 0, 5);
        $data = [];
        foreach($response as $array){
            $tmpData = [];
            foreach ($array as $key => $value){
                if(!is_numeric($key)){
                    if($key == "blog_datecreate"){
                        $date = new DateTime($value);
                        $tmpData[$key] = $date->format("m/j/Y");
                    } else {
                        $tmpData[$key] = $value;
                    }
                }
            }
            $data[] = $tmpData;
        }
        global $language;
        $Access = new Access();
        $routeBlogStatus = $Access->getSlug("blog_status");

        $lastPostsBloc = $Blog->dashboardBlocLastPosts($response);

        $lastPostsBloc["data_href_blog_status"] = $routeBlogStatus["slug"];
        $View->setData("configLastsPost", $lastPostsBloc);
        $View->setData("lastsPublication", $data);
        $View->setData("hrefBlogStatus", $routeBlogStatus["slug"]);
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