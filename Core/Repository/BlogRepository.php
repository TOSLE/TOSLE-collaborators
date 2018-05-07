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

    public function countNumberOfBlog($target, $parameter = null)
    {
        return $this->countData($target, $parameter)[0];
    }

    public function getLatestArticle($number)
    {
        if(is_numeric($number))
        {
            $target = [
                "title",
                "datecreate",
                "id",
                "status"
            ];
            $this->setOrderByParameter(["id" => "DESC"]);
            $this->setLimitParameter($number);
            return $this->getData($target);
        }
        return 0;
    }



    public function getModalLatestArticle()
    {
        $Access = new Access();
        $hrefBackOffice = $Access->getPathBackOffice();
        $ViewLatestBloc = new DashboardBlocModal();
        $ViewLatestBloc->setTitle("View latest post on your blog");
        $ViewLatestBloc->setIconHeader("modal_view_all_posts", "modal");
        $ViewLatestBloc->setTableHeader([
            1 => "Titre",
            2 => "Date de publication",
            3 => "Action"
        ]);
        $ViewLatestBloc->setColSizeBloc(12);
        $ViewLatestBloc->setActionButtonStatus(0, [
            "color" => "red",
            "text" => "Publish",
            "type" => "href",
            "target" => $hrefBackOffice["blog/status"]."/"
        ]);
        $ViewLatestBloc->setActionButtonStatus(1, [
            "color" => "green",
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
        $ViewLatestBloc->setTableBodyContent($this->getLatestArticle(5), "blog");
        $ViewLatestBloc->setArrayHref("edit", "view");
        $ViewLatestBloc->setArrayHref("view", "view");
        return $ViewLatestBloc->getArrayData();
    }
}