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
     * @param $url
     * @return mixed|string
     * Construit l'url qui va bien en fonction du DIRNAME
     */
    public function getTargetSubstr($url)
    {
        if(DIRNAME == '/'){
            return trim($url, DIRNAME);
        } else {
            return str_ireplace(DIRNAME, '', $url);
        }
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
                    $target = $this->getTargetSubstr($stat->getTarget());
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
                    $target = $this->getTargetSubstr($stat->getTarget());
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
                    $target = $this->getTargetSubstr($stat->getTarget());
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
                    $target = $this->getTargetSubstr($stat->getTarget());
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
                    $target = $this->getTargetSubstr($stat->getTarget());
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
                    $target = $this->getTargetSubstr($stat->getTarget());
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
}
