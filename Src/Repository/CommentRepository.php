<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 30/05/2018
 * Time: 10:47
 */

class CommentRepository extends Comment
{
    /**
     * @param $identifier
     * @param $value
     * Permet de récupérer un commentaire par rapport à un identifiant et sa valeur.
     * Liste des identifiants :
     * - tag
     */
    public function getComment($identifier, $value)
    {
        $target = [
            "id",
            "content",
            "tag"
        ];
        if($identifier === "tag"){
            $parameter = [
                "LIKE" => [
                    "tag" => $value
                ]
            ];
        }
        $this->setWhereParameter($parameter);
        $this->getOneData($target);
    }

    /**
     * @param string $identifier
     * @param int $value
     * @return array|int
     * Permet de récupérer l'ensemble des commentaires d'un blog ou cours
     * Liste des identifiants :
     * - blog
     */
    public function getAll($identifier, $value = null)
    {
        if($identifier == "blog"){
            $target = ["id", "content", "tag", "datecreate", "dateupdated"];
            $joinParameter = [
                "blogcomment" => [
                        "comment_id"
                ]
            ];
            $whereParameter = [
                "blogcomment" => [
                    "blog_id" => $value
                ]
            ];
            $this->setLeftJoin($joinParameter, $whereParameter);
            $this->setOrderByParameter(["id"=>"DESC"]);
            $arrayData = $this->getData($target);
            foreach($arrayData as $comment){
                $BlogComment = new BlogComment();
                $arrayReturn = $BlogComment->getBlogCommentByIdentifier('getuser', $comment->getId());
                $comment->setUser($arrayReturn);
            }
            return $arrayData;
        }
        if($identifier == "chapter"){
            $target = ["id", "content", "tag", "datecreate", "dateupdated"];
            $joinParameter = [
                "chaptercomment" => [
                        "comment_id"
                ]
            ];
            $whereParameter = [
                "chaptercomment" => [
                    "chapter_id" => $value
                ]
            ];
            $this->setLeftJoin($joinParameter, $whereParameter);
            $this->setOrderByParameter(["id"=>"DESC"]);
            $arrayData = $this->getData($target);
            foreach($arrayData as $comment){
                $ChapterComment = new ChapterComment();
                $arrayReturn = $ChapterComment->getChapterCommentByIdentifier('getuser', $comment->getId());
                $comment->setUser($arrayReturn);
            }
            return $arrayData;
        }
        if($identifier == "number_blog"){
            $target = ["id"];
            $joinParameter = [
                "blogcomment" => [
                        "comment_id"
                ]
            ];
            $whereParameter = [
                "blogcomment" => [
                    "blog_id" => $value
                ]
            ];
            $this->setLeftJoin($joinParameter, $whereParameter);
            return $this->countData($target);
        }
    }

    /**
     * @param array $_post
     * @param string $_type
     * @param int $_targetId
     * @return array|int
     * Permet de rajouter un commentaire.
     * $_post comprend le formulaire de notre commentaire
     * $_type comprend le type de commentaire auquel il appartient, on a :
     * - blog
     *
     * $_targetId correspond à l'identifiant du type
     */
    public function addComment($_config, $_post, $_type, $_targetId)
    {
        $errors = Form::checkForm($_config, $_post);
        $_post = Form::secureData($_post);
        if(empty($errors)){
            $User = new UserRepository();
            $User->getUser();
            $this->setContent($_post['textarea_comment']);
            $this->setTag();
            $this->save();
            $this->getComment('tag', $this->getTag());
            switch($_type){
                case 1:
                    $BlogComment = new BlogComment();
                    $BlogComment->setBlogid($_targetId);
                    $BlogComment->setCommentid($this->getId());

                    $BlogComment->setUserid($User->getId());
                    $BlogComment->save();
                    break;
                case 2:
                    $ChapterComment = new ChapterComment();
                    $ChapterComment->setChapterid($_targetId);
                    $ChapterComment->setCommentid($this->getId());
                    $ChapterComment->setUserid($User->getId());
                    $ChapterComment->save();
                    break;
                default:
                    return $errors;
                    break;
            }
        }
        return $errors;
    }

    public function getAuthorComment($_idComment)
    {
        $User = new UserRepository();
        $BlogComment = new BlogComment();
        $User->getUserById($BlogComment->getUserid($_idComment));
        return [
            "firstname" => $User->getFirstName(),
            "lastname" => $User->getLastName(),
        ];

    }

    public function getCommentByUserId($identifier, $id)
    {
        if ($identifier == "blog") {
            $target = ["id", "content", "tag", "datecreate", "dateupdated"];
            $joinParameter = [
                "blogcomment" => [
                    "comment_id"
                ]
            ];
            $whereParameter = [
                "blogcomment" => [
                    "userid" => $id
                ]
            ];
            $this->setLeftJoin($joinParameter, $whereParameter);
            $this->setOrderByParameter(["id" => "DESC"]);
            return $this->getData($target);
        }
        if ($identifier == "chapter") {
            $target = ["id", "content", "tag", "datecreate", "dateupdated"];
            $joinParameter = [
                "chaptercomment" => [
                    "comment_id"
                ]
            ];
            $whereParameter = [
                "chaptercomment" => [
                    "userid" => $id
                ]
            ];
            $this->setLeftJoin($joinParameter, $whereParameter);
            $this->setOrderByParameter(["id" => "DESC"]);
            return $this->getData($target);
        }

    }

    public function getStatComment($sort)
    {
        switch ($sort) {
            case 'year':
                echo 'year';
                $currentYear = date("Y");
                $target = [
                    "id",
                    "dateinscription"
                ];
                $parameter = [
                    "LIKE" => [
                        "MONTH('user_dateinscription')" => "MONTH(CURRENT_DATE())"
                    ]
                ];
                $this->setWhereParameter($parameter);
                return $this->getData($target);
                break;
            case 'month':
                echo 'month';
                break;
            case 'day':
                echo 'day';
                break;
        }
    }

    public function getAllComment() {

        $target = [
            "id"
        ];

        $arrayComment = $this->getData();
        return count($arrayComment);
    }
}