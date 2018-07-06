<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 06/04/2018
 * Time: 20:13
 */

class ChapterComment extends CoreSql
{
    protected $id;
    protected $userid;
    protected $commentid;
    protected $chapterid;

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
    public function getChapterid()
    {
        return $this->chapterid;
    }

    /**
     * @param mixed $chapterid
     */
    public function setChapterid($chapterid)
    {
        $this->chapterid = $chapterid;
    }

    public function getChapterCommentByIdentifier($_identifier, $_value)
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
        $target = ["id", "chapterid", "userid", "commentid"];
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