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
        $User = new UserRepository();
        $Lesson = new LessonRepository();
        $Comment = new CommentRepository();
        $Message = new MessageRepository();
        $Blog = new BlogRepository();
        $Group = new GroupRepository();
        $Stats = new StatsRepository();

        $totalUser = $User->getAllUser();
        $totalLesson = $Lesson->getAllLesson();
        $totalComment = $Comment->getAllComment();
        $totalMessage = $Message->getAllMessage();
        $totalArticle = $Blog->getAllArticle();
        $totalGroup = $Group->getAllGroup();
        $resultStatYear = $Stats->getStatViewTosle();

        $configTableLesson = $Lesson->getModalLatestLesson(12, 5, true);
        $configTableBlog = $Blog->getModalLatestArticle(12, 5,true);

        $View = new View("dashboard", "dashboard");
        $View->setData("PageName", NAVBAR_DASHBOARD . " " . GLOBAL_CMS_TOSLE);
        $View->setData("totalUser", $totalUser);
        $View->setData("totalLesson", $totalLesson);
        $View->setData("totalComment", $totalComment);
        $View->setData("totalMessage", $totalMessage);
        $View->setData("totalArticle", $totalArticle);
        $View->setData("totalGroup", $totalGroup);
        $View->setData("configTableLesson", $configTableLesson);
        $View->setData("configTableBlog", $configTableBlog);
        $View->setData("statViewTosle", $resultStatYear);
    }

    /**
     * @Route("/en/dashboard/lessons")
     * @param array $params
     * View lessons dashboard action
     */
    function lessonsAction($params)
    {
        $View = new View("dashboard", "Dashboard/lesson");
        $View->setData("PageName", NAVBAR_DASHBOARD . " " . NAVBAR_CLASS);
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
        $View->setData("PageName", NAVBAR_DASHBOARD . " " . NAVBAR_CLASS);

    }

    /**
     * @Route("/en/dashboard/student")
     * @param array $params
     * View student dashboard action
     */
    function studentAction($params)
    {
        $View = new View("dashboard", "Dashboard/student");
        $View->setData("PageName", NAVBAR_DASHBOARD . " " . NAVBAR_STUDENT);
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
        $View->setData("PageName", NAVBAR_DASHBOARD . " " . NAVBAR_BLOG);


        $latestArticles = $BlogRepository->getModalAllArticle(12, null);
        $View->setData("latestBlogArticle", $latestArticles);


        $modalAddPost = $BlogRepository->getModalAddPost();
        $View->setData("blocGeneral", $modalAddPost);

        $modalStatBlog = $BlogRepository->getModalStats();
        $View->setData("statsBlog", $modalStatBlog);

        /**
         * Affectation des données pour la vue
         */
    }

    /**
     * @Route("/en/dashboard/Portfolio")
     * @param array $params
     * View Portfolio dashboard action
     */
    function portfolioAction($params)
    {
        $View = new View("dashboard", "portofolio");
        $View->setData("PageName", NAVBAR_DASHBOARD . " " . NAVBAR_PROFILE);
    }

    /**
     * @Route("/en/dashboard/stats")
     * @param array $params
     * View stats dashboard action
     */
    function statsAction($params)
    {
        $View = new View("dashboard", "Dashboard/stats");
        $View->setData("PageName", NAVBAR_DASHBOARD . " " . NAVBAR_STATS);

        $Stats = new StatsRepository();

        /**
         * Stat visite cms Tosle
         */

        $resultStatYear = $Stats->getStatViewTosle();
        $View->setData("statViewTosle", $resultStatYear);

        /**
         * Stat consultation des cours
         */
        $classStatYear = $Stats->getNewStatsClass('year');
        $labelStatClassYear = '[""]';
        $statClassYear = '[0]';
        if(isset($classStatYear) && !empty($classStatYear)){
            $labelStatClassYear = '["'.implode('" ,"', $classStatYear['lessons']).'"]';
            $statClassYear = '['.implode(' ,', $classStatYear['counts']).']';
        }
        $View->setData("labelStatClassYear", $labelStatClassYear);
        $View->setData("statClassYear", $statClassYear);


        $classStatMonth = $Stats->getNewStatsClass('month');
        $labelStatClassMonth = '[""]';
        $statClassMonth = '[0]';
        if(isset($classStatMonth) && !empty($classStatMonth)){
            $labelStatClassMonth = '["'.implode('" ,"', $classStatMonth['lessons']).'"]';
            $statClassMonth = '['.implode(' ,', $classStatMonth['counts']).']';
        }
        $View->setData("labelStatClassMonth", $labelStatClassMonth);
        $View->setData("statClassMonth", $statClassMonth);


        $classStatDay = $Stats->getNewStatsClass('day');
        $labelStatClassDay = '[""]';
        $statClassDay = '[0]';
        if(isset($classStatDay) && !empty($classStatDay)){
            $labelStatClassDay = '["'.implode('" ,"', $classStatDay['lessons']).'"]';
            $statClassDay = '['.implode(' ,', $classStatDay['counts']).']';
        }
        $View->setData("labelStatClassDay", $labelStatClassDay);
        $View->setData("statClassDay", $statClassDay);

        /**
         * Stat consultation des articles du blog
         */

        $articleStatYear = $Stats->getNewStatsArticle('year');
        $labelStatBlogYear = '[""]';
        $statBlogYear = '[0]';
        if(isset($articleStatYear) && !empty($articleStatYear)){
            $labelStatBlogYear = '["'.implode('" ,"', $articleStatYear['articles']).'"]';
            $statBlogYear = '['.implode(' ,', $articleStatYear['counts']).']';
        }
        $View->setData("labelStatBlogYear", $labelStatBlogYear);
        $View->setData("statBlogYear", $statBlogYear);

        $articleStatMonth = $Stats->getNewStatsArticle('month');
        $labelStatBlogMonth = '[""]';
        $statBlogMonth = '[0]';
        if(isset($articleStatMonth) && !empty($articleStatMonth)){
            $labelStatBlogMonth = '["'.implode('" ,"', $articleStatMonth['articles']).'"]';
            $statBlogMonth = '['.implode(' ,', $articleStatMonth['counts']).']';
        }
        $View->setData("labelStatBlogMonth", $labelStatBlogMonth);
        $View->setData("statBlogMonth", $statBlogMonth);

        $articleStatDay = $Stats->getNewStatsArticle('day');
        $labelStatBlogDay = '[""]';
        $statBlogDay = '[0]';
        if(isset($articleStatDay) && !empty($articleStatDay)){
            $labelStatBlogDay = '["'.implode('" ,"', $articleStatDay['articles']).'"]';
            $statBlogDay = '['.implode(' ,', $articleStatDay['counts']).']';
        }
        $View->setData("labelStatBlogDay", $labelStatBlogDay);
        $View->setData("statBlogDay", $statBlogDay);
        /**
         * Stat inscription utilisateur au cms
         */

        $User = new UserRepository();

        $resultStatUserYear = $User->getStatUser('year');
        $View->setData("statUserRegisteredYear", $resultStatUserYear);

        $resultStatUserMonth = $User->getStatUser('month');
        $View->setData("statUserRegisteredMonth", $resultStatUserMonth);

        $resultStatUserDay = $User->getStatUser('day');
        $View->setData("statUserRegisteredDay", $resultStatUserDay);

    }


    public function chapterAction($params)
    {
        $View = new View("dashboard", "Dashboard/chapter");
        $View->setData("PageName", NAVBAR_DASHBOARD . " " . NAVBAR_CHAPTER);
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