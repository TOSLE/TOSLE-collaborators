<?php

/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 17/07/2018
 * Time: 23:25
 */
class StatsRepository extends Stats
{
    private $stats;
    public function __construct()
    {
        parent::__construct();
        $this->stats = $this->getData();
    }

    public function getStatViewTosle()
    {

        $currentYear = date("Y");
        $parameter = [
            "LIKE" => [
                "year" => $currentYear
            ]
        ];
        $this->setWhereParameter($parameter);
        $resultStatMonth =  $this->getData();
        $arrayTmp = [];
        foreach($resultStatMonth as $row){
            $arrayTmp[$row->getToken()] = $row;
        }

        $arrayStatViewTosle = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        if (isset($arrayTmp)) {
            foreach ($arrayTmp as $row) {
                for ($i = 0; $i < 12; $i += 1) {
                    if ($i === $row->getMonth()) {
                        $arrayStatViewTosle[$row->getMonth() - 1] += 1;
                    }
                }
            }
        }
        return $arrayStatViewTosle;
    }

    /**
     * @param $sort
     * @return array|int
     * Cette fonction retourne les données tries pour les vues d'un cours. Elle construit le tableau de façon à avoir
     * les cours dans un tableau, et les données de vue dans l'autre
     */
    public function getNewStatsClass($sort)
    {
        $currentYear = date('Y');
        $currentMonth = date('n');
        $currentDay = date('j');
        $countStats = [];
        $returnedStat = [];
        switch ($sort){
            case 'year':
                foreach($this->stats as $stat){
                    $target = trim($stat->getTarget(), DIRNAME);
                    if($currentYear == $stat->getYear() && stristr($target, 'lesson/')){
                        $targetExploded = explode('/',$target);
                        if(isset($targetExploded[1]) && isset($countStats[$targetExploded[1]])) {
                            $countStats[$targetExploded[1]]++;
                        } else {
                            $countStats[$targetExploded[1]] = 1;
                        }
                    }
                }
                break;
            case 'month':
                foreach($this->stats as $stat){
                    $target = trim($stat->getTarget(), DIRNAME);
                    if($currentYear == $stat->getYear() && $currentMonth == $stat->getMonth() && stristr($target, 'lesson/')){
                        $targetExploded = explode('/',$target);
                        if(isset($targetExploded[1]) && isset($countStats[$targetExploded[1]])) {
                            $countStats[$targetExploded[1]]++;
                        } else {
                            $countStats[$targetExploded[1]] = 1;
                        }
                    }
                }
                break;
            case 'day':
                foreach($this->stats as $stat){
                    $target = trim($stat->getTarget(), DIRNAME);
                    if($currentYear == $stat->getYear() && $currentMonth == $stat->getMonth() && $currentDay == $stat->getDay() && stristr($target, 'lesson/')){
                        $targetExploded = explode('/',$target);
                        if(isset($targetExploded[1]) && isset($countStats[$targetExploded[1]])) {
                            $countStats[$targetExploded[1]]++;
                        } else {
                            $countStats[$targetExploded[1]] = 1;
                        }
                    }
                }
                break;
            default:
                return 0;
                break;
        }
        foreach ($countStats as $targetLesson => $count){
            $lesson[] = $targetLesson;
            $countLesson[] = $count;
            $returnedStat = [
                'lessons' => $lesson,
                'counts' => $countLesson
            ];
        }
        return $returnedStat;
    }

    /**
     * @param $sort
     * @return array|int
     * Cette fonction retourne les données tries pour les vues d'un article. Elle construit le tableau de façon à avoir
     * les articles dans un tableau, et les données de vue dans l'autre
     */
    public function getNewStatsArticle($sort)
    {
        $currentYear = date('Y');
        $currentMonth = date('n');
        $currentDay = date('j');
        $countStats = [];
        $returnedStat = [];
        switch ($sort){
            case 'year':
                foreach($this->stats as $stat){
                    $target = trim($stat->getTarget(), DIRNAME);
                    if($currentYear == $stat->getYear() && stristr($target, 'view-article/')){
                        $targetExploded = explode('/',$target);
                        if(isset($targetExploded[1]) && isset($countStats[$targetExploded[1]])) {
                            $countStats[$targetExploded[1]]++;
                        } else {
                            $countStats[$targetExploded[1]] = 1;
                        }
                    }
                }
                break;
            case 'month':
                foreach($this->stats as $stat){
                    $target = trim($stat->getTarget(), DIRNAME);
                    if($currentYear == $stat->getYear() && $currentMonth == $stat->getMonth() && stristr($target, 'view-article/')){
                        $targetExploded = explode('/',$target);
                        if(isset($targetExploded[1]) && isset($countStats[$targetExploded[1]])) {
                            $countStats[$targetExploded[1]]++;
                        } else {
                            $countStats[$targetExploded[1]] = 1;
                        }
                    }
                }
                break;
            case 'day':
                foreach($this->stats as $stat){
                    $target = trim($stat->getTarget(), DIRNAME);
                    if($currentYear == $stat->getYear() && $currentMonth == $stat->getMonth() && $currentDay == $stat->getDay() && stristr($target, 'view-article/')){
                        $targetExploded = explode('/',$target);
                        if(isset($targetExploded[1]) && isset($countStats[$targetExploded[1]])) {
                            $countStats[$targetExploded[1]]++;
                        } else {
                            $countStats[$targetExploded[1]] = 1;
                        }
                    }
                }
                break;
            default:
                return 0;
                break;
        }
        foreach ($countStats as $targetLesson => $count){
            $lesson[] = $targetLesson;
            $countLesson[] = $count;
            $returnedStat = [
                'articles' => $lesson,
                'counts' => $countLesson
            ];
        }
        return $returnedStat;
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
                        $chain = str_replace(DIRNAME, "",$row->getTarget());
                        array_push($arrayGetClass, $chain);
                    }
                    if(isset($arrayGetClass)) {
                        $arrayLesson = [];
                        for($i = 0; $i < sizeof($arrayGetClass); $i+=1){
                            $rowDecoupe = explode("/",$arrayGetClass[$i]);
                            if(isset($rowDecoupe[0]) && $rowDecoupe[0] === "lesson"){
                                array_push($arrayLesson,$arrayGetClass[$i]);
                            }
                        }
                        if(isset($arrayLesson)) {
                            $arrayKeyLessonName = [];
                            for($i = 0; $i < sizeof($arrayLesson); $i+=1){
                                $getClass = explode("/", $arrayLesson[$i]);
                                if(!isset($getClass[2])){
                                    array_push($arrayKeyLessonName, $getClass[1]);
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
                        $chain = str_replace(DIRNAME, "",$row->getTarget());
                        array_push($arrayGetClass, $chain);
                    }
                    if(isset($arrayGetClass)) {
                        $arrayLesson = [];
                        for($i = 0; $i < sizeof($arrayGetClass); $i+=1){
                            $rowDecoupe = explode("/",$arrayGetClass[$i]);
                            if(isset($rowDecoupe[0]) && $rowDecoupe[0] === "lesson"){
                                array_push($arrayLesson,$arrayGetClass[$i]);
                            }
                        }
                        if(isset($arrayLesson)) {
                            $arrayKeyLessonName = [];
                            for($i = 0; $i < sizeof($arrayLesson); $i+=1){
                                $getClass = explode("/", $arrayLesson[$i]);
                                if(!isset($getClass[2])){
                                    array_push($arrayKeyLessonName, $getClass[1]);
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
                        $chain = str_replace(DIRNAME, "",$row->getTarget());
                        array_push($arrayGetClass, $chain);
                    }
                    if(isset($arrayGetClass)) {
                        $arrayLesson = [];
                        for($i = 0; $i < sizeof($arrayGetClass); $i+=1){
                            $rowDecoupe = explode("/",$arrayGetClass[$i]);
                            if(isset($rowDecoupe[0]) && $rowDecoupe[0] === "lesson"){
                                array_push($arrayLesson,$arrayGetClass[$i]);
                            }
                        }
                        if(isset($arrayLesson)) {
                            $arrayKeyLessonName = [];
                            for($i = 0; $i < sizeof($arrayLesson); $i+=1){
                                $getClass = explode("/", $arrayLesson[$i]);
                                if(!isset($getClass[2])){
                                    array_push($arrayKeyLessonName, $getClass[1]);
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
                        $chain = str_replace(DIRNAME, "",$row->getTarget());
                        array_push($arrayGetArticle, $chain);
                    }
                    if(isset($arrayGetArticle)) {
                        $arrayArticle = [];
                        for($i = 0; $i < sizeof($arrayGetArticle); $i+=1){
                            $rowDecoupe = explode("/",$arrayGetArticle[$i]);
                            if(isset($rowDecoupe[0]) && $rowDecoupe[0] === "view-article"){
                                array_push($arrayArticle,$arrayGetArticle[$i]);
                            }
                        }
                        if(isset($arrayArticle)) {
                            $arrayKeyArticleName = [];
                            for($i = 0; $i < sizeof($arrayArticle); $i+=1){
                                $getClass = explode("/", $arrayArticle[$i]);
                                array_push($arrayKeyArticleName, $getClass[1]);

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
                        $chain = str_replace(DIRNAME, "",$row->getTarget());
                        array_push($arrayGetArticle, $chain);
                    }
                    if(isset($arrayGetArticle)) {
                        $arrayArticle = [];
                        for($i = 0; $i < sizeof($arrayGetArticle); $i+=1){
                            $rowDecoupe = explode("/",$arrayGetArticle[$i]);
                            if(isset($rowDecoupe[0]) && $rowDecoupe[0] === "view-article"){
                                array_push($arrayArticle,$arrayGetArticle[$i]);
                            }
                        }
                        if(isset($arrayArticle)) {
                            $arrayKeyArticleName = [];
                            for($i = 0; $i < sizeof($arrayArticle); $i+=1){
                                $getClass = explode("/", $arrayArticle[$i]);
                                array_push($arrayKeyArticleName, $getClass[1]);

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
                        $chain = str_replace(DIRNAME, "",$row->getTarget());
                        array_push($arrayGetArticle, $chain);
                    }
                    if(isset($arrayGetArticle)) {
                        $arrayArticle = [];
                        for($i = 0; $i < sizeof($arrayGetArticle); $i+=1){
                            $rowDecoupe = explode("/",$arrayGetArticle[$i]);
                            if(isset($rowDecoupe[0]) && $rowDecoupe[0] === "view-article"){
                                array_push($arrayArticle,$arrayGetArticle[$i]);
                            }
                        }
                        if(isset($arrayArticle)) {
                            $arrayKeyArticleName = [];
                            for($i = 0; $i < sizeof($arrayArticle); $i+=1){
                                $getClass = explode("/", $arrayArticle[$i]);
                                array_push($arrayKeyArticleName, $getClass[1]);

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
}
