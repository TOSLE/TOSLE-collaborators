<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 06/04/2018
 * Time: 14:53
 */

class UserGroup extends CoreSql
{
    protected $id;
    protected $groupid;
    protected $userid;

    public function __construct()
    {
        parent::__construct();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getGroupId()
    {
        return $this->groupid;
    }

    public function setGroupId($groupid)
    {
        $this->groupid = $groupid;
    }

    public function getUserId()
    {
        return $this->userid;
    }

    public function setUserId($userid)
    {
        $this->userid = $userid;
    }
}