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

        $BlogRepository = new BlogRepository();
        /**
         * Préparation des différentes routes utilisées dans la vue
         */
            $Access = new Access();
            $routeBlogStatus = $Access->getSlug("blog_status");

        /**
         * Préparation des requêtes
         */
            $target = [
                "title",
                "datecreate",
                "id",
                "status"
            ];
        /**
         * Construction des données affichées dans le bloc "Dernières publications
         */
            $BlogRepository->setOrderByParameter(["id" => "DESC"]);
            $BlogRepository->setLimitParameter(5);
            $globalArray = [
                "title" => "Derniers articles",
                "col" => 6,
                "table_header" => [
                    "Titre",
                    "Date de publication",
                    "Action",
                    "Action 2"
                ],
                "icon_header" => [
                    "modal" => [
                        "target" => "modal_view_all_posts"
                    ]
                ],
                "table_body_class" => [
                    1 => "td-content-text",
                    2 => "td-content-date",
                    3 => "td-content-action"
                ],
                "color_button" => [
                    1 => "tosle",
                    2 => "yellow",
                    3 => "red",
                    4 => "green"
                ]
            ];
            $lastPostsBloc = $BlogRepository->createArrayDashboardbloc($BlogRepository->getData($target), $globalArray);
            $lastPostsBloc["data_href_blog_status"] = "blog/status";

            $DashboardBlocModal = new DashboardBlocModal();
            $DashboardBlocModal->setTitle("Mon premier modal entier");
            $DashboardBlocModal->setIconHeader("modal_view_all_posts", "modal");
            $DashboardBlocModal->setTableHeader([
                1 => "Titre",
                2 => "Date de publication",
                3 => "Action"
            ]);
            $DashboardBlocModal->setColSizeBloc(6);
            $DashboardBlocModal->setButtonValue("tosle", "View");
            $DashboardBlocModal->setButtonValue("yellow", "Edit");
            $DashboardBlocModal->setSpecificButton("specificButton_publishStatus", [
                0 => "Depublier",
                1 => "Publier"
            ]);
            $DashboardBlocModal->setTableBodyClass([
                1 => "td-content-text",
                2 => "td-content-date",
                3 => "td-content-action"
            ]);
            $DashboardBlocModal->setTableBodyContent($BlogRepository->getData($target), "blog");
            $returnedArray = $DashboardBlocModal->getArrayData();
            echo "<pre>";
            print_r($returnedArray);
            echo "</pre>";
            $View->setData("returnedArray", $returnedArray);
        /**
         * Construction des données affichées dans la modal du bloc dernières publications
         */
            $allResponses = $BlogRepository->getData($target);
            $globalArray = [
                "title" => "Toutes les publications",
                "col" => 6,
                "table_header" => [
                    "Titre",
                    "Date de publication",
                    "Action"
                ],
                "icon_header" => [
                    "modal" => [
                        "target" => "modal_view_all_posts"
                    ]
                ],
                "table_body_class" => [
                    1 => "td-content-text",
                    2 => "td-content-date",
                    3 => "td-content-action"
                ],
                "color_button" => [
                    1 => "tosle",
                    2 => "yellow",
                    3 => "red",
                    4 => "green"
                ]
            ];
            $allPostsBlog = $BlogRepository->createArrayDashboardbloc($allResponses, $globalArray);
            $allPostsBlog["data_href_blog_status"] = $routeBlogStatus["slug"];
            $allPostsBlog["global"]["col"] = 12;

        /**
         * Affectation des données pour la vue
         */
            $View->setData("configLastsPost", $lastPostsBloc);
            $View->setData("configAllPosts", $allPostsBlog);
            $View->setData("idModalViewAllPosts", $lastPostsBloc["global"]["icon_header"]["modal"]["target"]);
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