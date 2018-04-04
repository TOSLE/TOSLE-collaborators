<?php

class BaseSql{

    private $table;
    private $pdo;
    private $columns;

    public function __construct(){
        try {
            $this->pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME,DBUSER,DBPWD);
        } catch(Exception $e){
            die("Erreur SQL".$e->getMessage()."\n");
        }

        $this->table =strtolower(get_called_class());
    }

    public function setColumns(){
        $columnsExcluded = get_class_vars(get_class());
        $this->columns = array_diff_key(get_object_vars($this), $columnsExcluded);
    }

    public function save(){
        $this->setColumns();

        if($this->id){
            $set = array();
            foreach ($this->columns as $columnName => $value) {
                $set[] = $columnName . ' = :'.$columnName;
            }
            $query = $this->pdo->prepare("UPDATE ".$this->table." SET "
                . implode(',', $set) ." WHERE id='".$this->id."'");
            $query->execute($this->columns);
        }	else {
            unset($this->columns["id"]);
            $query = $this->pdo->prepare("INSERT INTO ".$this->table."("
                . implode(',', array_keys($this->columns)) .") VALUES (:"
                . implode(',:', array_keys($this->columns)) .
                ")");
            $query->execute($this->columns);
        }
    }

}