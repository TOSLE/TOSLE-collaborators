<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 06/04/2018
 * Time: 18:28
 */

class BlogComment extends CoreSql
{
    protected $id;
    protected $userid;
    protected $commentid;
    protected $blogid;

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
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @param mixed $userid
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }

    /**
     * @return mixed
     */
    public function getCommentid()
    {
        return $this->commentid;
    }

    /**
     * @param mixed $commentid
     */
    public function setCommentid($commentid)
    {
        $this->commentid = $commentid;
    }

    /**
     * @return mixed
     */
    public function getBlogid()
    {
        return $this->blogid;
    }

    /**
     * @param mixed $blogid
     */
    public function setBlogid($blogid)
    {
        $this->blogid = $blogid;
    }

    /**
     * @param $_identifier
     * @param $_value
     * @return array|int
     * Permet de récupérer une jointure par rapport à un critère.
     */
    public function getBlogCommentByIdentifier($_identifier, $_value)
    {
        switch($_identifier){
            case 'getuser':
                $paramIdentifier = 'comment';
                $opposite = 'user';
                break;
            default:
                return 0;
                break;
        };
        $target = ["id", "blogid", "userid", "commentid"];
        $parameter = [
            "LIKE" => [
                $paramIdentifier.'id' => $_value
            ]
        ];
        $this->setWhereParameter($parameter);
        $array = $this->getData($target);
        $returnArrayId= [];
        foreach($array as $category) {
            $tmpString = 'get'.ucfirst(strtolower($opposite)).'Id';
            $returnArrayId[] = $category->$tmpString();
        }
        return $returnArrayId;
    }
}