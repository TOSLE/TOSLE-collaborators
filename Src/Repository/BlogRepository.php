<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 29/04/2018
 * Time: 23:19
 */

class BlogRepository extends Blog
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return integer
     * Retourne le nombre d'article de la table Blog
     */
    public function countNumberOfBlog()
    {
        return $this->countData(["id"])[0];
    }

    /**
     * @param integer $status
     * @return integer
     * Retourne le nombre d'article de la table Blog en fonction du status (par défaut vaut 1 (publié))
     */
    public function countNumberOfBlogByStatus($status = 1)
    {
        $this->setWhereParameter([
            "LIKE" => [
                "status" => $status
            ]
        ]);
        return $this->countData(["id"])[0];
    }

    /**
     * @param integer $id
     * Retourne tous les éléments d'un article en fonction de son id
     */
    public function getArticle($id)
    {
        $parameter = [
            "LIKE" => [
                "id" => $id
            ]
        ];
        $this->setWhereParameter($parameter);
        $this->getOneData(["id", "title", "content", "type", "url"]);
    }
    /**
     * @param integer $id
     * Retourne tous les éléments d'un article en fonction de son id
     */
    public function getArticleByUrl($url)
    {
        $parameter = [
            "LIKE" => [
                "url" => $url
            ]
        ];
        $this->setWhereParameter($parameter);
        $this->getOneData(["id", "title", "content", "type", "url", "datecreate"]);
    }

    /**
     * @param int $number
     * @return array|boolean
     */
    public function getLatestArticle($number)
    {
        if(is_numeric($number))
        {
            $target = [
                "title",
                "datecreate",
                "id",
                "status",
                "type"
            ];
            $this->setOrderByParameter(["id" => "DESC"]);
            $this->setLimitParameter($number);
            return $this->getData($target);
        }
        return false;
    }
    /**
     * @param int $status
     * @return array|boolean
     * Retourne tous les articles par rapport à un status
     */
    public function getAllArticleByStatus($status = 1)
    {
        if(is_numeric($status))
        {
            $target = [
                "title",
                "datecreate",
                "id",
                "status",
                "type"
            ];
            $this->setOrderByParameter(["id" => "DESC"]);
            $this->setWhereParameter([
                "LIKE" => [
                    "status" => $status
                ]
            ]);
            return $this->getData($target);
        }
        return false;
    }


    /**
     * @param int $colSize
     * @return array
     * Permet de récupérer la configuration de la modal "LastArticle"
     * Le paramètre permet de définir une largeur à notre modal
     */
    public function getModalLatestArticle($colSize = 12)
    {
        $routes = Access::getSlugsById();
        $ViewLatestBloc = new DashboardBlocModal();
        $ViewLatestBloc->setTitle("View latest post on your blog");
        $ViewLatestBloc->setIconHeader("modal_view_all_posts", "modal");
        $ViewLatestBloc->setTableHeader([
            1 => "Titre",
            2 => "Date de publication",
            3 => "Action"
        ]);
        $ViewLatestBloc->setColSizeBloc($colSize);
        $ViewLatestBloc->setActionButtonStatus(0, [
            "color" => "green",
            "text" => "Publish",
            "type" => "href",
            "target" => $routes["blog/status"]."/"
        ]);
        $ViewLatestBloc->setActionButtonStatus(1, [
            "color" => "red",
            "text" => "Unpublish",
            "type" => "href",
            "target" => $routes["blog/status"]."/"
        ]);
        $ViewLatestBloc->setActionButtonEdit("Edit");
        $ViewLatestBloc->setActionButtonView("View");

        $ViewLatestBloc->setTableBodyClass([
            1 => "td-content-text",
            2 => "td-content-date",
            3 => "td-content-action"
        ]);
        $ViewLatestBloc->setTableBodyContent($this->getLatestArticle(5), true);
        $ViewLatestBloc->setArrayHref("edit", $routes["blog/edit"]);
        $ViewLatestBloc->setArrayHref("view", $routes["view_blog_article"]);
        return $ViewLatestBloc->getArrayData();
    }

    /**
     * @param int $colSize
     * @param int $status
     * @return array
     * Permet de récupérer la configuration de la modal "allArticle"
     * Le paramètre permet de définir une largeur à notre modal
     */
    public function getModalAllArticle($colSize = 12, $status = 1)
    {
        $routes = Access::getSlugsById();
        $ViewArticleBloc = new DashboardBlocModal();
        if($status === 1)
            $ViewArticleBloc->setTitle("View article with the status : Publish");
        else if ($status === 0)
            $ViewArticleBloc->setTitle("View article with the status : Unpublish");
        $ViewArticleBloc->setTableHeader([
            1 => "Titre",
            2 => "Date de publication",
            3 => "Action"
        ]);
        $ViewArticleBloc->setColSizeBloc($colSize);
        $ViewArticleBloc->setActionButtonStatus(0, [
            "color" => "green",
            "text" => "Publish",
            "type" => "href",
            "target" => $routes["blog/status"]."/"
        ]);
        $ViewArticleBloc->setActionButtonStatus(1, [
            "color" => "red",
            "text" => "Unpublish",
            "type" => "href",
            "target" => $routes["blog/status"]."/"
        ]);
        $ViewArticleBloc->setActionButtonEdit("Edit");
        $ViewArticleBloc->setActionButtonView("View");

        $ViewArticleBloc->setTableBodyClass([
            1 => "td-content-text",
            2 => "td-content-date",
            3 => "td-content-action"
        ]);
        $ViewArticleBloc->setTableBodyContent($this->getAllArticleByStatus($status), true);
        $ViewArticleBloc->setArrayHref("edit", $routes["blog/edit"]);
        $ViewArticleBloc->setArrayHref("view", $routes["view_blog_article"]);
        return $ViewArticleBloc->getArrayData();
    }

    /**
     * @return array object
     * Permet de récupérer la modal statistique
     */
    public function getModalStats()
    {
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
                2 => $this->countNumberOfBlog()
            ],
            1 => [
                1 => "Nombre d'article publié",
                2 => $this->countNumberOfBlogByStatus(1)
            ],
            2 => [
                1 => "Nombre d'article dépublié",
                2 => $this->countNumberOfBlogByStatus(0)
            ]
        ]);
        return $StatsBlog->getArrayData();
    }

    /**
     * @return array object
     * Permet de récupérer la configuration d'une modal pour ajouter un poste
     */
    public function getModalAddPost()
    {
        $BlocGeneral = new DashboardBlocModal();

        $routes = Access::getSlugsById();

        $BlocGeneral->setTitle("Principal menu");
        $BlocGeneral->setTableHeader([
            1 => "Name of action",
            2 => "Action"
        ]);
        $BlocGeneral->setTableBodyClass([
            1 => "td-content-text",
            2 => "td-content-action"
        ]);
        $BlocGeneral->setColSizeBloc(6);
        $BlocGeneral->setTableBodyContent([
            0 => [
                1 => "Nouveau post de type texte",
                "button_action" => [
                    "type" => "href",
                    "target" => $routes["blog/add"]."/text",
                    "color" => "tosle",
                    "text" => "New post"
                ]
            ],
            1 => [
                1 => "Nouveau post de type image",
                "button_action" => [
                    "type" => "href",
                    "target" => $routes["blog/add"]."/image",
                    "color" => "tosle",
                    "text" => "New post"
                ]
            ],
            2 => [
                1 => "Nouveau post de type vidéo",
                "button_action" => [
                    "type" => "href",
                    "target" => $routes["blog/add"]."/video",
                    "color" => "tosle",
                    "text" => "New post"
                ]
            ]
        ]);
        return $BlocGeneral->getArrayData();
    }
}