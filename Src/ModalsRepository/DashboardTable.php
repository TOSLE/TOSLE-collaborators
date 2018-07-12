<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 13/07/2018
 * Time: 00:09
 */

class DashboardTable
{
    private $col;
    private $tableId;
    private $title;
    private $action;

    private $tdHead = [];
    private $tdBody = [];
    private $trBody = [];

    private $button = [];
    private $buttonColor = [];
    private $buttonValue = [];
    private $buttonAction = [];
    private $buttonConfirm;

    /**
     * DashboardTable constructor.
     * @param string $_tableId
     * @param string $_title
     * @param int $_col
     */
    public function __construct($_tableId, $_title, $_col = 6)
    {
        $this->tableId = $_tableId;
        $this->title = $_title;
        $this->col = $_col;
    }

    /**
     * @param $_key
     * @param $_content
     */
    public function setAction($_key, $_content)
    {
        $this->action[$_key] = $_content;
    }

    /**
     * @param $_class
     * @param $_content
     */
    public function setTableHeader($_class, $_content)
    {
        $this->tdHead[] = [
            $_class => $_content
        ];
    }

    /**
     * @param $_type
     * @param $_content
     */
    public function setColumnBody($_type, $_content)
    {
        $this->tdBody[] = [
            $_type => $_content
        ];
    }

    /**
     * @param $_color
     * Ajoute une color pour le boutton
     */
    public function setColorButton($_color)
    {
        $this->buttonColor = $_color;
    }

    /**
     * @param $_value
     * Ajoute une valeur à afficher pour le bouton
     */
    public function setValueButton($_value)
    {
        $this->buttonValue = $_value;
    }

    /**
     * @param $_action
     *  Ajoute une cible au bouton
     */
    public function setActionButton($_action)
    {
        $this->buttonAction = $_action;
    }

    public function setConfirmButton($_message)
    {
        $this->buttonConfirm = $_message;
    }

    /**
     * Sauvegarde un bouton
     */
    public function saveButton()
    {
        $this->button[] = [
            'value' => $this->buttonValue,
            'action' => $this->buttonAction,
            'color' => $this->buttonColor,
            'confirm' => $this->buttonConfirm
        ];
    }

    /**
     * Permet de sauvegarder les colonnes d'entête
     */
    public function saveTrBody()
    {
        array_push($this->tdBody, ['button' => $this->button]);
        $this->trBody[] = $this->tdBody;
        $this->tdBody = [];
        $this->button = [];
    }
    public function getArrayPHP()
    {
        return [
            'config' => [
                'col' => $this->col,
                'idBloc' => $this->tableId,
                'title' => $this->title,
                'action' => $this->action
            ],
            'table' => [
                "header" => $this->tdHead,
                "body" => $this->trBody
            ]
        ];
    }
}