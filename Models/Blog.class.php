<?php
/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 06/04/2018
 * Time: 00:12
 */

class Blog extends BaseSql {

    protected $id;
    protected $title;
    protected $type;
    protected $content;
    protected $datecreate;
    protected $status;
    protected $fileid; /** à verif */

    public function __construct()
    {
        //parent::__construct();
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
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
    public function getDatecreate()
    {
        return $this->datecreate;
    }

    /**
     * @param mixed $datecreate
     */
    public function setDatecreate($datecreate)
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
    public function getFileid()
    {
        return $this->fileid;
    }

    /**
     * @param mixed $fileid
     */
    public function setFileid($fileid)
    {
        $this->fileid = $fileid;
    }

    public function configFormAdd()
    {
    }
}