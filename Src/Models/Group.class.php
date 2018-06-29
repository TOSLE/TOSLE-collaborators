<?php
/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 05/04/2018
 * Time: 23:58
 */

class Group extends CoreSql {

    protected $id;
    protected $name;
    protected $fileid; /** a verif */

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
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