<?php

class CoreSql{

    private $table;
    private $columnBase;
    private $pdo;
    private $columns;

    /**
     * CoreSql constructor.
     * Ne prend aucun paramètre
     * Il va initialiser la connexion à la base de données et quelques variables :
     * @var $table : contient le nom de la table en prenant soin de retirer le "Repository"
     * @var $columnBase : cette variable est utilisé pour les noms de colonnes, qui commencent tous par le nom de la table. Elle permet notemment d'enlever le "Repository"
     */
    public function __construct(){
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
    public function setColumns(){
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

    /**
     * function getData
     * @param array $target
     * @param array $parameterLike
     * @param array $parameterNotLike
     * @return array
     *
     * Cette fonction prend deux tableaux en paramètres obligatoire et un facultatif.
     * $target contient les champs que nous souhaitons récupérer
     *      Ce tableau est du type :
     *      "nom de la colonne recherchée"
     * $parameterLike contient les paramètres permettant de sélectionner des données qui valent à une donnée
     *      Ce tableau est du type associatif :
     *      "colonne de trie" => valeur que l'on doit retrouver dans la colonne
     * $parameterNotLike contient les paramètres que nous ne voulons pas et fonctionne de la même manière que $parameterLike
     *      Ce tableau est du type associatif :
     *      "colonne de trie" => valeur que l'on ne doit pas retrouver dans la colonne
     *
     * Cette fonction nous retourne un array contenant le résultat de la requête. Le reste est trié par les Repository
     */
    public function getData($target, $parameterLike, $parameterNotLike = null)
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
    
    public function getOneData($target, $parameterLike, $parameterNotLike = null)
    {
        $response = $this->getData($target, $parameterLike, $parameterNotLike);
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
            $target[$key] = $this->columnBase.'_'.$value;
        }
        $query = $this->pdo->prepare("
            SELECT " . implode(',', $target) . " 
            FROM " . $this->table . "
        ");
        $query->execute();
        return $query->fetchAll();
    }

    /**
     * @param array $target
     * @param array $parameter
     * @return array
     */
    public function countData($target, $parameter = null)
    {
        foreach ($target as $key => $value){
            $target[$key] = $this->columnBase.'_'.$value;
        }
        $tmpString = "";
        if(isset($parameter)){
            $selectParameter = [];
            foreach ($parameter as $columnName => $value){
                $selectParameter[] = $this->columnBase.'_'.$columnName . " LIKE '" . $value . "'";
            }
            $tmpString = "WHERE " . implode(' AND ', $selectParameter);
        }

        $query = $this->pdo->prepare("
            SELECT COUNT(" . implode(',', $target) . ")
            FROM " . $this->table . "
            ".$tmpString."
        ");

        $query->execute();
        return $query->fetch();
    }

    public function getLimitedData($arrayFetchAll, $min, $max){
        $array = [];
        for($i = $min; $i < $max; $i++){
            $array[] = $arrayFetchAll[$i];
        }
        return $array;
    }

    /**
     * @param $arrays
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

    public function count($parameter)
    {

    }

}