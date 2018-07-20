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

    public function getStatViewClass($sort)
    {

        switch ($sort) {
            case "year" :
                $currentYear = date("Y");
                $target = [
                    "id",
                    "target",
                    "year"
                ];
                $parameter = [
                    "LIKE" => [
                        "year" => $currentYear
                    ]
                ];
                $this->setWhereParameter($parameter);
                $resultQuery = $this->getData($target);


                if(isset($resultQuery)) {
                    $arrayGetClass = [];
                    foreach($resultQuery as $row) {
                        array_push($arrayGetClass, $row->getTarget());
                    }
                    if(isset($arrayGetClass)) {
                        $arrayLesson = [];
                        for($i = 0; $i < sizeof($arrayGetClass); $i+=1){
                            $rowDecoupe = explode("/",$arrayGetClass[$i]);
                            if(isset($rowDecoupe[2]) && $rowDecoupe[2] === "lesson"){
                                array_push($arrayLesson,$arrayGetClass[$i]);
                            }
                        }
                        if(isset($arrayLesson)) {
                            $arrayKeyLessonName = [];
                            for($i = 0; $i < sizeof($arrayLesson); $i+=1){
                                $getClass = explode("/", $arrayLesson[$i]);
                                if(!isset($getClass[4])){
                                    array_push($arrayKeyLessonName, $getClass[3]);
                                }
                            }
                            $statArrayLesson = array_count_values($arrayKeyLessonName);
                            return $statArrayLesson;

                        }

                    }

                }
                break;

            case "month" : {

                $currentYear = date("Y");
                $currentMonth = date("n");
                $target = [
                    "id",
                    "target",
                    "month",
                    "year"
                ];
                $parameter = [
                    "LIKE" => [
                        "year" => $currentYear,
                        "month" => $currentMonth
                    ]
                ];

                $this->setWhereParameter($parameter);
                $resultQuery = $this->getData($target);

                if(isset($resultQuery)) {
                    $arrayGetClass = [];
                    foreach($resultQuery as $row) {
                        array_push($arrayGetClass, $row->getTarget());
                    }
                    if(isset($arrayGetClass)) {
                        $arrayLesson = [];
                        for($i = 0; $i < sizeof($arrayGetClass); $i+=1){
                            $rowDecoupe = explode("/",$arrayGetClass[$i]);
                            if(isset($rowDecoupe[2]) && $rowDecoupe[2] === "lesson"){
                                array_push($arrayLesson,$arrayGetClass[$i]);
                            }
                        }
                        if(isset($arrayLesson)) {
                            $arrayKeyLessonName = [];
                            for($i = 0; $i < sizeof($arrayLesson); $i+=1){
                                $getClass = explode("/", $arrayLesson[$i]);
                                if(!isset($getClass[4])){
                                    array_push($arrayKeyLessonName, $getClass[3]);
                                }
                            }
                            $statArrayLesson = array_count_values($arrayKeyLessonName);
                            return $statArrayLesson;

                        }
                    }
                }
                break;
            }

            case "day" : {

                $currentYear = date("Y");
                $currentMonth = date("n");
                $currentDay = date("j");
                $target = [
                    "id",
                    "target",
                    "month",
                    "year",
                    "day"
                ];
                $parameter = [
                    "LIKE" => [
                        "year" => $currentYear,
                        "month" => $currentMonth,
                        "day" => $currentDay,
                    ]
                ];

                $this->setWhereParameter($parameter);
                $resultQuery = $this->getData($target);

                if(isset($resultQuery)) {
                    $arrayGetClass = [];
                    foreach($resultQuery as $row) {
                        array_push($arrayGetClass, $row->getTarget());
                    }
                    if(isset($arrayGetClass)) {
                        $arrayLesson = [];
                        for($i = 0; $i < sizeof($arrayGetClass); $i+=1){
                            $rowDecoupe = explode("/",$arrayGetClass[$i]);
                            if(isset($rowDecoupe[2]) && $rowDecoupe[2] === "lesson"){
                                array_push($arrayLesson,$arrayGetClass[$i]);
                            }
                        }
                        if(isset($arrayLesson)) {
                            $arrayKeyLessonName = [];
                            for($i = 0; $i < sizeof($arrayLesson); $i+=1){
                                $getClass = explode("/", $arrayLesson[$i]);
                                if(!isset($getClass[4])){
                                    array_push($arrayKeyLessonName, $getClass[3]);
                                }
                            }
                            $statArrayLesson = array_count_values($arrayKeyLessonName);
                            return $statArrayLesson;
                        }
                    }
                }
                break;
            }


        }
    }

    public function getStatViewArticle($sort)
    {

        switch ($sort) {
            case "year" :
                $currentYear = date("Y");
                $target = [
                    "id",
                    "target",
                    "year"
                ];
                $parameter = [
                    "LIKE" => [
                        "year" => $currentYear
                    ]
                ];
                $this->setWhereParameter($parameter);
                $resultQuery = $this->getData($target);


                if(isset($resultQuery)) {
                    $arrayGetArticle = [];
                    foreach($resultQuery as $row) {
                        array_push($arrayGetArticle, $row->getTarget());
                    }
                    if(isset($arrayGetArticle)) {
                        $arrayArticle = [];
                        for($i = 0; $i < sizeof($arrayGetArticle); $i+=1){
                            $rowDecoupe = explode("/",$arrayGetArticle[$i]);
                            if(isset($rowDecoupe[2]) && $rowDecoupe[2] === "view-article"){
                                array_push($arrayArticle,$arrayGetArticle[$i]);
                            }
                        }
                        if(isset($arrayArticle)) {
                            $arrayKeyArticleName = [];
                            for($i = 0; $i < sizeof($arrayArticle); $i+=1){
                                $getClass = explode("/", $arrayArticle[$i]);
                                if(!isset($getClass[4])){
                                    array_push($arrayKeyArticleName, $getClass[3]);
                                }
                            }
                            $statArrayArticle = array_count_values($arrayKeyArticleName);
                            return $statArrayArticle;

                        }

                    }
                }
                break;

            case "month" : {

                $currentYear = date("Y");
                $currentMonth = date("n");
                $target = [
                    "id",
                    "target",
                    "month",
                    "year"
                ];
                $parameter = [
                    "LIKE" => [
                        "year" => $currentYear,
                        "month" => $currentMonth
                    ]
                ];

                $this->setWhereParameter($parameter);
                $resultQuery = $this->getData($target);

                if(isset($resultQuery)) {
                    $arrayGetArticle = [];
                    foreach($resultQuery as $row) {
                        array_push($arrayGetArticle, $row->getTarget());
                    }
                    if(isset($arrayGetArticle)) {
                        $arrayArticle = [];
                        for($i = 0; $i < sizeof($arrayGetArticle); $i+=1){
                            $rowDecoupe = explode("/",$arrayGetArticle[$i]);
                            if(isset($rowDecoupe[2]) && $rowDecoupe[2] === "view-article"){
                                array_push($arrayArticle,$arrayGetArticle[$i]);
                            }
                        }
                        if(isset($arrayArticle)) {
                            $arrayKeyArticleName = [];
                            for($i = 0; $i < sizeof($arrayArticle); $i+=1){
                                $getClass = explode("/", $arrayArticle[$i]);
                                if(!isset($getClass[4])){
                                    array_push($arrayKeyArticleName, $getClass[3]);
                                }
                            }
                            $statArrayArticle = array_count_values($arrayKeyArticleName);
                            return $statArrayArticle;

                        }

                    }
                }
                break;
            }

            case "day" : {

                $currentYear = date("Y");
                $currentMonth = date("n");
                $currentDay = date("j");
                $target = [
                    "id",
                    "target",
                    "month",
                    "year",
                    "day"
                ];
                $parameter = [
                    "LIKE" => [
                        "year" => $currentYear,
                        "month" => $currentMonth,
                        "day" => $currentDay,
                    ]
                ];

                $this->setWhereParameter($parameter);
                $resultQuery = $this->getData($target);

                if(isset($resultQuery)) {
                    $arrayGetArticle = [];
                    foreach($resultQuery as $row) {
                        array_push($arrayGetArticle, $row->getTarget());
                    }
                    if(isset($arrayGetArticle)) {
                        $arrayArticle = [];
                        for($i = 0; $i < sizeof($arrayGetArticle); $i+=1){
                            $rowDecoupe = explode("/",$arrayGetArticle[$i]);
                            if(isset($rowDecoupe[2]) && $rowDecoupe[2] === "view-article"){
                                array_push($arrayArticle,$arrayGetArticle[$i]);
                            }
                        }
                        if(isset($arrayArticle)) {
                            $arrayKeyArticleName = [];
                            for($i = 0; $i < sizeof($arrayArticle); $i+=1){
                                $getClass = explode("/", $arrayArticle[$i]);
                                if(!isset($getClass[4])){
                                    array_push($arrayKeyArticleName, $getClass[3]);
                                }
                            }
                            $statArrayArticle = array_count_values($arrayKeyArticleName);
                            return $statArrayArticle;

                        }
                    }
                }
                break;
            }


        }
    }

    public function getStatMessage($sort)
    {

    }

}
