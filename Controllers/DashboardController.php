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
        global $language;

        $View = new View("dashboard", "Dashboard/blog");
        $BlogRepository = new BlogRepository();
        $Access = new Access();
        $hrefBackOffice = $Access->getPathBackOffice($language);
        /**
         * On set les variables importantes de la vue (le pagename)
         */
        $View->setData("PageName", NAV_DASHBOARD . " " . NAV_DASHBOARD_BLOG);


        $latestArticles = $BlogRepository->getModalLatestArticle();
        $View->setData("latestBlogArticle", $latestArticles);

        $StatsBlog = new DashboardBlocModal();
        $StatsBlog->setTitle("Blog Analytics");
        $StatsBlog->setTableHeader([
            1 => "Type",
            2 => "Value"
        ]);
        $StatsBlog->setTableBodyClass([
            1 => "td-content-text",
            2 => "td-content-number"
        ]);
        $StatsBlog->setColSizeBloc(6);
        $StatsBlog->setTableBodyContent([
            0 => [
                1 => "Nombre d'article",
                2 => $BlogRepository->countNumberOfBlog(["id"])
            ],
            1 => [
                1 => "Nombre d'article publié",
                2 => $BlogRepository->countNumberOfBlog(["id"], ["status" => 1])
            ],
            2 => [
                1 => "Nombre d'article dépublié",
                2 => $BlogRepository->countNumberOfBlog(["id"], ["status" => 0])
            ]
        ]);
        $View->setData("statsBlog", $StatsBlog->getArrayData());

        /**
         * Affectation des données pour la vue
         */
            $View->setData("idModalViewAllPosts", $latestArticles["global"]["icon_header"]["modal"]["target"]);
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