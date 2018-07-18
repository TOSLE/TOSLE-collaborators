<?php

/**
 * Created by PhpStorm.
 * User: julien
 * Date: 16/02/2018
 * Time: 11:22
 */
class DashboardController extends CoreController
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
        $View = new View("dashboard", "Dashboard/lesson");
        $View->setData("PageName", NAV_DASHBOARD . " " . NAV_DASHBOARD_LESSON);
        $Lesson = new LessonRepository();

        $View->setData("modalAddOption", $Lesson->getModalAdd(12));
        $View->setData("modalStats", $Lesson->getModalStats());
        $View->setData("modalLastLesson", $Lesson->getModalLatestLesson());
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
        $View = new View("dashboard", "Dashboard/student");
        $View->setData("PageName", NAV_DASHBOARD . " " . NAV_DASHBOARD_STUDENT);
        $Dashboard = new DashboardRepository();
        $configBlocUsers = $Dashboard->getAllUsers();
        $configBlocGroups = $Dashboard->getAllGroups();
        $Group = new GroupRepository();
        $configFormGroupAdd = $Group->configFormAdd();
        $errors_group_add = "";

        if (isset($params['POST']) && !empty($params['POST'])) {
            $errors_group_add = $Group->addGroup($_FILES, $params["POST"]);
            if ($errors_group_add === 1) {
                header('Location:' . $this->Routes['dashboard_student']);
            }
        }
        $View->setData("configBlocUsers", $configBlocUsers);
        $View->setData("configBlocGroups", $configBlocGroups);
        $View->setData("configFormGroupAdd", $configFormGroupAdd);
        $View->setData("errors_group_add", $errors_group_add);
    }

    /**
     * @Route("/en/dashboard/blog")
     * @param array $params
     * View blog dashboard action
     */
    function blogAction($params)
    {
        $View = new View("dashboard", "Dashboard/blog");
        $BlogRepository = new BlogRepository();

        /**
         * On set les variables importantes de la vue (le pagename)
         */
        $View->setData("PageName", NAV_DASHBOARD . " " . NAV_DASHBOARD_BLOG);


        $latestArticles = $BlogRepository->getModalLatestArticle(12);
        $View->setData("latestBlogArticle", $latestArticles);


        $modalAddPost = $BlogRepository->getModalAddPost();
        $View->setData("blocGeneral", $modalAddPost);

        $modalStatBlog = $BlogRepository->getModalStats();
        $View->setData("statsBlog", $modalStatBlog);

        $modalAllPublishPost = $BlogRepository->getModalAllArticle(12, 1);
        $View->setData('modalAllPublishPost', $modalAllPublishPost);

        $modalAllUnpublishPost = $BlogRepository->getModalAllArticle(12, 0);
        $View->setData('modalAllUnpublishPost', $modalAllUnpublishPost);

        $request = $BlogRepository->getRequestsend();

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
        $View = new View("dashboard", "Dashboard/stats");
        $View->setData("PageName", NAV_DASHBOARD . " " . NAV_DASHBOARD_STATISTIC);

        $Stats = new StatsRepository();
        $resultStatMonth = $Stats->getStatViewTosle();
        $View->setData("statViewTosle", $resultStatMonth);

        $User = new UserRepository();
        $resultStatUserYear = $User->getStatUser('year');
        $View->setData("statUserRegisteredYear", $resultStatUserYear);

        $resultStatUserMonth = $User->getStatUser('month');
        $View->setData("statUserRegisteredMonth", $resultStatUserMonth);

        $resultStatUserDay = $User->getStatUser('day');
        $View->setData("statUserRegisteredDay", $resultStatUserDay);

//        print_r($User);
        echo '<pre>';
        //print_r($resultStatUserDay);
        echo '</pre>';

    }


    public function chapterAction($params)
    {
        $View = new View("dashboard", "Dashboard/chapter");
        $View->setData("PageName", NAV_DASHBOARD . " " . NAV_DASHBOARD_LESSON);
        $Lesson = new LessonRepository();

        /*$View->setData("modalAddOption", $Lesson->getModalAdd(12));
        $View->setData("modalStats", $Lesson->getModalStats());*/
        $View->setData("modalChapter", $Lesson->getModalLastChapterByLesson($params["URI"][0]));
    }

    /**
     * @param $params
     * Gestion des groupes en lien avec un ID
     */
    public function groupAction($params)
    {

        header('Location:' . $this->Routes['dashboard_student']);
    }

}