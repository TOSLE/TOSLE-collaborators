<?php
/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 17/07/2018
 * Time: 23:25
 */

class StatsRepository extends Stats {

    public function __construct()
    {
        parent::__construct();
    }

    public function getStatViewTosle () {

        $currentYear = date("Y");

        $target = [
            "month",
            "year"
        ];
        $parameter = [
            "LIKE" => [
                "year" => $currentYear
            ]
        ];
        $this->setWhereParameter($parameter);
        $result = $this->getData($target);

        echo '<pre>';
        print_r($result);
        echo '</pre>';
    }

    public function getStatComment() {

    }

    public function getStatViewClass() {

    }

    public function getStatViewArticle() {

    }
    public function getStatViewBlog() {

    }

    public function getStatMessage() {

    }

    public function getStatUser(){
    }

    public function formalizeJson(){

    }

}
