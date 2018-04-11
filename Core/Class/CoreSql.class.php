<?php

class CoreSql{

    private $table;
    private $pdo;
    private $columns;

    public function __construct(){
        try {
            $this->pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPWD);
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
                $set[] = strtolower(get_called_class()).'_'.$columnName . ' = :'.$columnName;
            }
            $query = $this->pdo->prepare("UPDATE ".$this->table." SET "
                . implode(',', $set) ." WHERE ".strtolower(get_called_class())."_id='".$this->id."'");
            $query->execute($this->columns);
        }	else {
            unset($this->columns["id"]);
            $columnName = [];
            foreach($this->columns as $key => $value){
                $columnName[] = strtolower(get_called_class()).'_'.$key;
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
        $selectParameter = [];
        foreach ($parameterLike as $columnName => $value){
            $selectParameter[] = $columnName . " LIKE '" . $value . "'";
        }
        if(isset($parameterNotLike)) {
            foreach ($parameterNotLike as $columnName => $value) {
                $selectParameter[] = $columnName . " NOT LIKE '" . $value . "'";
            }
        }

        $query = $this->pdo->prepare("
            SELECT " . implode(',', $target) . " 
            FROM " . $this->table . " 
            WHERE " . implode(' AND ', $selectParameter) . "
        ");
        return $query->execute();
    }

}