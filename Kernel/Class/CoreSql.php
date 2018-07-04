<?php

class CoreSql{

    private $table;
    private $columnBase;
    private $pdo;
    private $columns;
    private $whereParameter;
    private $limitParameter;
    private $orderByParameter;
    private $leftJoin = "";

    /**
     * CoreSql constructor.
     * Ne prend aucun paramètre
     * Il va initialiser la connexion à la base de données et quelques variables :
     * @var $table : contient le nom de la table en prenant soin de retirer le "Repository"
     * @var $columnBase : cette variable est utilisé pour les noms de colonnes, qui commencent tous par le nom de la table. Elle permet notemment d'enlever le "Repository"
     */
    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME.";charset=UTF8",DBUSER,DBPWD);
        } catch(Exception $e){
            die("Erreur SQL".$e->getMessage()."\n");
        }
        $this->table = "tosle_".strtolower(str_ireplace("Repository","",get_called_class()));
        $this->columnBase = strtolower(str_ireplace("Repository","",get_called_class()));
    }

    /**
     * function setColumns
     * Elle permet de retirer les attributs de CoreSql afin de construire notre requête avec les attributs de nos modèles uniquement
     */
    public function setColumns()
    {
        $columnsExcluded = get_class_vars(get_class());
        $this->columns = array_diff_key(get_object_vars($this), $columnsExcluded);
    }

    /**
     * function save
     * save permet de gérer deux requêtes :
     * UPDATE :
     *      en cas d'un attribut id (non null), la fonction va construire une requête en ne prenant en compte que les attributs
     *      (non null) afin de mettre à jour les données correspondant à notre idée
     * INSERT INTO :
     *      dans le cas où aucun n'id n'est renseigné, la fonction va tout simplement ajouter à notre base de données ce qu'on aura inséré dans
     *      nos attributs
     */
    public function save()
    {
        $this->setColumns();
        if($this->id){
            $set = [];
            foreach ($this->columns as $columnName => $value) {
                if(isset($this->columns[$columnName]) && $columnName != "id") {
                    $set[] = $this->columnBase . '_' . $columnName . ' = :' . $columnName;
                } else {
                    unset($this->columns[$columnName]);
                }
            }

            $query = $this->pdo->prepare("UPDATE ".$this->table." SET "
                . implode(',', $set) ." WHERE ".$this->columnBase."_id='".$this->id."'");
            $query->execute($this->columns);
        }	else {
            unset($this->columns["id"]);
            $columnName = [];
            foreach($this->columns as $key => $value){
                if(!empty($this->columns[$key]) || $this->columns[$key] === 0){
                    $columnName[] = $this->columnBase.'_'.$key;
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

    /**
     * @param array $parameterAnd
     * @param array $parameterOr
     * Cette fonction sert à construire notre 'WHERE' pour notre requête en base de données
     * Le tableau $parameterAnd ou $parameterOr doi être de cette forme :
     * $parameterAnd = [
     *      "LIKE" => [
     *          "columnName1" => $value,
     *          "columnName2" => $value2
     *      ],
     *      "NOT LIKE" => [
     *          "columnName1" => $value,
     *          "columnName2" => $value2
     *      ]
     * ]
     * $parameterOr = [
     *      "LIKE" => [
     *          "columnName1" => $value,
     *          "columnName2" => $value2
     *      ],
     *      "NOT LIKE" => [
     *          "columnName1" => $value,
     *          "columnName2" => $value2
     *      ]
     * ]
     */
    public function setWhereParameter($parameterAnd, $parameterOr = null)
    {
        $tmpArrayAnd = [];
        if(isset($parameterAnd["LIKE"])){
            foreach ($parameterAnd["LIKE"] as $columnName => $value){
                $tmpArrayAnd[] = $this->columnBase.'_'.$columnName . " LIKE '" . $value . "'";
            }
        }
        if(isset($parameterAnd["NOT LIKE"])){
            foreach ($parameterAnd["NOT LIKE"] as $columnName => $value){
                $tmpArrayAnd[] = $this->columnBase.'_'.$columnName . " NOT LIKE '" . $value . "'";
            }
        }
        $tmpArrayOr = [];
        if(isset($parameterOr["LIKE"])){
            foreach ($parameterOr["LIKE"] as $columnName => $value){
                $tmpArrayOr[] = $this->columnBase.'_'.$columnName . " LIKE '" . $value . "'";
            }
        }
        if(isset($parameterOr["NOT LIKE"])){
            foreach ($parameterOr["NOT LIKE"] as $columnName => $value){
                $tmpArrayOr[] = $this->columnBase.'_'.$columnName . " NOT LIKE '" . $value . "'";
            }
        }

        $tmpString = "";
        if(!empty($tmpArrayAnd)){
            $tmpString = implode(' AND ', $tmpArrayAnd);
            if(!empty($tmpArrayOr)){
                $tmpString .= ' OR ' . implode(' OR ', $tmpArrayOr);
            }
        } else {
            if(!empty($tmpArrayOr)){
                $tmpString = implode(' OR ', $tmpArrayOr);
            }
        }

        if(!empty($tmpString)){
            $this->whereParameter = "";
        }

        if(empty($this->whereParameter)){
            $this->whereParameter = "WHERE ".$tmpString;
        } else {
            $this->whereParameter .= ' AND '.$tmpString;
        }
    }

    /**
     * @param int $limit
     * @param int $offset
     * Setter de la partie LIMIT des requêtes select
     */
    public function setLimitParameter($limit, $offset = 0)
    {
        $this->limitParameter = "";
        if(is_numeric($limit)){
            $this->limitParameter = "LIMIT " . $limit;
            if(is_numeric($offset)){
                $this->limitParameter .= " OFFSET " . $offset;
            }
        }
    }

    /**
     * @param array $arrayOrder
     * Prend le tableau en paramètre et construit la partie ORDER BY du SELECT
     * Format du tableau :
     * $array = [
     *  'columnName' => 'ASC',
     *  'columnName' => 'DESC',
     * ]
     */
    public function setOrderByParameter($arrayOrder)
    {
        $this->orderByParameter = "";
        $tmpArray = [];
        foreach($arrayOrder as $columnName => $typeOrder){
            if(substr($columnName, 0,1) === '_'){
                $tmpArray[] = substr($columnName, 1). " " .$typeOrder;
            } else {
                $tmpArray[] = $this->columnBase.'_'.$columnName. " " .$typeOrder;
            }
        }
        $this->orderByParameter = "ORDER BY " . implode(', ', $tmpArray);
    }


    /**
     * @param array $_target
     * @return array
     * Permet de traiter la gestion des targets
     */
    public function getTarget($_target)
    {
        $arrayTarget = [];
        foreach ($_target as $key => $value){
            if(substr($value, 0,1) === '_'){
                $arrayTarget[$key] = substr($value, 1);
            } else {
                $arrayTarget[$key] = $this->columnBase.'_'.$value;
            }
        }

        return $arrayTarget;
    }
    /**
     * function getData
     * @param array $target
     * @return array
     *
     * Cette fonction prend deux tableaux en paramètres obligatoire et un facultatif.
     * $target contient les champs que nous souhaitons récupérer
     *      Ce tableau est du type :
     *      "nom de la colonne recherchée"
     *
     * Cette fonction nous retourne un array contenant le résultat de la requête. Le reste est trié par les Repository
     */
    public function getData($target)
    {
        $target = $this->getTarget($target);

        $query = $this->pdo->prepare("
            SELECT " . implode(',', $target) . " 
            FROM " . $this->table . " 
            ".$this->leftJoin."
            ".$this->whereParameter."
            ".$this->orderByParameter."
            ".$this->limitParameter."
        ");
        $query->execute();

        // On vide le parameter WHERE pour éviter tout problème sur requête qui viendrait après et où on ne veut pas de parametre
        $this->whereParameter = "";
        $this->orderByParameter = "";
        $this->limitParameter = "";
        $this->leftJoin = "";

        $queryResponse = $query->fetchAll();

        $tableName = ucfirst($this->columnBase);
        $arrayData = [];
        foreach($queryResponse as $contentArray){
            $tmpData = [];
            $object = new $tableName();
            foreach($contentArray as $keyArray => $value){
                if(!is_numeric($keyArray)){
                    $explodedContent = explode('_', $keyArray);
                    if($explodedContent[0] == $this->columnBase){
                        $tmpString = "set".ucfirst($explodedContent[1]);
                        $object->$tmpString($value);
                    } else {
                        $foreinTable = ucfirst($explodedContent[0]);
                        $tmpString = "set".$foreinTable;
                        $object->$tmpString($value);
                    }
                }
            }
            $arrayData[] = $object;
        }
        return $arrayData;
    }

    /**
     * @param array $target
     * Même tableau que la fonction getData, la différence est que cette fonction va retourner directement les données
     * dans l'objet
     */
    public function getOneData($target)
    {
        $target = $this->getTarget($target);

        $query = $this->pdo->prepare("
            SELECT " . implode(',', $target) . " 
            FROM " . $this->table . "  
            ".$this->leftJoin."
            ".$this->whereParameter."
            ".$this->orderByParameter."
            ".$this->limitParameter."
        ");
        $query->execute();
        $resultQuery = $query->fetch();
        // On vide le parameter WHERE pour éviter tout problème sur requête qui viendrait après et où on ne veut pas de parametre
        $this->whereParameter = "";
        $this->orderByParameter = "";
        $this->limitParameter = "";
        $this->leftJoin = "";
        if($resultQuery) {
            foreach ($resultQuery as $key => $value) {
                if (!is_numeric($key)) {
                   /* $tmpString = str_replace($this->columnBase . "_", "", $key);
                    $this->$tmpString = $value;*/
                    $explodedContent = explode('_', $key);
                    if($explodedContent[0] == $this->columnBase){
                        if($explodedContent[1] === "password") {
                            $tmpString = $explodedContent[1];
                            $this->$tmpString = $value;
                        } else {
                            $tmpString = "set".$explodedContent[1];
                            $this->$tmpString($value);
                        }
                    } else {
                        $foreinTable = ucfirst($explodedContent[0]);
                        $tmpString = "set".$foreinTable;
                        $this->$tmpString($value);
                    }
                }
            }
        }
    }

    /**
     * @param array $target
     * @return array
     */
    public function countData($target)
    {
        foreach ($target as $key => $value){
            $target[$key] = $this->columnBase.'_'.$value;
        }

        $query = $this->pdo->prepare("
            SELECT count(" . implode(',', $target) . ") 
            FROM " . $this->table . "   
            ".$this->leftJoin."
            ".$this->whereParameter."
            ".$this->orderByParameter."
            ".$this->limitParameter."
        ");

        $query->execute();

        // On vide le parameter WHERE pour éviter tout problème sur requête qui viendrait après et où on ne veut pas de parametre
        $this->whereParameter = "";
        $this->orderByParameter = "";
        $this->limitParameter = "";
        $this->leftJoin = "";

        return $query->fetch();
    }

    /**
     * @param array $joinParameter
     * @param array $whereParameter
     * $joinParameter = [
     *      "table_to_join" => [
     *          "columnName_in_origin_table"
     *      ]
     * ];
     * $whereParameter = [
     *      "table_to_join" => [
     *          "columnName_in_target_table" => $value
     *      ]
     * ];
     */
    public function setLeftJoin($joinParameter, $whereParameter = null)
    {
        $arrayTmp = [];
        foreach($joinParameter as $table => $arrayColumn){
            $tableJoin = "tosle_".$table;
            foreach($arrayColumn as $columnName){
                $arrayExploded = explode('_', $columnName);
                $arrayTmp[] = $tableJoin.".".$table."_".implode('',$arrayExploded)." = ".$this->table.".".$columnName;
            }
            $this->leftJoin .= "LEFT JOIN ".$tableJoin." ON ".implode('AND', $arrayTmp);
        }
        $arrayTmp = [];
        if(isset($whereParameter)){
            foreach($whereParameter as $table => $arrayColumn){
                foreach($arrayColumn as $columnName => $targetValue){
                    $arrayExploded = explode('_', $columnName);
                    $arrayTmp[] = $tableJoin.".".$table."_".implode('', $arrayExploded)." = ".$targetValue;
                }
                $tmpString = implode('AND', $arrayTmp);
            }
        }
        if(isset($tmpString)){
            if(empty($this->whereParameter)){
                $this->whereParameter = "WHERE ".$tmpString;
            } else {
                $this->whereParameter .= ' AND '.$tmpString;
            }
        }
    }

    public function delete()
    {
        $query = $this->pdo->prepare("
            DELETE "." 
            FROM " . $this->table . " 
            ".$this->whereParameter."
        ");
        $query->execute();

        $this->whereParameter = "";
    }

}