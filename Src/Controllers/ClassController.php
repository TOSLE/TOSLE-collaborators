<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 12/02/2018
 * Time: 00:29
 */


class ClassController extends CoreController
{
    /**
     * @Route("/en/class(/index)")
     * @param array $params
     * Default action of ClassController
     * Initialisation des paramètres de la vue
     *      - Interprétation de params pour modifier les paramètres de la vue si nécessaire
     */
    function indexAction($params)
    {
        $View = new View("default", "Class/home");
        $Lesson = new LessonRepository();
        // Initialisation des parametres
        $colSize = 6;
        $numberLesson = 6;
        $offset = 0;
        $page = 1;
        $pagination = $Lesson->getPagination($numberLesson, $params["GET"], $this->Auth);
        $urlClassFeed = CoreFile::testFeedFile('lessonfeed.xml');
        if(isset($this->Auth)){
            $Newsletter = new Newsletter();
            $newsletter = false;
            if(!empty($this->Auth->getNewsletter())){
                $newsletter = $Newsletter->getStatusLesson();
            }
            $View->setData("newsletter", $newsletter);
        }
        $errors = [];
        if (!empty($params["GET"])) {
            if (isset($params["GET"]["colsize"])) {
                if ($params["GET"]["colsize"] == "4" || $params["GET"]["colsize"] == "6" || $params["GET"]["colsize"] == "12") {
                    $colSize = $params["GET"]["colsize"];
                }
            }
            if (isset($params["GET"]["number"])) {
                if ($params["GET"]["number"] >= 1 || $params["GET"]["number"] <= 12) {
                    $numberLesson = $params["GET"]["number"];
                    $pagination = $Lesson->getPagination($numberLesson, $params["GET"], $this->Auth);
                }
            }
            if (isset($params['GET']['page']) && array_key_exists($params['GET']['page'], $pagination)) {
                $page = $params['GET']['page'];
                $offset = $numberLesson * $page - $numberLesson;
            }
        }
        $lessons = $Lesson->getLessons($this->Auth, $numberLesson, $offset);
        $View->setData('urlClassFeed', $urlClassFeed);
        $View->setData("pagination", $pagination);
        $View->setData("page", $page);
        $View->setData("lessons", $lessons);
        $View->setData("col", $colSize);
    }

    /**
     * @Route("/en/class/{idArticle}")
     * @param array $params
     * View lessons action
     */
    function viewAction($params)
    {
        $routes = Access::getSlugsById();
        $View = new View("default", "Class/view_lesson");
        if(isset($params['URI']) && !empty($params['URI'])){
            $Lesson = new LessonRepository();
            $Comment = new CommentRepository();
            $errors = "";
            $subscribe = null;
            $formAddComment = $Comment->configFormAdd();
            if($Lesson->getLesson($params['URI'][0])){
                $readChapter = $Lesson->getChapter()[0];
                $subscribe = $Lesson->getSubscribe($this->Auth);
                if(isset($params['URI'][1])){
                    foreach($Lesson->getChapter() as $Chapter){
                        if($Chapter->getUrl() == $params['URI'][1]){
                            $readChapter = $Chapter;
                        }
                    }
                }
                if(isset($this->Auth) && isset($params["POST"]) && !empty($params["POST"])){
                    $errors = Form::checkForm($formAddComment, $params["POST"]);
                    $dataForm = Form::secureData($params['POST']);
                    $Comment->addComment($formAddComment, $dataForm, 2, $readChapter->getId());
                    header('Location:'.$routes['view_lesson'].'/'.$Lesson->getUrl().'/'.$readChapter->getUrl());
                }
                $allComments = $Comment->getAll('chapter', $readChapter->getId());

                if(isset($allComments)){
                    $View->setData("lastComments", array_slice($allComments, 0, 5));
                }
                $View->setData("readChapter", $readChapter);
                $View->setData("subscribe", $subscribe);
                $View->setData("lesson", $Lesson);
                $View->setData("formAddComment", $formAddComment);
                $View->setData("errors", $errors);
            } else {
                $View->setData("error_search", 'Il semble y avoir une erreur dans votre URL, le cours n\'est pas trouvé où n\'existe pas !');
            }
           
        } else {
            header('Location:'.$routes['homepage']);
        }
    }

    /**
     * @Route("/en/class/{params}")
     * @param array $params
     * View filtered lessons action
     */
    function searchAction($params)
    {
        $View = new View("default");
    }

    /**
     * @Route("/en/class/{params}")
     * @param array $params
     * View filtered lessons action
     */
    function addAction($params)
    {
        $routes = Access::getSlugsById();
        /**
         * On regarde si nous avons bien un paramètre dans une URL
         */
        if(isset($params["URI"][0])){
            $getTypeURI = $params["URI"][0];
            $View = new View("dashboard", "Dashboard/add_lesson");
            $Lesson = new LessonRepository();
            $View->setData("errors", "");
            if((isset($params["POST"]) && !empty($params["POST"]))){
                $resultAdd = $Lesson->addLesson($params["POST"]);
                if($resultAdd === 1){
                    header('Location:'.$routes['dashboard_lesson']);
                } else {
                    $View->setData("errors", $resultAdd);
                }
            }

            if($getTypeURI == "lesson"){
                $View->setData("configForm", $Lesson->configFormAddLesson());
            } else {
                header('Location:'.$routes['dashboard_lesson'].'/error');
            }
        } else {
            header('Location:'.$routes['dashboard_lesson']);
        }

        $View->setData('controller', "DashboardController");
    }

    public function editAction($params)
    {
        $routes = Access::getSlugsById();
        if(isset($params["URI"][0])){
            if(is_numeric($params["URI"][0])) {
                $Lesson = new LessonRepository();
                $View = new View("dashboard", "Dashboard/add_lesson");
                $arrayReturn = $Lesson->editLesson($params["URI"][0]);
                $arrayLesson = $arrayReturn["lesson"];
                $configForm = $arrayReturn["configForm"];
                $configForm["data_content"] = [
                    "title" => $arrayLesson->getTitle(),
                    "content" => $arrayLesson->getDescription(),
                    "select_color" => $arrayLesson->getColor(),
                    "selectedOption" => $arrayReturn['selectedOption'],
                    "select_type" => $arrayLesson->getType(),
                    "select_difficulty" => $arrayLesson->getLevel(),
                ];
                if(isset($params["POST"]) && !empty($params["POST"])){
                    $resultAdd = $Lesson->addLesson($params["POST"], $params["URI"][0]);
                    if($resultAdd == 1){
                        header('Location:'.$routes['dashboard_lesson']);
                    }
                }
                $View->setData("errors", "");
                $View->setData("configForm", $configForm);
            }
        } else {
            header('Location:'.$routes['dashboard_lesson']);
        }
        $View->setData('controller', "DashboardController");
    }

    /**
     * @param $params
     * Récupère l'id de la lesson et modifie le status
     */
    public function statusAction($params)
    {
        $routes = Access::getSlugsById();
        if(is_numeric($params["URI"][0])){
            $Lesson = new LessonRepository();

            $target = [
                "id",
                "status"
            ];
            $parameter = [
                "LIKE" => [
                    "id" => $params["URI"][0]
                ]
            ];
            $Lesson->setWhereParameter($parameter);
            $Lesson->getOneData($target);
            if($Lesson->getId()){
                if($Lesson->getStatus() > 0){
                    $Lesson->setStatus(0);
                } else {
                    $Lesson->setStatus(1);
                }
                $Lesson->save();
            }
            $Lesson->generateXml();
        }

        header('Location:'.$routes["dashboard_lesson"]);
    }

    /**
     * @param $params
     * Permet d'inscrire ou non l'utilisateur à la newsletter
     */
    public function subscribeAction($params)
    {
        $routes = Access::getSlugsById();
        $Newsletter = new Newsletter();
        $Newsletter->changeLessonNewsletter();
        header('Location:'.$routes['homepage']);
    }

    /**
     * @param $params
     * Permet de suivre l'évolution d'un cours, s'y inscrire
     */
    public function followAction($params)
    {
        if(isset($params['URI'][0]) && !empty($params['URI'][0]) && is_numeric($params['URI'][0])){
            $Lesson = new LessonRepository($params['URI'][0]);
            if(isset($this->Auth) && !empty($this->Auth->getId())){
                $UserLesson = new UserLesson();
                if($Lesson->getSubscribe($this->Auth)){
                    $parameter = [
                        'LIKE' => [
                            'userid' => $this->Auth->getId(),
                            'lessonid' => $Lesson->getId()
                        ]
                    ];
                    $UserLesson->setWhereParameter($parameter);

                    $UserLesson->delete();
                } else {
                    $UserLesson->setUserid($this->Auth->getId());
                    $UserLesson->setLessonid($params['URI'][0]);
                    $UserLesson->save();
                }
            }
            header('Location:'.$this->Routes['view_lesson'].'/'.$Lesson->getUrl());
        } else {
            header('Location:'.$this->Routes['homepage']);
        }
    }
}