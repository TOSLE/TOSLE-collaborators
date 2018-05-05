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
    private $actionButtonStatus = null;
    private $actionButtonView = null;
    private $actionButtonEdit = null;
    private $typeArrayData = false;

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
     * @param $condition
     * @param string $string
     * Contient la clé d'identification (utile dans le fichier dashboard_bloc.md.php)
     * Contient le texte à afficher
     */
    public function setActionButtonStatus($condition, $string = "Publish")
    {
        $this->actionButtonStatus[$condition] = $string;
    }

    /**
     * @param array $arraysData
     * @param string $tableName
     * Contient le tableau non formaté retourné par la fonction getData() de la class CoreSql
     * Le deuxième paramètre est le nom de la table en base
     * Si le nom de table n'est pas renseigné, c'est que notre tableau de donnée est fait main. Il n'est
     * donc pas nécessaire de faire un traitement
     */
    public function setTableBodyContent($arraysData, $tableName = null)
    {
        if(isset($tableName)){
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
                        $tmpData["actionButtonStatus"] = $value;
                    }
                    if($key == "id"){
                        $tmpData["actionButtonView"] = $value;
                        $tmpData["actionButtonEdit"] = $value;
                    }
                }
                $data[] = $tmpData;
            }
            $this->typeArrayData = true;
            $this->tableBodyContent = $data;
        } else {
            $this->typeArrayData = false;
            $this->tableBodyContent = $arraysData;
        }
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

    /**
     * @return array
     * Retourne notre tableau à envoyer à notre modal
     */
    public function getArrayData()
    {
        return [
            "global" => [
                "title" => $this->title,
                "col" => $this->colSizeBloc,
                "icon_header" => $this->iconHeader,
                "table_header" => $this->tableHeaderContent,
                "table_body_class" => $this->tableBodyClass,
                "column_action_button" => [
                    "actionButtonStatus" => $this->actionButtonStatus,
                    "actionButtonView" => $this->actionButtonView,
                    "actionButtonEdit" => $this->actionButtonEdit
                ]
            ],
            "data" => [
                "database" => $this->typeArrayData,
                "array_data" => $this->tableBodyContent
            ]
        ];
    }
}