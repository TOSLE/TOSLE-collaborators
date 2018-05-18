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
        $this->getOneData(["id", "title", "content"]);
    }

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
        return 0;
    }


    /**
     * @param int $colSize
     * @return array
     */
    public function getModalLatestArticle($colSize = 12)
    {
        $Access = new Access();
        $hrefBackOffice = $Access->getPathBackOffice();
        $hrefFrontOffice = $Access->getSlugs();
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
            "target" => $hrefBackOffice["blog/status"]."/"
        ]);
        $ViewLatestBloc->setActionButtonStatus(1, [
            "color" => "red",
            "text" => "Unpublish",
            "type" => "href",
            "target" => $hrefBackOffice["blog/status"]."/"
        ]);
        $ViewLatestBloc->setActionButtonEdit("Edit");
        $ViewLatestBloc->setActionButtonView("View");

        $ViewLatestBloc->setTableBodyClass([
            1 => "td-content-text",
            2 => "td-content-date",
            3 => "td-content-action"
        ]);
        $ViewLatestBloc->setTableBodyContent($this->getLatestArticle(5), true);
        $ViewLatestBloc->setArrayHref("edit", $hrefBackOffice["blog/edit"]);
        $ViewLatestBloc->setArrayHref("view", $hrefFrontOffice["view_blog_article"]);
        return $ViewLatestBloc->getArrayData();
    }
}