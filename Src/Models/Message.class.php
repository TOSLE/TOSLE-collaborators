<?php
/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 06/04/2018
 * Time: 00:05
 */

class Message extends CoreSql {

    protected $id;
    protected $content;
    protected $datecreate;
    protected $status;
    protected $dateupdated;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getDateCreate()
    {
        return $this->datecreate;
    }

    /**
     * @param mixed $datecreate
     */
    public function setDateCreate($datecreate)
    {
        $this->datecreate = $datecreate;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getDateupdated()
    {
        return $this->dateupdated;
    }

    /**
     * @param mixed $dateupdated
     */
    public function setDateupdated($dateupdated)
    {
        $this->dateupdated = $dateupdated;
    }



    public function configFormAdd()
    {
    }
}