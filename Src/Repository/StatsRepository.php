<?php

/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 17/07/2018
 * Time: 23:25
 */
class StatsRepository extends Stats
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getStatViewTosle()
    {

        $currentYear = date("Y");
        $target = [
            "id",
            "month",
            "year"
        ];
        $parameter = [
            "LIKE" => [
                "year" => $currentYear
            ]
        ];
        $this->setWhereParameter($parameter);
        $resultStatMonth =  $this->getData($target);

        $arrayStatViewTosle = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        if (isset($resultStatMonth)) {
            foreach ($resultStatMonth as $row) {
                for ($i = 0; $i < 12; $i += 1) {
                    if ($i === $row->getMonth()) {
                        $arrayStatViewTosle[$row->getMonth() - 1] += 1;
                    }
                }
            }
        }
        return $arrayStatViewTosle;
    }

    public function getStatViewClass()
    {


    }

    public function getStatViewArticle()
    {

    }

    public function getStatViewBlog()
    {

    }

    public function getStatMessage()
    {

    }


    public function formalizeJson()
    {

    }

}
