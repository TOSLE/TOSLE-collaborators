<?php

class CoreSql{

    private $table;
    private $pdo;
    private $columns;

    public function __construct(){
        try {
            $this->pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME.";charset=UTF8",DBUSER,DBPWD);
        } catch(Exception $e){
            die("Erreur SQL".$e->getMessage()."\n");
        }

        $this->table = "tosle_".strtolower(get_called_class());
    }

    public function setColumns(){
        $columnsExcluded = get_class_vars(get_class());
        $this->columns = array_diff_key(get_object_vars($this), $columnsExcluded);
    }

    public function save(){
        $this->setColumns();

        if($this->id){
            $set = [];
            foreach ($this->columns as $columnName => $value) {
                if(isset($this->columns[$columnName]) && $columnName != "id") {
                    $set[] = strtolower(get_called_class()) . '_' . $columnName . ' = :' . $columnName;
                } else {
                    unset($this->columns[$columnName]);
                }
            }

            $query = $this->pdo->prepare("UPDATE ".$this->table." SET "
                . implode(',', $set) ." WHERE ".strtolower(get_called_class())."_id='".$this->id."'");
            $query->execute($this->columns);
        }	else {
            unset($this->columns["id"]);
            $columnName = [];
            foreach($this->columns as $key => $value){
                if(!empty($this->columns[$key])){
                    $columnName[] = strtolower(get_called_class()).'_'.$key;
                } else {
                    unset($this->columns[$key]);
                }
            }
            $query = $this->pdo->prepare("INSERT INTO ".$this->table." ("
                . implode(',', $columnName) .") VALUES (:"
                . implode(',:', array_keys($this->columns)) .
                ")");
            $query->execute($this->columns);
        }
    }

    public function selectAnd($target, $parameterLike, $parameterNotLike = null)
    {
        foreach ($target as $key => $value){
            $target[$key] = strtolower(get_called_class()).'_'.$value;
        }
        $selectParameter = [];
        foreach ($parameterLike as $columnName => $value){
            $selectParameter[] = strtolower(get_called_class()).'_'.$columnName . " LIKE '" . $value . "'";
        }
        if(isset($parameterNotLike)) {
            foreach ($parameterNotLike as $columnName => $value) {
                $selectParameter[] = strtolower(get_called_class()).'_'.$columnName . " NOT LIKE '" . $value . "'";
            }
        }
        $query = $this->pdo->prepare("
            SELECT " . implode(',', $target) . " 
            FROM " . $this->table . " 
            WHERE " . implode(' AND ', $selectParameter) . "
        ");
        $query->execute();
        return $query->fetchAll();
    }

    public function selectSimpleResponse($target, $parameterLike, $parameterNotLike = null)
    {
        $response = $this->selectAnd($target, $parameterLike, $parameterNotLike);
        foreach( $response[0] as $key => $value){
            if(!is_numeric($key)) {
                $tmpString = str_replace(strtolower(get_called_class())."_", "", $key);
                $this->$tmpString = $value;
            }
        }
    }

    public function selectOr($target, $parameterLike, $parameterNotLike = null)
    {
        foreach ($target as $key => $value){
            $target[$key] = strtolower(get_called_class()).'_'.$value;
        }
        $selectParameter = [];
        foreach ($parameterLike as $columnName => $value){
            $selectParameter[] = strtolower(get_called_class()).'_'.$columnName . " LIKE '" . $value . "'";
        }
        if(isset($parameterNotLike)) {
            foreach ($parameterNotLike as $columnName => $value) {
                $selectParameter[] = strtolower(get_called_class()).'_'.$columnName . " NOT LIKE '" . $value . "'";
            }
        }
        $query = $this->pdo->prepare("
            SELECT " . implode(',', $target) . " 
            FROM " . $this->table . " 
            WHERE " . implode(' OR ', $selectParameter) . "
        ");
        $query->execute();
        return $query->fetchAll();
    }

    public function selectAllData($target)
    {
        foreach ($target as $key => $value){
            $target[$key] = strtolower(get_called_class()).'_'.$value;
        }
        $query = $this->pdo->prepare("
            SELECT " . implode(',', $target) . " 
            FROM " . $this->table . "
        ");
        $query->execute();
        return $query->fetchAll();
    }

    public function getLimitedData($arrayFetchAll, $min, $max){
        $array = [];
        for($i = $min; $i < $max; $i++){
            $array[] = $arrayFetchAll[$i];
        }
        return $array;
    }

    /**
     * @param $array
     * contains response from SQL query
     */
    public function reorganiseDataForDashboard($arrays)
    {
        $data = [];
        foreach($arrays as $array){
            $tmpArray = [];
            foreach($array as $key => $value){
                if(!is_numeric($key)){
                    $tmpKey = str_replace(strtolower(get_called_class())."_", "", $key);
                    $tmpArray[$tmpKey] = $value;
                }
            }
            $data[]=$tmpArray;
        }
        return $data;
    }

    /**
     * @param $arrays
     * @return array
     * Construction des blocs du dashboard. Il ne faut pas hésiter à réecrire les valeurs par défaut
     * Le paramètre ["icon_header"] est désactivé par défaut. Il faut le redéfénir dans
     */
    public function createArrayDashboardbloc($arraysData, $globalArray)
    {
        $data = [];
        foreach ($this->reorganiseDataForDashboard($arraysData) as $array){
            $tmpData = [];
            foreach($array as $key => $value){
                if($key == "datecreate"){
                    $tmpData[2] = $value;
                }
                if($key == "title"){
                    $tmpData[1] = $value;
                }
                if($key == "status"){
                    $tmpData[3] = $value;
                }
                if($key == "id"){
                    $tmpData["data_id"] = $value;
                }
            }
            $data[] = $tmpData;
        }
        return [
            /*
            * "global" => [
            *    "title" => "Dernières publications",
            *    "col" => 6,
            *    "icon_header" => [
            *        "modal" => [
            *            "target" => "id_modal"
            *        ],
            *        "href" => [
            *            "location" => "location"
            *        ]
            *    ],
            *    "table_header" => [
            *        "Titre",
            *        "Date de publication",
            *        "Action"
            *    ],
            *    "table_body_class" => [
            *        1 => "td-content-text",
            *        2 => "td-content-date",
            *        3 => "td-content-action"
            *    ]
            *],
            */
            "global" => $globalArray,
            "data" => [
                "type" => "latest_post",
                "array_data" => $data
            ]
        ];
    }

}