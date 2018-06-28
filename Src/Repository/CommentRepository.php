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
     * @return array
     * Permet de récupérer l'ensemble des commentaires d'un blog ou cours
     * Liste des identifiants :
     * - blog
     */
    public function getAll($identifier, $value)
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
            return $this->getData($target);
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
            return $this->countData($target)[0];
        }
        if($identifier == "number_all"){
            $target = ["id"];
            $joinParameter = [
                "blogcomment" => [
                        "comment_id"
                ]
            ];
            $whereParameter = null;
            $this->setLeftJoin($joinParameter, $whereParameter);
            return $this->countData($target)[0];
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
}