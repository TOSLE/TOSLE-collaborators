<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 12/02/2018
 * Time: 00:29
 */

class BlogController
{
    /**
     * @Route("/en/blog(/index)")
     * @param array $params
     * Default action of BlogController
     */
    function indexAction($params)
    {
        $View = new View("default", "Blog/home");
        $Blog = new BlogRepository();
        $Comment = new CommentRepository();
        $Category = new CategoryRepository();
        $routes = Access::getSlugsById();
        /**
         * Default var
         */
        $colSize = 6;
        $numberBlog = 6;
        $page = 1;
        $offset = 0;
        $pagination = $Blog->getPagination($numberBlog, $params["GET"]);
        $errors = [];
        if(!empty($params["GET"])){
            if(isset($params["GET"]["colsize"])) {
                if ($params["GET"]["colsize"] == "4" || $params["GET"]["colsize"] == "6" || $params["GET"]["colsize"] == "12"){
                    $colSize = $params["GET"]["colsize"];
                }
            }
            if(isset($params["GET"]["number"])) {
                if ($params["GET"]["number"] >= 1 || $params["GET"]["number"] <= 12){
                    $numberBlog = $params["GET"]["number"];
                    $pagination = $Blog->getPagination($numberBlog, $params["GET"]);
                }
            }
            if(isset($params['GET']['page']) && array_key_exists($params['GET']['page'], $pagination)){
                $page = $params['GET']['page'];
                $offset = $numberBlog * $page - $numberBlog;
            }
        }
        $array = $Blog->getAllArticleByStatus(1, $numberBlog, $offset);
        $data = [];
        foreach($array as $content){
            $File = new FileRepository();
            $date = new DateTime($content->getDatecreate());
            $value["blog_datecreate"] = $date->format("l jS \of F Y H:i");
            $value["blog_title"] = $content->getTitle();
            $value["blog_content"] = $Blog->getResumeContent($content->getContent());
            $value["blog_status"] = $content->getStatus();
            $value["blog_id"] = $content->getId();
            $value["blog_url"] = $content->getUrl();
            $value["blog_numberComment"] = $Comment->getAll("number_blog", $content->getId());
            $value["category"] = $Category->getCategoryByIdentifier('blog', $content->getId());
            $value["image"] = $File->getFileById($content->getFileid());
            $data[] = $value;
        }
        $View->setData("urlBlogfeed", $routes['rss_blog']);
        $View->setData("pagination", $pagination);
        $View->setData("page", $page);
        $View->setData("data", $data);
        $View->setData("col", $colSize);
    }

    /**
     * @Route("/en/view/{idArticle}")
     * @param array $params
     * View article action
     */
    function viewAction($params)
    {
        if(isset($params["URI"][0]) && !empty($params["URI"][0])){
            $View = new View("default", "Blog/view_article");
            $View->setData('errors', false);
            $Blog = new BlogRepository();
            $Comment = new CommentRepository();
            $Category = new CategoryRepository();
            $configFormComment = $Comment->configFormAdd();
            if($Blog->getArticleByUrl($params["URI"][0])){
                if(isset($params['POST']) && !empty($params['POST'])){
                    $errors = $Comment->addComment($configFormComment, $params['POST'], 1, $Blog->getId());
                    if(empty($errors)){
                        header('Location:'.Access::getSlugsById()["view_blog_article"].'/'.$params["URI"][0]);
                    }
                    $View->setData('errors', $errors);
                }
                $article = [
                    "title" => $Blog->getTitle(),
                    "content" => $Blog->getContent(),
                    "datecreate" => $Blog->getDatecreate(),
                    'image' => $Blog->getFileid(),
                    'url' => $Blog->getUrl(),
                    'type' => $Blog->getType(),
                    "category" => $Category->getCategoryByIdentifier('blog', $Blog->getId()),
                ];
                if($Blog->getType() == 3){
                    $article['content'] = $Blog->getPlayerVideo($Blog->getContent());
                }

                $comments = $Comment->getAll('blog', $Blog->getId());
                $View->setData("article_content", $article);
                $View->setData("comments", $comments);
                $View->setData("formAddComment", $configFormComment);
            } else {
                echo "L'article demandé n'est pas disponible ou n'existe pas";
            }
        } else {
            header('Location:'.Access::getSlugsById()["bloghome"]);
        }


    }

    /**
     * @Route("/en/search/{params}")
     * @param array $params
     * View filtered article action
     */
    function searchAction($params)
    {
        $View = new View("default");
    }

    /**
     * @Route("/en/add/{params}")
     * @param array $params
     * Add article
     */
    function addAction($params)
    {
        $routes = Access::getSlugsById();
        /**
         * On regarde si nous avons bien un paramètre dans une URL
         */
        if(isset($params["URI"][0])){
            $getTypeNewArticle = $params["URI"][0];
            $Blog = new BlogRepository();
            if($getTypeNewArticle == "text"){
                $configForm = $Blog->configFormAddArticleText();
                if(isset($params["POST"]["ckeditor_article"])){
                    $contentInputName = $params["POST"]["ckeditor_article"];
                }
            } elseif ($getTypeNewArticle == "image"){
                $configForm = $Blog->configFormAddArticleImage();
                if(isset($params["POST"]["textarea_articleImage"])){
                    $contentInputName = $params["POST"]["textarea_articleImage"];
                }
            } elseif ($getTypeNewArticle == "video"){
                $configForm = $Blog->configFormAddArticleVideo();
                if(isset($params["POST"]["link"])){
                    $contentInputName = $params["POST"]["link"];
                }
            } else {
                header('Location:'.$routes['dashboard_blog'].'/error');
            }
            $View = new View("dashboard", "Dashboard/add_article_blog");
            $View->setData("errors", "");
            if((isset($_FILES) && !empty($_FILES)) || (isset($params["POST"]) && !empty($params["POST"]))){
                $resultAdd = $Blog->addArticle($_FILES, $params["POST"], $getTypeNewArticle);
                if($resultAdd === 1){
                    $GeneratorXML = new GeneratorXML('blogfeed');
                    $GeneratorXML->setBlogFeed($Blog->getAllArticleByStatus(1));
                    header('Location:'.$routes['dashboard_blog']);
                } else {
                    $View->setData("errors", $resultAdd);
                    $configForm["data_content"] = [
                        "title" => $params["POST"]["title"],
                        "select_lesson" => $params["POST"]["select_lesson"],
                        "category_input" => $params["POST"]["category_input"],
                        "content" => $contentInputName,
                        "link" => $contentInputName,
                    ];
                }
            }
            $View->setData("configForm", $configForm);
        } else {
            header('Location:'.$routes['dashboard_blog']);
        }
        $View->setData('controller', "DashboardController");
    }

    function editAction($params)
    {
        $routes = Access::getSlugsById();
        if(isset($params["URI"][0])){
            if(is_numeric($params["URI"][0])) {
                $Blog = new BlogRepository();
                $View = new View("dashboard", "Dashboard/add_article_blog");
                $arrayReturn = $Blog->editArticle($params["URI"][0]);
                $arrayBlog = $arrayReturn["blog"];
                $pathFile = (isset($arrayReturn["file"]))?$arrayReturn["file"]->getPath().$arrayReturn["file"]->getName():null;
                $configForm = $arrayReturn["configForm"];
                $configForm["data_content"] = [
                    "title" => $arrayBlog->getTitle(),
                    "content" => $arrayBlog->getContent(),
                    "link" => $arrayBlog->getContent(),
                    "file_img" => $pathFile,
                    "selectedOption" => $arrayReturn['selectedOption']
                ];
                switch($arrayBlog->getType()){
                    case 1:
                        $typeArticle = "text";
                        break;
                    case 2:
                        $typeArticle = "image";
                        break;
                    case 3:
                        $typeArticle = "video";
                        break;
                    default:
                        return -1;
                        break;
                }
                if((isset($_FILES) && !empty($_FILES)) || (isset($params["POST"]) && !empty($params["POST"]))){
                    $resultAdd = $Blog->addArticle($_FILES, $params["POST"], $typeArticle, $params["URI"][0]);
                    if($resultAdd == 1){
                        header('Location:'.$routes['dashboard_blog']);
                    }
                }
                $View->setData("errors", "");
                $View->setData("configForm", $configForm);
            }
        } else {
            header('Location:'.$routes['dashboard_blog']);
        }
        $View->setData('controller', "DashboardController");
    }

    function statusAction($params)
    {
        $routes = Access::getSlugsById();
        if(is_numeric($params["URI"][0])){
            $Blog = new Blog();

            $target = [
                "id",
                "status"
            ];
            $parameter = [
                "LIKE" => [
                    "id" => $params["URI"][0]
                ]
            ];
            $Blog->setWhereParameter($parameter);
            $Blog->getOneData($target);
            if($Blog->getId()){
                if($Blog->getStatus() > 0){
                    $Blog->setStatus(0);
                } else {
                    $Blog->setStatus(1);
                }
                $Blog->save();
            }
        }

        header('Location:'.$routes["dashboard_blog"]);
    }
}