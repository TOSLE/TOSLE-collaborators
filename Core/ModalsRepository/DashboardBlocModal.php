<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 05/05/2018
 * Time: 01:22
 */

class DashboardBlocModal
{
    private $title = "No title founded";
    private $iconHeader = false;
    private $tableHeaderContent = "No table Header founded";
    private $tableBodyClass;
    private $tableBodyContent = "No table body founded";
    private $colSizeBloc = 6;
    private $buttonValue = ["red" => "Value not found"];
    private $specificButton = null;

    /**
     * @param string $title
     * Permet de donner un titre à notre bloc
     */
    public function setTitle($title)
    {
        $this->title = ucfirst(strtolower($title));
    }

    /**
     * @param string $action
     * @param string $type
     * Permet d'indiquer ou non la présence d'une icone plus en haut à droite du bloc
     * Ne pas y faire appel permet de ne pas l'afficher
     */
    public function setIconHeader($action, $type = "href")
    {
        if($type == "modal"){
            $this->iconHeader = [
                "modal" => [
                    "target" => $action
                ]
            ];
        } else {
            $this->iconHeader = [
                "href" => [
                    "location" => $action
                ]
            ];
        }
    }

    /**
     * @param array $array
     * Tableau associatif du type :
     * [
     *      position_de_la_colonne => "Contenu"
     * ]
     */
    public function setTableHeader($array)
    {
        $this->tableHeaderContent = $array;
    }

    /**
     * @param array $array
     * Tableau associatif du type :
     * [
     *      position_de_la_colonne => "Class"
     * ]
     */
    public function setTableBodyClass($array)
    {
        $this->tableBodyClass = $array;
    }

    /**
     * @param int $size
     * Contient la class "col-" du framework OSPAF
     */
    public function setColSizeBloc($size)
    {
        $this->colSizeBloc = $size;
    }

    /**
     * @param string $color
     * @param string $value
     * Contient la couleur des buttons du Framework OSPAF et le texte à afficher.
     * La couleur ne se limite qu'à ce qui est après le "btn-"
     */
    public function setButtonValue($color, $value)
    {
        $this->buttonValue[$color] = $value;
    }

    /**
     * @param string $key
     * @param array $array
     * Contient la clé d'identification (utile dans le fichier dashboard_bloc.md.php)
     * Le tableau en deuxième paramètre doit être du type associatif :
     * [
     *      condition_true_or_false (0 ou 1) => $value
     * ]
     */
    public function setSpecificButton($key, $array)
    {
        $this->specificButton[$key] = $array;
    }

    /**
     * @param array $arraysData
     * @param string $tableName
     * Contient le tableau non formaté retourné par la fonction getData() de la class CoreSql
     * Le deuxième paramètre est le nom de la table en base
     */
    public function setTableBodyContent($arraysData, $tableName)
    {
        $data = [];
        foreach ($this->reorganiseDataForDashboard($arraysData, $tableName) as $array){
            $tmpData = [];
            foreach($array as $key => $value){
                if($key == "datecreate"){
                    $tmpData[2] = $value;
                }
                if($key == "title"){
                    $tmpData[1] = $value;
                }
                if($key == "status"){
                    $tmpData["specificButton_publishStatus"] = $value;
                }
                if($key == "id"){
                    $tmpData["data_id"] = $value;
                }
            }
            $data[] = $tmpData;
        }
        $this->tableBodyContent = $data;
    }

    /**
     * @param array $arraysData
     * @param string $tableName
     * Contient le tableau non formaté retourné par la fonction getData() de la class CoreSql
     * Le deuxième paramètre est le nom de la table en base
     * @return array formated
     */
    private function reorganiseDataForDashboard($arraysData, $tableName){
        $arrayReturn = [];
        foreach($arraysData as $array){
            $tmpArray = [];
            foreach($array as $key => $value){
                if(!is_numeric($key)){
                    $tmpKey = str_replace(strtolower($tableName)."_", "", $key);
                    $tmpArray[$tmpKey] = $value;
                }
            }
            $arrayReturn[]=$tmpArray;
        }
        return $arrayReturn;
    }

    public function getArrayData()
    {
        return [
            "global" => [
                "title" => $this->title,
                "col" => $this->colSizeBloc,
                "icon_header" => $this->iconHeader,
                "table_header" => $this->tableHeaderContent,
                "table_body_class" => $this->tableBodyClass,
                "button_value" => $this->buttonValue,
                "specific_button" => $this->specificButton
            ],
            "data" => [
                "type" => "latest_post",
                "array_data" => $this->tableBodyContent
            ]
        ];
    }
}